


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/home.css">
  <style>
  
  .container {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
  }
  
  .dashboard {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
    position: relative;
    margin-top: 140px;
  }
  
  .card {
    display: flex;
    align-items: center;
    background-color: #ffffff;
    border-radius: 10px;
    width: 220px;
    height: 100px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  /* .icon-box {
    width: 60px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 24px;
  } */

  .icon-box {
  width: 60px;
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  font-size: 28px; 
  margin-left: 15px;
  color: white;
}

  
  .text-section {
    flex: 2;
    padding: 10px;
  }
  
  .text-section p {
    margin: 0;
    font-size: 14px;
    color: #666;
  }
  
  .text-section h2 {
    margin: 5px 0 0;
    font-size: 25px;
    color: #333;
    position: relative;
    
  }
  
  
  .students-card .icon-box {
    background-color: #F4C842; 
  }
  
  
  .class .icon-box {
    background-color: #B1B1B1; 
  }
  
  
  .users-card .icon-box {
    background-color: #58B361; 
  }
  
  
  .department-card .icon-box {
    background-color: #5C9DE8; 
  }
  
  
  
  </style>
</head>
<body>
  

<?php


include ("sidebar.php");


?>




<?php


include ("header.php");


?>




<div class="container">

  
<div class="dashboard">

  <div class="card students-card">
    <div class="icon-box">
 
      <i class="fas fa-user-graduate"></i> 
    </div>
    <div class="text-section">
      <p>Total Students</p>
      <h2><?php echo $total_students; ?></h2>
       
    </div>
  </div>

  <div class="card class">
    <div class="icon-box">
      <i class="icon">👥</i>
    </div>
    <div class="text-section">
      <p>Total Class</p>
      <h2>0</h2>
    </div>
  </div>

 
  <div class="card users-card">
    <div class="icon-box">
      <i class="icon">👥</i>
    </div>
    <div class="text-section">
      <p> Users</p>
      <h2>0</h2>
    </div>
  </div>

 
  <div class="card department-card">
    <div class="icon-box">
    <i class="fas fa-building"></i>
    
    </div>
    <div class="text-section">
      <p>Total Departments</p>
      <h2>3</h2>
    </div>
  </div>

</div>
  
</div>



          
    

       <!-- <div class="containertime">
        <div class="cloc">
            <span id="hrs">00</span>
            <span>:</span>
            <span id="min">00</span>
            <span>:</span>
            <span id="sec">00</span>
        </div>
      </div>
               -->

               <!-- <?php

#include "../config/conn.php";
#$totalStudents = getStudentCount($conn);




?> -->






      <?php

include "../config/conn.php";

$sql = "SELECT COUNT(student_id) AS total_students FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
    $row = $result->fetch_assoc();
    $total_students = $row['total_students'];
} else {
    $total_students = 0;
}

$conn->close();
  





?>
  
</body>
<script src="../node_modules/app.js"></script>
</html>
