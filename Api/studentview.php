<?php
header("Content-Type: application/json"); 

include "../Config/conn.php";


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
 LEFT JOIN subjects  sub ON s_sub.subject_id = sub.subject_id  WHERE s_sub.semester_id = '$semester_id'";

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






if(isset($_POST['action'])){
    $action = $_POST['action'];
    
  
    $action($conn); 
    // switch ($action) {


    //     case 'student_name':
    //         student_name($conn);
    //         break;

    //         case 'semester_name':
    //             semester_name($conn);
    //             break;

    //     case 'subject_name':
    //         subject_name($conn);
    //         break;
       
    //     default:
    //         echo json_encode(["status" => "error", "message" => "Unknown action"]);
    //         break;
    // }
  
   
}else{
    echo json_encode(["status"=>"error","message"=>"action is requers"]);
}

?>