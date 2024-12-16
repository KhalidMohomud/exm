<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



function semester_read($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `semester` ";
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



function semester_fetch($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `semester` where semester_id = '$semester_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}




function register_semester($conn){

    extract($_POST);
    $data = array();
    $query = "INSERT INTO `semester`( semester_name) VALUES ('$semester_name')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "Registered Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function Update_semester($conn){

    extract($_POST);

    $data = array();
 
    $query = "UPDATE semester SET semester_name ='$semester_name' WHERE semester_id = '$semester_id'";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Successfully😍😍😍😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}





function delete_semesters_info($conn){
  
    extract($_POST);
    
 
   $query = "DELETE  FROM `semester` WHERE  semester_id = '$semester_id'";
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