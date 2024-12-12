<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style/stype.css">
    <link rel="stylesheet" href="../style/stude_view.css">

</head>
<body class="">


<?php


include ("sidebar.php");


?>

<?php


include ("header.php");


?>
  

  <div class="table-container">
        <h2>Student Records</h2>
        <!-- <input type="text" id="search" name="search" placeholder="Search..." onkeyup="fetchData()" /> -->
        <table id="student-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>email</th>
                    <th>contact_number</th>
                    <th>department_name</th>
                    <th>class_name</th>
                    <th>date_of_birth</th>
                    <th>enrollment_year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
        <!-- <div class="pagination">
            <button id="prev" disabled>Previous</button>
            <button id="next">Next</button>
        </div> -->
    </div>



</body>
<script type="text/javascript" src="../node_modules/app.js" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/studen.js" defer></script>
</html>
