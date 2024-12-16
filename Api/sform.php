<?php
header("Content-type: appliction/json");

include "../Config/conn.php";
// if (isset($_POST ['insert'])) {
//    extract($_POST);

//     $query = "INSERT INTO `students`( `first_name`, `last_name`, `email`,  `contact_number`, `department_id`, `class_id`, `date_of_birth`, `enrollment_year`) 
//     VALUES ('$first_name','$last_name','$email','$contact_number','$department_id','$class_id','$date_of_birth','$enrollment_year')";
//     $result =$conn->query($query);
//     if ($result) {
  
//       // echo' <a href="../views/studenttables.php"></a>';
//           echo "sucess "
//     }
//     else{
//       echo $reset; 
//     }
// }



if(isset($_POST['student_id'])){

  extract($_POST);
  $query = mysqli_query($conn,"DELETE FROM `students` WHERE student_id = $student_id");

  if($query){
  
      echo json_encode(["status"=>true,"message"=>"success delete"]);
  }else{
      echo json_encode(["status"=>false,"message"=> mysqli_connect_error()]);
  }

}


if (isset($_POST['read'])) {

    // Assuming $conn is your database connection
    $real_all = mysqli_query($conn, "SELECT students.student_id, students.first_name, students.last_name, students.email, 
        students.contact_number, departments.department_name, class.class_name, students.date_of_birth, students.enrollment_year
        FROM students
        LEFT JOIN departments ON students.department_id = departments.department_id
        LEFT JOIN class  ON students.class_id = class.class_id ");

    if ($real_all && mysqli_num_rows($real_all) > 0) {
       
        while ($row = mysqli_fetch_assoc($real_all)) { 

            ?>
            <tr>
                <td> <?php echo $row['student_id'];  ?></td>
                <td> <?php echo $row['first_name']; ?></td>
                <td> <?php echo $row['last_name']; ?></td>
                <td> <?php echo $row['email']; ?></td>
                <td> <?php echo $row['contact_number']; ?></td>
                <td> <button id = "btndelete" user_id = " <?php  echo $row['student_id'] ?>"  class = "btn btn-danger text-light">delete</button></td>
                <td> <button id="btnview" user_id=" <?php echo $row['student_id']; ?>" class="btn btn-info text-light">View</button></td>
            </tr>
            <?php
        }
    } else {
        echo "Invalid Data";
    }


    echo json_encode(["status" => false, "message" => $conn->error]);

}





if(isset($_POST['student_id'])){
  

  extract($_POST);
  $view =  mysqli_query($conn, " SELECT students.student_id, students.first_name, students.last_name, students.email, 
        students.contact_number, departments.department_name, class.class_name, students.date_of_birth, students.enrollment_year
        FROM students
        LEFT JOIN departments ON students.department_id = departments.department_id
        LEFT JOIN class  ON students.class_id = class.class_id where student_id  = '$student_id'");
  // $res = mysqli_query($conn ,$view);
   if($view &&  mysqli_num_rows($view)>0){

      foreach($view  as $row){


       ?>



        <div class="modal-header">
                          <h3> <?php  echo $row['user_name'] ;   ?> </h3>

                          <div class="modal-btn">
                            <!-- <button> Close</button> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                         </div>
                       
                             <div class="modal-body">
                           <ul>
                            <div>
                              <li><strong> User: ID </strong></li>
                              <li><strong> User: Name </strong></li>
                              <li><strong> User: Type </strong></li>
                              <li><strong> User: Number </strong></li>
                              <li><strong> User: status </strong></li>
                             
                            </div>

                                 <div class="date">
                                 <li><span><?php  echo $row['id'] ;   ?> </span></li>
                                  <li><span>  <?php  echo $row['user_name'] ;   ?> </span></li>
                                  <li><span>  <?php  echo $row['Type'] ;   ?> </span></li>
                                  <li><span><?php  echo $row['number'] ;   ?></span></li>
                                  <li><span> <?php  echo $row['date'] ;   ?> </span></li>
                                 </div>
                           </ul>
                             </div>


                                   
                                 


<?php

      }

   }




}




?>