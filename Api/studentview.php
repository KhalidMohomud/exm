
<?php
// session_start();
header("Content-Type: application/json"); 

include "../Config/conn.php";




// function Register_student($conn){

//     extract($_POST);
//     $data = array();
//     $query = "INSERT INTO `students`( `first_name`, `last_name`, `Gender`, `email`, `contact_number`, `department_id`, `class_id`, `date_of_birth`, `image`)
//      VALUES ('$first_name','$last_name','$Gender','$email','$contact_number','$department_id','$class_id','$date_of_birth','$image')";
//     $result = $conn->query($query);
//     if($result){

//             $data = array("status" => true, "data" => "Registered Succesfuuly");
    
//     }else{
//         $data = array("status" => false, "data" => $conn->error);
//     }

//     echo json_encode($data);

//}







// function In($conn) {
//     $new_id = ''; 
//     $Date = array();

//     $query = "SELECT * FROM `users` ORDER BY users.id DESC LIMIT  1";
//     $result = $conn->query($query);

//     if ($result) {
//         if ($result->num_rows > 0) {
            
//             $row = $result->fetch_assoc();
//             $new_id = ++$row['id']; 
//         } else {
        
//             $new_id = 'HB0001';
//         }

//         // $Date = array("status" => true, "data" => $new_id);
//     } else {
//         // Query failed
//         $Date = array("status" => false, "data" => $conn->error);
//     }

//     return $new_id;
//     // echo json_encode($Date);

// }





// ...........page ka result waaye
function studensread($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT students.student_id, students.first_name, students.last_name, students.email, 
        students.contact_number, departments.department_name, class.class_name, students.date_of_birth, students.enrollment_year
        FROM students
        LEFT JOIN departments ON students.department_id = departments.department_id
        LEFT JOIN class  ON students.class_id = class.class_id  ";
    $result = $conn->query($query);

    

    if($result){

        while($row = $result->fetch_assoc()){
            $array_data [] = $row;
        }

        $data = array("status" => true, "data" => $array_data);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// ...........page ka result waaye
function student_name($conn){
    
      extract($_POST);
      $sql = "SELECT * FROM students WHERE class_id = '$class_id'";
      $result = mysqli_query($conn, $sql);
  
      if (mysqli_num_rows($result) > 0) {
          $students = [];
          while ($row = mysqli_fetch_assoc($result)) {
              $students[] = $row;  
          }
      
          echo json_encode(['status' => true, 'data' => $students]);
      } else {
         
          echo json_encode(['status' => false, 'message' => 'No students found']);
      }
}

// ...........page ka result waaye
function semester_name($conn){
    
    extract($_POST);
   $sql = "  SELECT * FROM `class_semester`  cs LEFT JOIN  semester s ON cs.semester_id = s.semester_id
     LEFT JOIN class c ON cs.class_id = c.class_id WHERE c.class_id  = '$class_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $semester = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $semester[] = $row;  
        }
    
        echo json_encode(['status' => true, 'data' => $semester]);
    } else {
       
        echo json_encode(['status' => false, 'message' => 'No students found']);
    }
}


function subject_name($conn){
    
    extract($_POST);
    $sql = " SELECT * FROM `semester_subject` s_sub LEFT JOIN  semester s  ON s_sub.semester_id = s.semester_id
 LEFT JOIN subjects  sub ON s_sub.subject_id = sub.subject_id
 LEFT JOIN class c ON c.class_id = s_sub.class_id    WHERE  c.class_id = '$class_id'  AND s_sub.semester_id = '$semester_id'  ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $subjects = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $subjects[] = $row;  
        }
    
        echo json_encode(['status' => true, 'data' => $subjects]);
    } else {
       
        echo json_encode(['status' => false, 'message' => 'No students date']);
    }
}


// function subject_name($conn) {
//     // Check if required POST variables are set
//     if (!isset($_POST['semester_id']) || !isset($_POST['class_id'])) {
//         echo json_encode(['status' => false, 'message' => 'Invalid input']);
//         return;
//     }

//     // Sanitize inputs
//     $semester_id = mysqli_real_escape_string($conn, $_POST['semester_id']);
//     $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);

//     $sql = "
//         SELECT sub.subject_id, sub.subject_name 
//         FROM `semester_subject` s_sub
//         LEFT JOIN semester s ON s_sub.semester_id = s.semester_id
//         LEFT JOIN subjects sub ON s_sub.subject_id = sub.subject_id
//         LEFT JOIN class c ON c.class_id = s_sub.class_id
//         WHERE s_sub.semester_id = '$semester_id' AND c.class_id = '$class_id'
//     ";

