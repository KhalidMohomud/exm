<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



function department_read($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `departments` ";
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



function department_fetch($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `departments` where department_id = '$department_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}




function register_department($conn){

    extract($_POST);
    $data = array();
    $query = "INSERT INTO `departments`( department_name) VALUES ('$department_name')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "Registered Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function Update_department($conn){

    extract($_POST);

    $data = array();
 
    $query = "UPDATE departments SET department_name ='$department_name' WHERE department_id = '$department_id'";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Successfully😍😍😍😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}





function delete_departments_info($conn){
  
    extract($_POST);
    //   $department_id=$_POST['department_id'];
 
   $query = "DELETE FROM `departments` WHERE  department_id = '$department_id'";
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