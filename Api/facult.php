
<?php
header("Content-Type: application/json"); 

include "../Config/conn.php";


// function register_Facult($conn){

//     extract($_POST);

//     $data = array();
   
//     $query = "INSERT INTO faculties ( name, department_id) VALUES ('$name','$department_id')";
//     $result = $conn->query($query);

   
//     if($result){

//             $data = array("status" => true, "data" => "Registered Succesfuuly");
    
//     }else{
//         $data = array("status" => false, "data" => $conn->error);
//     }

//     echo json_encode($data);

// }





function register_Facult($conn){

    extract($_POST);
    $data = array();
    $query = "INSERT INTO faculties ( name, department_id) VALUES
     ('$name','$department_id')";
    $result = $conn->query($query);
    if($result){

            $data = array("status" => true, "data" => "Registered Succesfuuly");
    
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}




function facult_read($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT f.faculty_id ,  f.name , d.department_name FROM `faculties` f  JOIN  departments d on f.department_id = d.department_id  ";
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

function fechdate_faculties($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `faculties` where faculty_id = '$faculty_id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function update_facult($conn){
    $data = array();
    extract($_POST);

    

    $query = "UPDATE faculties SET name ='$name', department_id = '$department_id' where  faculty_id = '$faculty_id'";
    $result = $conn->query($query);

    if($result){
            $data = array("status" => true, "data" => "Updated Successfully");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}








function delete_facult($conn){
  
    extract($_POST);
      // $studentId=$_POST['StudentId'];
 
   $query = "DELETE FROM `faculties` WHERE  faculty_id = '$faculty_id'";
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