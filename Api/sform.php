<?php


include "../Conf/conn.php";
if (isset($_POST ['insert'])) {
   extract($_POST);

    $query = "INSERT INTO `students`( `first_name`, `last_name`, `email`,  `contact_number`, `department_id`, `class_id`, `date_of_birth`, `enrollment_year`) 
    VALUES ('$first_name','$last_name','$email','$contact_number','$department_id','$class_id','$date_of_birth','$enrollment_year')";
    $result =$conn->query($query);
    if ($result) {
  
      // echo' <a href="../views/studenttables.php"></a>';
          echo "sucess "
    }
    else{
      echo $reset; 
    }
}
?>