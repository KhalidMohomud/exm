<?php

session_start(); 
$student_code = $_SESSION['student_code'] ?? null;
 header("Content-type: appliction/json");
  
 include '../config/conn.php';
if (!isset($_SESSION['student_code'])) {
    echo json_encode(["status" => false, "message" => "User not logged in"]);
    exit;
}

function report_result($conn){
    $student_code = $_SESSION['student_code'];
   
    extract($_POST);
      $data = array();
      $array_data = array();
      $query = " CALL view_result('$student_code',$semester_id)";
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



  function Total($conn) {
    $data = array();

   
    // $_student_id = $_POST['_student_id'];
    // $_semester_id = $_POST['_semester_id'];
    extract($_POST);
    $student_code = $_SESSION['student_code'];

   
    $queryTotal = "SELECT SUM(er_r.total_marks) AS Total  
                   FROM exam_results er_r 
                   LEFT JOIN semester_subject sub ON er_r.subject_id = sub.subject_id
                   LEFT JOIN students s ON s.student_id = er_r.student_id
                   WHERE s.student_code = '$student_code' AND sub.semester_id =  '$semester_id'";

   
    $queryPercentage = "SELECT SUM(ex_r.total_marks)/COUNT(ex_r.subject_id) AS percentage 
                        FROM exam_results ex_r  
                        LEFT JOIN semester_subject sub ON ex_r.subject_id = sub.subject_id 
                        LEFT JOIN students s ON s.student_id = ex_r.student_id 
                        WHERE s.student_code= '$student_code' AND sub.semester_id  = '$semester_id'";

    $resultTotal = $conn->query($queryTotal);
    $resultPercentage = $conn->query($queryPercentage);

    if ($resultTotal && $resultPercentage) {
        $rowTotal = $resultTotal->fetch_assoc();
        $rowPercentage = $resultPercentage->fetch_assoc();

        $totalMarks = $rowTotal['Total'] ?? 0;
        $percentage = round($rowPercentage['percentage'] ?? 0, 2);

       
        $grade = "F";
        if ($percentage >= 90) $grade = "A+";
        elseif ($percentage >= 80) $grade = "A";
        elseif ($percentage >= 70) $grade = "B";
        elseif ($percentage >= 60) $grade = "C";
        elseif ($percentage >= 50) $grade = "D";

      
        $data = array(
            "status" => true,
            "data" => [
                "Total" => $totalMarks,
                "Percentage" => $percentage,
                "Grade" => $grade
            ]
        );
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    // Return JSON Response
    echo json_encode($data);
}












  //s.student_code = '$student_code'     
//   function subject_read($conn){

//     $data = array();
//     $array_data = array();
//     $query = "SELECT 
//         s.first_name AS 'Student Name',
//         s.last_name AS 'Last Name',
//         c.class_name as 'Class Name',
//         d.department_name AS 'Department'
    
//     FROM 
//         Students s
//     JOIN 
//         Departments d 
//     ON 
//         s.department_id = d.department_id
//           JOIN  class c ON  c.class_id = s.class_id
    
//     WHERE  
//      s.password = 123  AND
//         s.student_code = 'HR0001'; ";
//     $result = $conn->query($query);

//     if($result){

//         while($row = $result->fetch_assoc()){
//             $array_data [] = $row;
//         }

//         $data = array("status" => true, "data" => $array_data);

//     }else{

//         $data = array("status" => false, "data" => $conn->error);
//     }

//     echo json_encode($data);
// }













 



  if(isset($_POST['action'])){
      
    $action=$_POST['action'];
    $action($conn);
  
}else{
    echo json_encode(array("status" => false, "data" => "Actionka ayaa loo bahan yahay"));
}

 ?>