<?php

 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style/stype.css">
    <link rel="stylesheet" href="../style/stude_view.css">
    
    <style>
        /* Search Bar Styles */
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            margin-top: -65px;
            margin-left: -51rem;
          
           
        }

        .search-form {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 55px;
            padding: 10px;
            border: 0.3px solid black;
            transition: all 0.3s ease;
            width: 80%;
            max-width: 250px;
            color:rgb(83, 158, 98);
        }

        .search-input {
            width: 90%;
            padding: 5px 15px;
            font-size: 15px;
            border: none;
            outline: none;
            border-radius: 50px;
            box-sizing: border-box;
             color: #7a7a7a;
            transition: width 0.4s ease-in-out;
        }

        .search-input:focus {
            width: 100%;
            background-color: #e9f5f1;
        }

        .search-button {
            background-color: #007bff;
            border: none;
            border-radius: 50%;
            padding: 12px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button i {
            color: white;
            font-size: 18px;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        .search-input::placeholder {
            color: #7a7a7a;
            font-style: italic;
        }

        .search-container:hover .search-form {
            box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.10);
        }
    </style>
</head>
<body class="">


<?php


include ("sidebar.php");


?>

<?php


include ("header.php");


?>
  

  <div class="table-container">

  <div class="search-container">
            <form action="#" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Search for students..." id="search-bar">
              
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <!-- <h2>Student Records</h2> -->
        <!-- <input type="text" id="search" name="search" placeholder="Search..." onkeyup="fetchData()" /> -->
        <table id="student-table">
            <thead>
                <tr>
                    <th>student_code</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>Gender</th>
                    <th>email</th>
                    <th>contact_number</th>
                    <th>department_name</th>
                    <th>class_name</th>
                    <th>date_of_birth</th>
                    <th>image</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    
                </tr>
               
            </tbody>
        </table>
        <!-- <div class="pagination">
            <button id="prev" disabled>Previous</button>
            <button id="next">Next</button>
        </div> -->
    </div>

    <div class="on-modal">
         <div class="modal-box">
                           
             </div>
            </div>


</body>
<script type="text/javascript" src="../node_modules/app.js" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/studenview.js" defer></script>
</html>
