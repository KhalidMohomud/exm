<?php
header("Content-Type: application/json"); 

include "../Config/conn.php";



function studensread($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT students.student_id, students.first_name, students.last_name, students.email, 
        students.contact_number, departments.department_name, class.class_name, students.date_of_birth, students.enrollment_year
        FROM students
        LEFT JOIN departments ON students.department_id = departments.department_id
        LEFT JOIN class  ON students.class_id = class.class_id;";
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


if(isset($_POST['action'])){
    $action = $_POST['action'];

         $action($conn); 
  
   
}else{
    echo json_encode(["status"=>"error","message"=>"action is requers"]);
}

?>