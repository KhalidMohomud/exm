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


// if (!function_exists('Register_student')) {
//   function Register_student($conn) {
//       extract($_POST);
//       $data = array();
//       $error_Array = array();

//       $File_name = $_FILES['image']['name'];
//       $File_type = $_FILES['image']['type'];
//       $File_size = $_FILES['image']['size'];

//       $allowed_image = ["image/png", "image/jpg", "image/jpeg", "image/avif"];
//       $max_size = 4 * 1024 * 1024;

//       $unique_name = uniqid() . ".png";

//       if (in_array($File_type, $allowed_image)) {
//           if ($File_size > $max_size) {
//               $error_Array[] = "This file size must be less than " . $max_size . " bytes.";
//           }
//       } else {
//           $error_Array[] = "This file type is not allowed: " . $File_type;
//       }

//       if (count($error_Array) <= 0) {
//           $query = "INSERT INTO `students`(`first_name`, `last_name`, `Gender`, `email`, `contact_number`, `department_id`, `class_id`, `date_of_birth`, `image`)
//                     VALUES ('$first_name','$last_name','$Gender','$email','$contact_number','$department_id','$class_id','$date_of_birth','$unique_name')";

//           $result = $conn->query($query);

//           if ($result) {
//               move_uploaded_file($_FILES['image']['tmp_name'], "./Upload/" . $unique_name);
//               $data = array("status" => true, "data" => "Registration is successful");
//           } else {
//               $data = array("status" => false, "data" => $conn->error);
//           }
//       } else {
//           $data = array("status" => false, "data" => $error_Array);
//       }

//       echo json_encode($data);
//   }
// }



// if (isset($_POST['user_id'])) {

//     // Assuming $conn is your database connection
//     $real_all = mysqli_query($conn, "SELECT students.student_id, students.first_name, students.last_name, students.email, 
//         students.contact_number, departments.department_name, class.class_name, students.date_of_birth, students.enrollment_year
//         FROM students
//         LEFT JOIN departments ON students.department_id = departments.department_id
//         LEFT JOIN class  ON students.class_id = class.class_id ");

//     if ($real_all && mysqli_num_rows($real_all) > 0) {
       
//         while ($row = mysqli_fetch_assoc($real_all)) { 

//             ?>
//             <tr>
//                 <td> <?php echo $row['student_id'];  ?></td>
//                 <td> <?php echo $row['first_name']; ?></td>
//                 <td> <?php echo $row['last_name']; ?></td>
//                 <td> <?php echo $row['email']; ?></td>
//                 <td> <?php echo $row['contact_number']; ?></td>
//                 <td> <button id = "btndelete" user_id = " <?php  echo $row['student_id'] ?>"  class = "btn btn-danger text-light">delete</button></td>
//                 <td> <button id="btnview" user_id=" <?php echo $row['student_id']; ?>" class="btn btn-info text-light">View</button></td>
//             </tr>
//             <?php
//         }
//     } else {
//         echo "Invalid Data";
//     }


//     echo json_encode(["status" => false, "message" => $conn->error]);

// }





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

<span class="close" id="Xbtn">&times;</span>
        
        <h1>Student Information: </h1>
        <h2>Student Name: <?php echo $row['first_name']; ?></h2>
        <h2>Email:  <?php echo $row['email']; ?></h2>
        <h2>Contact Number:</h2>
        <h2>Gender:</h2>
        <h2>Department Name:</h2>
        <h2>Class Name:</h2>
        <h2>Date:</h2>
        <img src="" alt="" id="image" name="image">

                
             
  <?php







      }
    }
}


//    

// if(isset($_POST['action'])){
//   $action = $_POST['action'];
  

//    $action($conn); 
//   // switch ($action) {

//   //        case 'Register_student':
//   //        Register_student($conn);
//   //        break;
//   //     case 'student_name':
//   //         student_name($conn);
//   //         break;

//   //         case 'semester_name':
//   //             semester_name($conn);
//   //             break;

//   //     case 'subject_name':
//   //         subject_name($conn);
//   //         break;
     
//   //     default:
//   //         echo json_encode(["status" => "error", "message" => "Unknown action"]);
//   //         break;
//   //}

 
// }else{
//   echo json_encode(["status"=>"error","message"=>"action is requers"]);
// }


?>



     