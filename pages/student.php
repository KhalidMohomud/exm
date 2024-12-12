<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student</title>
    <link rel="stylesheet" href="../style/stype.css">
    <link rel="stylesheet" href="../style/student.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="">


<?php


include ("sidebar.php");


?>

<?php


include ("header.php");


?>
   <div class="form-container">
        <form  method="post">
            <h2>Add New Student</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                 
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                  
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                 
                    <input type="email" class="form-control" id="email" name="email" required >
                </div>
                <div class="form-group">
                    <label for="contact-number">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                   
                </div>
                <div class="form-group">
                    <label for="department">Department</label>
                    <select class="form-select" id="department_id" name="department_id" required>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="class-name">Class Name</label>
               
                        <select class="form-select" id="class_id" name="class_id" required>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
             
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="enrollment-year">Enrollment Year</label>
                    <input type="number"  id="enrollment_year" name="enrollment_year" required>
                </div>
            </div>
          
            <button type="submit" name="insert" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
<script type="text/javascript" src="../node_modules/app.js" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/studen.js" defer></script>
</html>
