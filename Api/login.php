<?php

  session_start();

header("Content-type: appliction/json");

include '../config/conn.php';



function login($conn){

    $data = array();
    extract($_POST);

    $query = "CALL login ('$name','$password')";
    $reselt = $conn->query($query);

    if($reselt){

        $row = $reselt->fetch_assoc();

        if(isset($row['msg'])){


            if($row['msg']== 'deny'){
                $data =  array("status"=>false,"message"=> "username or password is incorrect");
            }
            else{
                $data  = array("status"=>false,"message"=> "user logi by admin");
            }
            
        }else{
             foreach($row as $key => $value){
                $_SESSION[$key] = $value;
             }
             $data  = array("status"=>true,"message"=> "sucess for login");
        }

    }else{
        $data  = array("status"=>false,"message"=>$conn->error());
    }


        echo json_encode($data);
}


if(isset($_POST['action'])){
    
    $action=$_POST['action'];
    $action($conn);
  
}else{
    echo json_encode(array("status" => false, "data" => "Actionka ayaa loo bahan yahay"));
}



?>