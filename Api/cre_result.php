<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



function result_read($conn){
  extract($_POST);
    $data = array();
    $array_data = array();
    $query = " SELECT ex.result_id, s.first_name, sub.subject_name, midterm ,coursework ,final,reexam, ex.total_marks, ex.grade FROM `exam_results` ex LEFT JOIN students s ON ex.student_id = s.student_id
LEFT JOIN subjects sub ON ex.subject_id = sub.subject_id   WHERE ex.result_id is not null  and s.first_name = LOWER('$first_name')
ORDER BY s.first_name ASC ";
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



function subject_read_r($conn){
    extract($_POST);
      $data = array();
      $array_data = array();
      $query = " SELECT ex.result_id, s.first_name, sub.subject_name, midterm ,coursework ,final,reexam, ex.total_marks, ex.grade FROM `exam_results` ex LEFT JOIN students s ON ex.student_id = s.student_id
      LEFT JOIN subjects sub ON ex.subject_id = sub.subject_id   WHERE ex.result_id is not null    and sub.subject_name = '$subject_name'    AND s.class_id =  '$class_id' 
      ORDER BY s.first_name ASC ";
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
  
  
 

function result_fetch($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = " SELECT ex.result_id,s.first_name ,sub.subject_name, ex.midterm, ex.coursework,ex.final,ex.reexam   FROM `exam_results` ex LEFT JOIN students s ON ex.student_id = s.student_id
 LEFT JOIN subjects sub ON ex.subject_id = sub.subject_id  where ex.result_id  = '$result_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}




function register_result($conn){

    extract($_POST);
    $data = array();
    $query = "INSERT INTO `exam_results`( `student_id`, `midterm`, `coursework`, `final`, `reexam`,  `subject_id`)
     VALUES ('$student_id','$midterm','$coursework','$final','$reexam','$subject_id')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "create_resulte Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function Update_result($conn){

    extract($_POST);

    $data = array();
 
    $query = " UPDATE `exam_results`
        SET 
            midterm = '$midterm',
            coursework = '$coursework',
            final = '$final',
            reexam = '$reexam'
        WHERE 
            result_id = '$result_id' ";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Successfully😍😍😍😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}





function delete_results($conn){
  
    extract($_POST);

 
   $query = " DELETE FROM exam_results  where result_id  = '$result_id'";
   $reselt = $conn->query($query);
   if($reselt){
    echo json_encode(["status"=>"success", "message"=>"success delete"]);
   }else{
    echo json_decode(["status"=>"error","message"=>$conn->error()]);
   }

}


if (isset($_POST['search'])) {
    extract($_POST);
    // $searchQuery = $_GET['search'];
    $sql = "SELECT * FROM exam_results er  LEFT  JOIN  students s ON er.student_id = s.student_id
LEFT JOIN subjects sb ON er.subject_id = sb.subject_id
WHERE s.student_id LIKE '%$first_name%'   ";
    $result = $conn->query($sql);

    $students = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }

  
    echo json_encode($students);
    exit;
}



// function search_results($conn) {
//     if (isset($_GET['search'])) {
//         extract($_GET);

//         // Initialize variables to avoid undefined variable errors
//         $first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
//         $subject_name = isset($_GET['subject_name']) ? $_GET['subject_name'] : '';

//         // Prepare SQL query
//         $sql = "SELECT * FROM exam_results er
//                 LEFT JOIN students s ON er.student_id = s.student_id
//                 LEFT JOIN subjects sb ON er.subject_id = sb.subject_id
//                 WHERE s.first_name LIKE '%$first_name%'
//                 OR sb.subject_name LIKE '%$subject_name%'";

//         $result = $conn->query($sql);

//         $students = array();
//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $students[] = $row;
//             }
//         }

//         echo json_encode($students);
//         exit;
//     } else {
//         echo json_encode(["status" => "error", "message" => "search parameter is missing"]);
//         exit;
//     }
// }



if(isset($_POST['action'])){
    $action = $_POST['action'];

        //  $action($conn); 
  
         switch ($action) {

         case 'subject_read_r':
            subject_read_r($conn);
            break;
        case 'register_result':
            register_result($conn);
            break;
            case 'result_read':
                result_read($conn);
                break;
            case ' result_fetch':
            result_fetch($conn);
             break;
             case 'Update_result':
              Update_result($conn);
                break;
                case 'delete_results':
                    delete_results($conn);
                    break;   
}
   
}else{
    echo json_encode(["status"=>"error","message"=>"action is requers"]);
}


?>