//     $result = mysqli_query($conn, $sql);

//     if ($result && mysqli_num_rows($result) > 0) {
//         $subjects = [];
//         while ($row = mysqli_fetch_assoc($result)) {
//             $subjects[] = $row;
//         }

//         echo json_encode(['status' => true, 'data' => $subjects]);
//     } else {
//         echo json_encode(['status' => false, 'message' => 'No subjects found']);
//     }
// }
function generateID($conn) {
    $new_id = ''; 
    $Date = array();

    $query = "SELECT * FROM `students`   ORDER BY  students.student_code DESC LIMIT  1";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            $new_id = ++$row['student_code']; 
        } else {
        
            $new_id = 'HR0001';
        }

        $Date = array("status" => true, "data" => $new_id);
    } else {
        // Query failed
        $Date = array("status" => false, "data" => $conn->error);
    }

    return $new_id;
    // echo json_encode($Date);

}

if (!function_exists('Register_student')) {
    function Register_student($conn) {
        $new_id = generateID($conn);
        extract($_POST);
        $data = array();
        $error_Array = array();

        $File_name = $_FILES['image']['name'];
        $File_type = $_FILES['image']['type'];
        $File_size = $_FILES['image']['size'];

        $allowed_image = ["image/png", "image/jpg", "image/jpeg", "image/avif"];
        $max_size = 4 * 1024 * 1024;

        $unique_name = uniqid() . ".png";

        if (in_array($File_type, $allowed_image)) {
            if ($File_size > $max_size) {
                $error_Array[] = "This file size must be less than " . $max_size . " bytes.";
            }
        } else {
            $error_Array[] = "This file type is not allowed: " . $File_type; 
        }

        if (count($error_Array) <= 0) {
            $query = "INSERT INTO `students`(`student_code`,`first_name`, `last_name`, `Gender`, `email`, `contact_number`, `department_id`, `class_id`, `date_of_birth`, `image`)
                      VALUES ( '$new_id', '$first_name','$last_name','$Gender','$email','$contact_number','$department_id','$class_id','$date_of_birth','$unique_name')";

            $result = $conn->query($query);

            if ($result) {
                move_uploaded_file($_FILES['image']['tmp_name'], "../Upload/" . $unique_name);
                $data = array("status" => true, "data" => "Registration is successful");
            } else {
                $data = array("status" => false, "data" => $conn->error);
            }
        } else {
            $data = array("status" => false, "data" => $error_Array);
        }

        echo json_encode($data);
    }
}


function student_table($conn){
    session_start();

    $data = array();
    $array_data = array();
    $query = " SELECT `student_id`, `first_name`,  `Gender`, `email`, d.department_name, c.class_name, `contact_number` FROM `students` s  JOIN departments d  ON s.department_id = d.department_id
  LEFT JOIN class c ON  c.class_id  = s.class_id ";
    $result = $conn->query($query);

    if($result){

        while($row = $result->fetch_assoc()){
            $array_data [] = $row;
        }

        $data = array("status" => true, "data" => $array_data);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}



function student_table_date($conn){
    session_start();

    $data = array();
    $array_data = array();
    $query = " SELECT s.student_code, s.first_name ,s.last_name , s.Gender, s.email, s.contact_number,
 d.department_name, c.class_name, s.date_of_birth , s.image  FROM `students` s  JOIN departments d  ON s.department_id = d.department_id
  LEFT JOIN class c ON  c.class_id  = s.class_id   ORDER by s.student_code ASC ";
    $result = $conn->query($query);

    if($result){

        while($row = $result->fetch_assoc()){
            $array_data [] = $row;
        }

        $data = array("status" => true, "data" => $array_data);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}



function student_from($conn){
   
    $data = array();
    $messagDate = array();
     extract($_POST);

    $query = "SELECT * FROM `students` WHERE student_id = '$student_id'";

    $result = $conn->query($query);


    if($result){
        
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }
        $messagDate = array( "status" => true,"data"=>$data);

    }else{
        $messagDate = array( "status" => false, "data"=>$conn->error);
    }

 echo json_encode($messagDate);
}




// function students_Delete($conn){

//     $date = array();
//     extract($_POST);

//     $store_addy = array();


//      $query = " DELETE FROM `students` WHERE student_id = '$student_id'";
//      $result = $conn->query($query);

//     if($result){       
//         unlink('../Upload/'.$student_id.".png");      
        
//         $store_addy = array("status"=>true , "data" => $store_addy);


//     }else{

//         $store_addy = array("status"=>false,"data" => $conn->error);

//     }
//     echo json_encode($store_addy);
// }
function students_Delete($conn) {
    $date = array();
    extract($_POST);

    $store_addy = array();

   
    $query = "SELECT image FROM `students` WHERE student_id = '$student_id'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['image']; 

    
        $delete_query = "DELETE FROM `students` WHERE student_id = '$student_id'";
        $delete_result = $conn->query($delete_query);

        if ($delete_result) {
           
            if (file_exists($file_path)) {
                unlink($file_path); 
            }

            $store_addy = array("status" => true, "data" => "Student deleted successfully");
        } else {
            $store_addy = array("status" => false, "data" => $conn->error);
        }
    } else {
        $store_addy = array("status" => false, "data" => "Student not found or no associated image");
    }

    echo json_encode($store_addy);
}

