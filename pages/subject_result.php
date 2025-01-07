<?php

 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Subject</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   
    <link rel="stylesheet" href="../style/result_subject.css">
    <style>
    /* General Styles */

.modal-subject_res {
   padding: 20px;
   position: absolute;
   top: 220px;
   border: 1px solid #888;
   box-shadow: 0 4px 8px rgba(0,0,0,0.2);
   border-radius: 50px 10px 20px;
   left: 30rem;
   position: fixed;
   background-color: #fff;
   border-radius: 10px;
   padding: 15px;
   box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
   width: 650px;

  }
  
  .modal-subject_res  {
   display: none;
 }
 

 .modal-subject_res h2 {
    text-align: center;
    margin-bottom: 10px;
    font-size: 18px;
    color: black;
}
.close-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    background: transparent;
    border: none;
    font-size: 14px;
    cursor: pointer;
    color: #333;
}

.close-btn:hover {
    color: red;
}
  

    

.modal-subject_res  .form-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

 .modal-subject_res  .form-group label {
    font-size: 10px;
    margin-bottom: 4px;
    display: block;
    font-size: 15px;
    color: black;
}

  .modal-subject_res  .form-group .input-field {
    width: 48%;
    font-size:10px ;
}

 .modal-subject_res  .form-group input,
.form-group select {
    width: 100%;
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 15px;

}

.modal-subject_res    .form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #6a11cb;
    box-shadow: 0 0 4px rgba(106, 17, 203, 0.5);
    font-size: 15px;
}

 .modal-subject_res  .gender-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

.gender-group label {
    font-size: 10px;
}

 .modal-subject_res  .submit-btn {
    width: 100%;
    padding: 8px;
    border: none;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    background: var(--base-clr);
    color: #fff;
    cursor: pointer;
    font-size: large;
}
.submit-btn:hover {
    opacity: 0.9;
}

.close {
    position: absolute;
    top: 8px;
    right: 8px;
    background: transparent;
    border: none;
    font-size: 32px;
    cursor: pointer;
    color: #333;
}
.close:hover,
  .close:focus {
    color: red;
    text-decoration: none;
    cursor: pointer;
  }

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
        height: 10%;
        padding: 20px 10px;
        position: relative;
        margin-top: -350px;
        /* background-color:rgb(150, 176, 247); */
        background-color:var(--base-clr);
       
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
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
    
    <div class="container">
        
        <form action="../Api/upload_exam_results.php" method="POST" enctype="multipart/form-data">
   
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

                <div class="form-group">
                    <label for="subject_id">Subject Name</label>
                    <select class="form-select" id="subject_id" name="subject_id" required>
                        <option value="" disabled selected>Select Subject</option>
                    </select>
                </div>
            </div>

      
            
        </form>


        <!-- <div class="search-container">
            <form action="#" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Search for students..." id="search-bar">
              
                    <i class="fa fa-search"></i>
                </button>
            </form>

            
        </div> -->

 
<div class="container-reslte_subject">

    
     
      <table id="reslte_subject_r" >
       <thead >
     
          <tr>
                  <th>Result ID</th>
                <th>Student Name</th>
                <th>subject</th>
                <th>Midterm</th>
                <th>Coursework</th>
                <th>Final</th>
                <th>Reexam</th>
                <th>Total Marks</th>
                <th>Grade</th>
                <th>Actions</th>
                  </tr>
              
         
       </thead>
       <tbody>
           
      
         

       </tbody>
 </table>
</div>



<div class="modal-subject_res" id="modal-subject_res ">
        <span class="close" id="Xbtn2">&times;</span>
        <h2>Exam Update</h2>

        <form id="subject_result_from">
        <input type="hidden" id="update_id">
        <div class="form-group">
                <div class="input-field">
                    <label for="Student_name">Student_name</label>
                    <!-- <select id="student_id" name="student_id"  require>
                        
                      
                    </select> -->
                    <input type="text" id="student_id" name="student_id" >
                </div>
                <div class="input-field">
                    <label for="subject_name">subject_name</label>
                    <!-- <select name="subject_id" id="subject_id" require>
                       
                    </select> -->
                    <input type="text" id="subject_name" name="subject_name" >
                </div>
            </div>
         
            <div class="form-group">
                <div class="input-field">
                    
                    <label for="Midterm">Midterm  Marks</label>
                    <input type="number" id="midterm" name="midterm" value="0" required>
                </div>
                <div class="input-field">
                   
                    <label for="coursework">Coursework Marks</label>
                    <input type="number" id="coursework" name="coursework" value="0"  required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-field">
                 
                    <label for="final">Final Marks</label>
                    <input type="number" id="final" name="final" value="0"  required>
                </div>
                <div class="input-field">
                <label for="reexam">Reexam Marks</label>
                <input type="number" id="reexam" name="reexam" value="0" min="0" max="70">
                </div>
            </div>

            

            <!-- <div class="form-group">
                <div class="input-field">
                    <label for="class">Class</label>
                    <select id="class_id" name="class_id" require>
                        <option value="" disabled selected>Select your class</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="date-of-birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" require>
                </div>
            </div> -->

            <!-- <div class="form-group">
                <div class="input-field">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" require>
                </div>
                <div class="showimg">
                    <img id="show" require>
                </div>
            </div> -->

            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>

</div>

    
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/subject_result.js" defer></script>
</body>
</html>
