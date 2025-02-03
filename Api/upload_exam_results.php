<?php 
session_start();
include ('../config/conn.php');
require '../vendor/autoload.php'; // PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed_ext = ['xls', 'csv', 'xlsx', 'ods'];
    $_SESSION['message'] = ""; // Initialize message

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];

        // Haddii aad rabto in table la doorto si toos ah, beddel halkan
        $tableName = "exam_results"; // Haddii aad rabto inaad magaca file-ka ka qaadato, beddel

        try {
            // Load the Excel file
            $spreadsheet = IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            if (count($data) > 1) {
                $columns = array_filter($data[0], fn($col) => !empty($col));

                // Check if table exists
                $result = $conn->query("SHOW TABLES LIKE '$tableName'");
                if ($result->num_rows == 0) {
                    $_SESSION['message'] = "Table '$tableName' does not exist in the database.";
                    header('Location: ../pages/ff.php');
                    exit(0);
                }

                // Fetch table schema
                $tableSchemaQuery = $conn->query("DESCRIBE `$tableName`");
                $primaryKeyColumn = null;
                while ($schemaRow = $tableSchemaQuery->fetch_assoc()) {
                    if ($schemaRow['Key'] === 'PRI') {
                        $primaryKeyColumn = $schemaRow['Field'];
                        break;
                    }
                }
                if ($primaryKeyColumn) {
                    $columns = array_filter($columns, fn($col) => $col !== $primaryKeyColumn);
                }

                // Fetch foreign key mappings dynamically
                $fkQuery = $conn->query("SELECT column_name, referenced_table, reference_column FROM foreign_key_mappings WHERE table_name = '$tableName'");
                $foreignKeys = [];
                while ($fkRow = $fkQuery->fetch_assoc()) {
                    $foreignKeys[$fkRow['column_name']] = [
                        'referenced_table' => $fkRow['referenced_table'],
                        'reference_column' => $fkRow['reference_column']
                    ];
                }

                $columnsString = implode(", ", array_map(fn($col) => "`" . $col . "`", $columns));
                $placeholders = implode(", ", array_fill(0, count($columns), "?"));

                $stmt = $conn->prepare("INSERT INTO `$tableName` ($columnsString) VALUES ($placeholders)");

                $successCount = 0;
                $errorCount = 0;

                for ($i = 1; $i < count($data); $i++) {
                    $row = &$data[$i];
                    if (empty(array_filter($row))) {
                        continue;
                    }
                    
                    foreach ($foreignKeys as $column => $fkDetails) {
                        $fkColumnIndex = array_search($column, $columns);
                        if ($fkColumnIndex !== false) {
                            $value = $row[$fkColumnIndex];
                            $referencedTable = $fkDetails['referenced_table'];
                            $referenceColumn = $fkDetails['reference_column'];

                            if (!empty($value)) {
                                $fkQuery = $conn->query("SELECT `$column` FROM `$referencedTable` WHERE LOWER(`$referenceColumn`) = LOWER('$value')");
                                if ($fkQuery->num_rows > 0) {
                                    $fkRow = $fkQuery->fetch_assoc();
                                    $row[$fkColumnIndex] = $fkRow[$column];
                                } else {
                                    $errorCount++;
                                    continue 2;
                                }
                            }
                        }
                    }

                    $row = array_slice($row, 0, count($columns));
                    $row = array_pad($row, count($columns), null);

                    $stmt->bind_param(str_repeat("s", count($row)), ...$row);
                    if ($stmt->execute()) {
                        $successCount++;
                    } else {
                        $errorCount++;
                    }
                }

                $stmt->close();
                $_SESSION['message'] = "Successfully imported $successCount records into '$tableName'. Failed: $errorCount records.";
            } else {
                $_SESSION['message'] = "The uploaded file is empty or contains no valid data.";
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Error occurred while processing the file: " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "Invalid file format. Only .xls, .xlsx, and .csv files are allowed.";
    }

    header('Location: ../pages/ff.php');
    exit(0);
}
