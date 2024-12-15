<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



// function result_read($conn){

//     $data = array();
//     $array_data = array();
//     $query = "SELECT * FROM `results` ";
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



// function result_fetch($conn){

//     extract($_POST);
//     $data = array();
//     $array_data = array();
//     $query = "SELECT * FROM `results` where result_id = '$result_id'";
//     $result = $conn->query($query);

//     if($result){

//        $row = $result->fetch_assoc();
       
//         $data = array("status" => true, "data" =>$row);

//     }else{

//         $data = array("status" => false, "data" => $conn->error);
//     }

//     echo json_encode($data);
// }




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
 
    $query = "UPDATE results SET result_name ='$result_name' WHERE result_id = '$result_id'";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Successfully😍😍😍😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}





function delete_results_info($conn){
  
    extract($_POST);
    //   $result_id=$_POST['result_id'];
 
   $query = "DELETE FROM `results` WHERE  result_id = '$result_id'";
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
}
   
}else{
    echo json_encode(["status"=>"error","message"=>"action is requers"]);
}


?>