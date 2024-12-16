<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



function subject_read($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `subjects` ";
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



function subject_fetch($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `subjects` where subject_id = '$subject_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}




function register_subjects($conn){

    extract($_POST);
    $data = array();
    $query = "INSERT INTO `subjects`( subject_name) VALUES ('$subjects_name')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "Registered Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function Update_subject($conn){

    extract($_POST);

    $data = array();
 
    $query = "UPDATE subjects SET subject_name ='$subjects_name' WHERE subject_id = '$subject_id'";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Successfully😍😍😍😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}





function delete_subjects_info($conn){
  
    extract($_POST);
    //   $subject_id=$_POST['subject_id'];
 
   $query = "DELETE FROM `subjects` WHERE  subject_id = '$subject_id'";
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