function update_student($conn) {
    extract($_POST);
    $data = array();
    $error_array = array();

    if (!empty($_FILES['image']['tmp_name'])) {
        error_log("Image is being uploaded...");
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];

        $allowedImages = ["image/jpg", "image/jpeg", "image/png", "image/avif"];
        $max_size = 15 * 1024 * 1024; // 15 MB
        $unique_name = uniqid() . ".png"; 
        $upload_path = "../Upload/" . $unique_name;

        error_log("File Name: $file_name, File Type: $file_type, File Size: $file_size");

        if (in_array($file_type, $allowedImages)) {
            if ($file_size > $max_size) {
                $error_array[] = "File size must be less than 15 MB.";
            }
        } else {
            $error_array[] = "Invalid file type: $file_type";
        }

        if (count($error_array) <= 0) {
            $fetch_query = "SELECT image FROM `students` WHERE student_id = '$student_id'";
            $fetch_result = $conn->query($fetch_query);

            if ($fetch_result && $fetch_result->num_rows > 0) {
                $row = $fetch_result->fetch_assoc();
                $current_image_path = "../Upload/" . basename($row['image']);
                if (file_exists($current_image_path)) {
                    unlink($current_image_path);
                }
            }

            $query = "UPDATE `students` SET 
                        `first_name` = '$first_name',
                        `last_name` = '$last_name',
                        `Gender` = '$Gender',
                        `email` = '$email',
                        `contact_number` = '$contact_number',
                        `department_id` = '$department_id',
                        `class_id` = '$class_id',
                        `date_of_birth` = '$date_of_birth',
                        `image` = '$upload_path'
                      WHERE `student_id` = '$student_id'";
            error_log("Executing query: $query");

            $result = $conn->query($query);
            if ($result) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    $data = array("status" => true, "data" => "Successfully updated with new image");
                } else {
                    error_log("Failed to move uploaded file.");
                    $data = array("status" => false, "data" => "Failed to move uploaded file.");
                }
            } else {
                error_log("Database update failed: " . $conn->error);
                $data = array("status" => false, "data" => $conn->error);
            }
        } else {
            error_log("Validation errors: " . implode(", ", $error_array));
            $data = array("status" => false, "data" => $error_array);
        }
    } else {
        error_log("No image uploaded.");
        $query = "UPDATE `students` SET 
                    `first_name` = '$first_name',
                    `last_name` = '$last_name',
                    `Gender` = '$Gender',
                    `email` = '$email',
                    `contact_number` = '$contact_number',
                    `department_id` = '$department_id',
                    `class_id` = '$class_id',
                    `date_of_birth` = '$date_of_birth'
                  WHERE `student_id` = '$student_id'";
        error_log("Executing query: $query");

        $result = $conn->query($query);
        if ($result) {
            $data = array("status" => true, "data" => "Successfully updated without changing the image");
        } else {
            error_log("Database update failed: " . $conn->error);
            $data = array("status" => false, "data" => $conn->error);
        }
    }

    echo json_encode($data);
}





if(isset($_POST['action'])){
    $action = $_POST['action'];
    
//    $action($conn); 
    switch ($action) {
          case 'student_table_date':
            student_table_date($conn);
            break;
            case 'generateID':
                generateID($conn);
                break;
             case 'student_table':
                student_table($conn);
                break;
               case 'student_from':
                student_from($conn);
                break;
             case 'students_Delete':
                students_Delete($conn);
                break;
                case 'update_student':
                    update_student($conn);
                break;    
           case 'Register_student':
           Register_student($conn);
           break;
        case 'student_name':
            student_name($conn);
            break;

            case 'semester_name':
                semester_name($conn);
                break;

        case 'subject_name':
            subject_name($conn);
            break;
       
        default:
            echo json_encode(["status" => "error", "message" => "Unknown action"]);
            break;
   }
  
   
}else{
    echo json_encode(["status"=>"error","message"=>"action is requers"]);
}

?>