<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../style/stype.css">
  <link rel="stylesheet" href="../style/UserAuthorize.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="">
  



<?php


include ("sidebar.php");


?>

<?php


include ("header.php");


?>
            
              <div class="container-modale ">

             
         <div class="modal-profile">

            <div class="profile">
           <img src="../Image/Logoka.jpg" alt="">
           <h3>Khalid123</h3>
            <div class="logouot">
           <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
          </div>
          </div>
           </div>
           <div class="list-profile">
      <li class="lgn">
        <a href="#logon.php"  id="setting">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
          <span>Setting</span>
          
        </a>
          </li>

          <li class="lgn">
            <a href="#logon.php"  id="setting">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Zm80 0h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
              <span>profile</span>
              
            </a>
              </li>

            </div>
         </div>

         <div class="containertime">
            <div class="cloc">
                <span id="hrs">00</span>
                <span>:</span>
                <span id="min">00</span>
                <span>:</span>
                <span id="sec">00</span>
            </div>
        </div>

  <main>

    <div class="main-container">

   
        <form id="User_auth">
            
             
            <select name="user_id" id="user_id" class="form-control">
                <!-- <option value="" disabled selected>Select User</option>
                <option value="" >Reg_User</option>
                <option value="" >pay_User</option>
                <option value="" >Exm_User</option> -->

            </select>        
                
          
                    <fieldset class="authority-main">
                        <legend>
                            <input type="checkbox" id="all_authority" name="all_authority"> All Authorities
                         </legend>
                   <div class="body-authority">

                        <fieldset class="Academy-main">
                            <legend>
                                <input type="checkbox" id="Academy" name="Academy">  Academy
                             </legend>

                       <div class="secons_le">
                             <legend>
                                <input type="checkbox" id="dashboard1" name="dashboard"> Dashboard
                            </legend>

                          <legend>
                                <input type="checkbox" id="Registration" name="Registration"> Registration
                            </legend>
                              <label >
                                <input type="checkbox" id="Student" name="Student"> Student
                              </label>
                              <label >
                                <input type="checkbox" id="teachers" name="teachers"> Teachers
                              </label>
                              <legend>
                                <input type="checkbox" id="attendecs" name="attendecs"> Attendecs
                            </legend>
                            <label >
                                <input type="checkbox" id="Student" name="Student"> Student
                              </label>
                              <label >
                                <input type="checkbox" id="teachers" name="teachers"> Teachers
                              </label>
                            
                        </div>
                     </fieldset>


                             <fieldset class="Exmination-main">
                                <legend>
                                    <input type="checkbox" id="Examination" name="Examination">  Examination
                                 </legend>
                                 </fieldset> 


                                   <fieldset class="Payment-main">
                                    <legend>
                                        <input type="checkbox" id="Payment" name="Payment">  Payment
                                     </legend>
                                     </fieldset>

                                      <fieldset class="super_adim-main">
                                        <legend>
                                            <input type="checkbox" id="super_adim" name="super_adim">  super_adim
                                         </legend>
                                         <div class="secons_le">
                                            <legend>
                                               <input type="checkbox" id="dashboard1" name="dashboard"> Dashboard
                                           </legend>
               
                                           <legend>
                                               <input type="checkbox" id="Registration" name="Registration"> Registration
                                           </legend>
                                             <label >
                                               <input type="checkbox" id="Student" name="Student"> Student
                                             </label>
                                             <label >
                                               <input type="checkbox" id="teachers" name="teachers"> Teachers
                                             </label>
                                             <legend>
                                               <input type="checkbox" id="attendecs" name="attendecs"> Attendecs
                                           </legend>
                                           <label >
                                               <input type="checkbox" id="Student" name="Student"> Student
                                             </label>
                                             <label >
                                               <input type="checkbox" id="teachers" name="teachers"> Teachers
                                             </label>
                                            
                                             <legend>
                                                <input type="checkbox" id="Authentication" name="Authentication"> Authentication
                                            </legend>

                                            <label >
                                                <input type="checkbox" id="Users" name="Users"> Users
                                              </label>

                                              <label>
                                                <input type="checkbox" id="Category" name="Category"> Category
                                              </label>

                                            <label >
                                                <input type="checkbox" id="Links" name="Links"> Links
                                              </label>
                                              <label >
                                                <input type="checkbox" id="UserAuthorize" name="UserAuthorize"> UserAuthorize
                                              </label> 

                                       </div> 
                                      
                                         </fieldset>   
                                           <button type="submit" id="submit" class="btn">Authorize User</button>
                                         


                             

                            </div> 
                          








                                
                                    
                           
       





    
               
       
                       
                        
  
   


  </main>
</body>

 <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  -->
<script type="text/javascript" src="../node_modules/app.js" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/UserAuthority.js" defer></script>
</html>