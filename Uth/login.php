<?php 

session_start();

include('../config/conn.php');

if (isset($_POST['submit'])) {
    extract($_POST);
    

    $sql = "SELECT * FROM users WHERE user_name = '$user_name' AND password = '$password'";
    
    $result = $conn->query($sql);
    

    $data = mysqli_fetch_array($result);
    

    if (!empty($data)) {
        $_SESSION['Type'] = $data['Type'];
        $_SESSION['user_name'] = $data['user_name'];
        
        header('location: ../pages/home.php');
    }
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- <link rel="stylesheet" href="../style/stype.css"> -->
  
  <link rel="stylesheet" href="../style/login.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
     <div class="panal">
        <header>
            <h2>School managment system</h2>
         </header>
     </div>
    
    <div class="container">
          <div class="cont_login">
            <h2>Login</h2>
          </div>
        <form action="" method="post">
             
            <label for=""> User_name</label>
            <input type="text" placeholder="Enter user name" name="user_name" id="user_name"> 
            <label for="">password</label>
            <input type="password" placeholder="Enter password" name="password" id="password">

            <button name="submit" type = "submit">login</button>

        </form>

    </div>

     <footer>
        <div class="logo">
            <h2>Hersi <span>ICT</span>Solution</h2>
        </div>
          <div class="number">
            <h3>Number :   0619006007</h3>
          </div>
     </footer>

</body>
<
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script type="text/javascript" src="../node_modules/login.js" defer></script> -->
</html>