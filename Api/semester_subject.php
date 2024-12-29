<?php


header("Content-Type: application/json"); 

include "../config/conn.php";



function semester_subject_read($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT 
    s_sub.subject_semester_id, 
    c.class_name,
    s.semester_name, 
    su.subject_name 
FROM 
    `semester_subject` s_sub 
RIGHT JOIN 
    semester s ON s.semester_id = s_sub.semester_id
RIGHT JOIN  
    subjects su ON s_sub.subject_id = su.subject_id
RIGHT JOIN class c ON c.class_id= s_sub.class_id    
WHERE 
    s_sub.subject_semester_id IS NOT NULL
    ORDER BY 
    s.semester_name ASC, 
      s_sub.subject_semester_id ASC,
    su.subject_name ASC;
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



function semester_subject_fetch($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `semester_subject` where subject_semester_id = '$subject_semester_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


// register_semester_subject($conn);

function register_semester_subject($conn){

    extract($_POST);
    $data = array();

    $query = "INSERT INTO `semester_subject` ( `class_id`, `semester_id`, `subject_id`) VALUES ( '$class_id','$semester_id', '$subject_id')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "Registered Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}


function Update_semester_subject($conn){
    extract($_POST);
    $data = array();
    $query = "UPDATE semester_subject SET class_id = '$class_id',  semester_id = '$semester_id' ,subject_id = '$subject_id' where  subject_semester_id = '$subject_semester_id'";
  

    $result = $conn->query($query);

   
    if($result){
            $data = array("status" => true, "data" => "Updated Successfully😍😍😍😍");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}





function delete_semester_subject_info($conn){
  
    extract($_POST);
    
 
   $query = "DELETE FROM `semester_subject` where subject_semester_id = '$subject_semester_id'";
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