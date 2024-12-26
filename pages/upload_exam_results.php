<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel to Database Import</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert {
            margin-bottom: 20px;
        }
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Display Session Messages -->
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <h5>System Response:</h5>
                        <pre><?php echo $_SESSION['message']; ?></pre>
                        <?php unset($_SESSION['message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Import Excel Data into Database</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center">
                            Upload an Excel file with the same name as the target database table. 
                            Ensure the column names in the Excel file match the database table structure.
                        </p>
                        <form action="../Api/upload_exam_results.php" method="POST" enctype="multipart/form-data">
                            <!-- File Upload -->
                            <div class="mb-3">
                                <label for="import_file" class="form-label">Select Excel File</label>
                                <input type="file" name="import_file" id="import_file" class="form-control" required />
                                <small class="text-muted">
                                    Supported formats: .xls, .xlsx, .csv. The table name will be derived from the file name.
                                </small>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" name="save_excel_data" class="btn btn-primary w-100">Import Data</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted">
                        <small>Powered by PHP, PhpSpreadsheet, and Bootstrap 5</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
