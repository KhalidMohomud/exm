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
  <div class="container-classs">

         
<button class="Addbtn-class" id="openModalBtn"><span class="material-symbols-outlined">
    add
    </span></button>
   
    <!-- <h2 id="class_h2"> Section class</h2> -->
    <div class="container ">
     <table id="student_table" >
       <thead >
          <tr>
            <th>#</th>
            <th>first_name</th>
                    <th>Gender</th>
                    <th>email</th>
                    <th>contact_number</th>
              <th>Action</th>
          </tr>
       </thead>
       <tbody>
           
      
         

       </tbody>
 </table>
</div>
</div>



       
<div class="modal-class" id="modal-class">
    



        <span class="close" id="Xbtn">&times;</span>
        <h2>Student Registertion</h2>
       
        <form id="student_from">
            <div class="form-group">
                <div class="input-field">
                    <input type="hidden" id="update_id" >
                    <label for="first-name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" require>
                </div>
                <div class="input-field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" require>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" require>
                </div>
                <div class="input-field">
                    <label for="contact-number">Contact Number</label>
                    <input type="number" id="contact_number" name="contact_number" placeholder="Enter your contact number" require>
                </div>
            </div>

        <div class="form-group">
                <div class="input-field">
                 
            <label for="gender">Gender</label>
            <select id="Gender" name="Gender" require>
                <option value="" disabled selected> gender</option>
                <option value="1">male</option>
                <option value="2">Female</option>
               
            </select>
                </div>
                <div class="input-field">
                    <label for="department">Department</label>
                    <select  name="department_id" id="department_id" require>
                    <option value="" disabled selected>Select your Department</option>
                     
                    </select>

                    
                </div>
            </div>


           
        <div class="form-group">
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
              
        </div>

            <div class="form-group">
                
                <div class="input-field">
                    <label for="image">Profile Image</label>
                    <input type="file" id="fileimg"  name="fileimg" require>
                </div>
                <div class="showimg">
                        <img  id="show"  require>
                         </div>
            </div>
          
            <button type="submit" class="submit-btn">Register</button>
        </form>
  

</div>
</body>
<script type="text/javascript" src="../node_modules/app.js" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/studen.js" defer></script>
</html>
