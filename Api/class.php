<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



function class_read($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `class` ";
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



function class_fetch($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `class` where class_id = '$class_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}




function register_class($conn){

    extract($_POST);
    $data = array();
    $query = "INSERT INTO `class`( class_name ,course_id) VALUES ('$class_name','$course_id')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "Registered Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}



function Update_class($conn){

    extract($_POST);

    $data = array();
 
    $query = "UPDATE class SET class_name ='$class_name' , course_id = '$course_id'  WHERE class_id = '$class_id'";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Success");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}






function delete_class_info($conn){
  
    extract($_POST);
  
 
   $query = "DELETE FROM `class` WHERE  class_id = '$class_id'";
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