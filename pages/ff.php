<?php

 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Subject</title>
    <style>

    .main-container {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        max-width: 1000px;
        width: 90%;
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        height: 50%;
        padding: 20px 10px;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

   .alert-container{
     position: absolute;
     top: 70px;
     
   }
    .alert {
        padding: 15px;
        margin-bottom: 30px; 
        border-radius: 10px;
        font-size: 16px;
       
        position: relative;
    }

    .alert h5 {
        font-size: 18px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .alert .btn-close {
        position: absolute;
        top: 10px;
        right: 10px;
        border: none;
        background: transparent;
        font-size: 20px;
        cursor: pointer;
    }

    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Row Styles */
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .form-group {
        flex: 1;
        margin: 0 10px;
        text-align: left;
        min-width: 150px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .form-select, .file-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        font-size: 14px;
    }

    .form-import {
        flex: 2;
        margin-right: 10px;
        text-align: left;
    }

    .submit-container {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    small {
        color: black;
    }

    .import-button {
        padding: 10px 20px;
        width: 140px;
        height: 60px;
        background-color: #5a3cf3;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        position: absolute;
        bottom: 32%;
        left: 67rem;
    }

    .import-button:hover {
        background-color: #4a30d6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 95%;
            padding: 15px;
        }

        h1 {
            font-size: 20px;
        }

        .row {
            flex-direction: column;
            align-items: stretch;
        }

        .form-group, .form-import {
            margin: 10px 0;
        }

        .import-button {
            width: 100%;
            height: auto;
            padding: 15px;
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 10px;
        }

        h1 {
            font-size: 18px;
        }

        .form-select, .file-input {
            font-size: 12px;
        }

        .import-button {
            font-size: 14px;
        }
    }
    </style>
</head>
<body>

<?php include ("sidebar.php"); ?>
<?php include ("header.php"); ?>

<div class="main-container">
    <div class="alert-container">

   
<?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['alert_type'] ?? 'info'; ?> alert-dismissible fade show" role="alert">
                <h5>System Response:</h5>
                <pre><?php echo $_SESSION['message']; ?></pre>
                <?php unset($_SESSION['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
            </div>
            
        <?php endif; ?>
        </div>
    <div class="container">
        
      

        <h1>Import Subject</h1>
        <form action="../Api/upload_exam_results.php" method="POST" enctype="multipart/form-data">
            <!-- Row 1: Dropdowns -->
            <div class="row">
                <div class="form-group">
                    <label for="class_id">Class Name</label>
                    <select class="form-select" id="class_id" name="class_id" required>
                        <option value="" disabled selected>Select Class</option>
                        <?php
                        include('../config/conn.php');
                        $sql = mysqli_query($conn, "SELECT * FROM class");
                        if (mysqli_num_rows($sql) > 0) {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo "<option value='{$row['class_id']}'>{$row['class_name']}</option>";
                            }
                        } else {
                            echo "<option value=''>No classes found</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="semester_id">Semester Name</label>
                    <select class="form-select" id="semester_id" name="semester_id" required>
                        <option value="" disabled selected>Select Semester</option>
                    </select>
                </div>
<!-- 
                <div class="form-group">
                    <label for="subject_id">Subject Name</label>
                    <select class="form-select" id="subject_id" name="subject_id" required>
                        <option value="" disabled selected>Select Subject</option>
                    </select>
                </div> -->
            </div>

            <!-- Row 2: File Upload and Submit -->
            <div class="row">
                <div class="form-import">
                    <label for="excel_file">Import File</label>
                    <input type="file" name="import_file" id="import_file" class="file-input" required />
                </div>
                <div class="submit-container">
                    <button type="submit" name="save_excel_data" class="import-button">Import</button>
                </div>
            </div>
            <small class="text-muted"> Only Supported formats: Excel files</small>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/update_exm_sub.js" defer></script>
</body>
</html>
