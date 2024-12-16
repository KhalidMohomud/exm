<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



function class_semesterment_read($conn){

    $data = array();
    $array_data = array();
    $query = " SELECT c_s.class_semester_id,  s.semester_name,  c.class_name FROM `class_semester`  c_s  RIGHT JOIN  class c ON   c_s.class_id = c.class_id 
   RIGHT JOIN semester s ON s.semester_id = c_s.semester_id  where  c_s.class_semester_id is not Null";
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



function class_semester_fetch($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `class_semester` where class_semester_id = '$class_semester_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


// register_class_semester($conn);

function register_class_semester($conn){

    extract($_POST);
    $data = array();

    $query = "INSERT INTO `class_semester` ( `semester_id`, `class_id`) VALUES ( '$semester_id', '$class_id')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "Registered Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function Update_class_semester($conn){

    extract($_POST);

    $data = array();
 
    $query = "UPDATE class_semester SET class_id = '$class_id'  ,semester_id ='$semester_id' WHERE class_semester_id = '$class_semester_id'";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Successfully😍😍😍😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}





function delete_class_semesterments_info($conn){
  
    extract($_POST);
    
 
   $query = "DELETE c_s FROM class_semester c_s RIGHT JOIN class c ON c_s.class_id = c.class_id
   RIGHT JOIN semester s ON s.semester_id = c_s.semester_id WHERE  class_semester_id = '$class_semester_id'";
   $reselt = $conn->query($query);
   if($reselt){
    echo json_encode(["status"=>"success", "message"=>"success delete"]);
   }else{
    echo json_decode(["status"=>"error","message"=>$conn->error()]);
   }

}





if(isset($_POST['action'])){
    $action = $_POST['action'];

         $action($conn); 
  
   
}else{
    echo json_encode(["status"=>"error","message"=>"action is requers"]);
}


?>