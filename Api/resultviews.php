<?php

session_start();
header("Content-Type: application/json"); 

include "../config/conn.php";


function report_result($conn){
  extract($_POST);
    $data = array();
    $array_data = array();
    $query = "  SELECT 
    sub.subject_name AS `Subject Name`,
    CONCAT(COALESCE(er.midterm, 0), ' (30)') AS `Midterm`,
    CONCAT(COALESCE(er.coursework, 0), ' (10)') AS `CourseWork`,
    CONCAT(COALESCE(er.final, 0), ' (60)') AS `Final`,
    CONCAT(COALESCE(er.reexam, 0), ' (69)') AS `ReExam`,
    (COALESCE(er.midterm, 0) + 
     COALESCE(er.coursework, 0) + 
     COALESCE(er.final, 0) + 
     COALESCE(er.reexam, 0)) AS `Total`,
    CASE 
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 90 THEN 'A+'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 80 THEN 'B'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 70 THEN 'C'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 60 THEN 'D'
        WHEN (COALESCE(er.midterm, 0) + 
              COALESCE(er.coursework, 0) + 
              COALESCE(er.final, 0) + 
              COALESCE(er.reexam, 0)) >= 50 THEN 'E'
        ELSE 'F'
    END AS `Grade`
    
FROM 
    Exam_Results er
LEFT JOIN 
    Subjects sub 
    ON er.subject_id = sub.subject_id
LEFT JOIN 
    semester_subject sb 
    ON sub.subject_id = sb.subject_id
LEFT JOIN 
    students s 
    ON er.student_id = s.student_id
WHERE 
    s.student_id = '$_student_id'
    and sb.semester_id  = '$_semester_id'
   
ORDER BY 
    s.first_name, sub.subject_name
      ";
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





function result_read_student($conn){
    extract($_POST);
      $data = array();
      $array_data = array();
      $query = "  SELECT
    s.first_name AS 'Student Name',
    s.last_name AS 'Last Name',
    c.class_name AS 'Class Name',
    d.department_name AS 'Department'
FROM
    Students s
JOIN Departments d ON
    s.department_id = d.department_id
JOIN class c ON
    c.class_id = s.class_id
WHERE
    
        s.student_id = '$_student_id' ";
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
    $query = " SELECT* FROM `exam_results` ex LEFT JOIN students s ON ex.student_id = s.student_id
         LEFT JOIN subjects sub ON ex.subject_id = sub.subject_id  where ex.result_id = '$result_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}













function Total($conn) {
    $data = array();

    // Retrieve input data from POST request
    $_student_id = $_POST['_student_id'];
    $_semester_id = $_POST['_semester_id'];

    // Query for Total Marks
    $queryTotal = "SELECT SUM(er_r.total_marks) AS Total  
                   FROM exam_results er_r 
                   LEFT JOIN semester_subject sub ON er_r.subject_id = sub.subject_id
                   LEFT JOIN students s ON s.student_id = er_r.student_id
                   WHERE s.student_id = '$_student_id' AND sub.semester_id = '$_semester_id'";

    // Query for Percentage
    $queryPercentage = "SELECT SUM(ex_r.total_marks)/COUNT(ex_r.subject_id) AS percentage 
                        FROM exam_results ex_r  
                        LEFT JOIN semester_subject sub ON ex_r.subject_id = sub.subject_id 
                        LEFT JOIN students s ON s.student_id = ex_r.student_id 
                        WHERE s.student_id = '$_student_id' AND sub.semester_id = '$_semester_id'";

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

        // Response Data
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


if(isset($_POST['action'])){
    $action = $_POST['action'];

        //  $action($conn); 
  
         switch ($action) {


        case 'register_result':
            register_result($conn);
            break;
            case 'Total':
                Total($conn);
                break;
                case 'report_result':
                    report_result($conn);
                    break;
                    case 'result_read_student':
                        result_read_student($conn);
                        break;
                
            case 'result_fetch':
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