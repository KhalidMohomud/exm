<?php


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
 
    $query = " UPDATE `exam_results` SET `student_id`='$student_id',
    `midterm`='$midterm',`coursework`='$coursework',`final`='$final',`reexam`='$reexam',`subject_id`='$subject_id'  WHERE result_id = '$result_id'";
  

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





if(isset($_POST['action'])){
    $action = $_POST['action'];

        //  $action($conn); 
  
         switch ($action) {


        case 'register_result':
            register_result($conn);
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