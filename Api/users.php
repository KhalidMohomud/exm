<?php

header("Content-Type: application/json"); 


include "../Config/conn.php";

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(["status"=>"error","message"=>"action is requers"]);
}


function UserList($conn){

    // $date = array();
    $store_addy = array();


     $query = "SELECT `id`, `user_name`, `Type`, `status`, `image`, `Date` FROM `users`   ";

     $result = $conn->query($query);

    if($result){

        while($row = $result->fetch_assoc()){
            $store_addy [ ] = $row;

             
        }
       
         echo json_encode(["status"=>"success","message"=>$store_addy]);


    }else{

        echo json_encode(["status"=>"error","message"=>mysqli_connect_error()]);

    }
    // echo json_encode($store_addy);

}






function Isert_Users($conn){
    extract($_POST);
    $data = array();
    $error_Array = array();
  
       $File_name = $_FILES['image']['name'];
       $File_type = $_FILES['image']['type'];
       $File_size  = $_FILES['image']['size'];


       $allowed_image = ["image/png","image/jpg","image/jpeg" , "image/avif"];
       $max_size =  4 * 1024 * 1024;
        $save_name = $user_name  . ".png";


       if(in_array($File_type,$allowed_image)){

         if($File_size > $max_size){

            $error_Array [] = "This file is size is less than" .$max_size;

         }



       }else{
          $error_Array [] = "This file is not allows" .$File_type;
       }


       if(count($error_Array) <= 0){
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO `users`( `user_name`,`password` ,`Type`,`image`) 
        VALUES ('$user_name','$password','$Type','$save_name')";
    
        $result = $conn->query($query);
        
        if($result){
           move_uploaded_file($_FILES['image']['tmp_name'], "../Upload/".$save_name);

            $data = array("status"=>true , "data"=> "Register is successfully");
               
          }  else{
                $data = array("status"=>false ,"data"=> $conn->error);
            } 
        
         

       }
       else {

        $data = array("status"=>false ,"data"=> $error_Array);
    }
    echo json_encode($data);
};





//  function Isert_Users($conn){
//     extract($_POST);
//    // $allowed_image = ["image/png","image/jpg","image/jpeg" , "image/avif"];
//     $save_name = $user_name . ".png";
    
//     $query = "INSERT INTO `users`( `user_name`,`password` ,`Type`,`image`) 
//     VALUES ('$user_name','$password','$Type','$save_name')";

//     $result = $conn->query($query);
//     if($result){
//         move_uploaded_file($_FILES['image']['tmp_name'], "../Upload/".$save_name);

//           echo json_encode(["status"=>true , "data"=> "Register is successfully"]);
            
//        }  else{
//              echo json_encode(["status"=>false ,"data"=> $conn->error]);
//          } 
//  }








function update_user($conn){
    
    extract($_POST);

    $data = array();

    if(!empty($_FILES['image']['tmp_name'])){
        $error_arrray = array();

    
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size']; 
    
        $save_name = $user_name . ".png"; 
    

    
        $allowedImages = ["image/jpg","image/jpeg","image/png"];
        $max_size = 15 * 1024 * 1024;
    
       if(in_array($file_type,$allowedImages)){
    
            if($file_size > $max_size){
                
                $error_arrray[] = $file_size/1024/1024 . " MB Files Size must be Less Then " . $max_size/1024/1024 . " MB";
            }
       }else{
            $error_arrray[] = "This file is not Allowed " .$file_type ;
       }
    
    
        // buliding the query and cAll the stored procedures
        if(count($error_arrray) <= 0){
             
    
            $query = "UPDATE users set users.user_name = '$user_name', password = '$password' ,users.Type = '$Type' where users.id = '$id'";
    
          
        
            $result = $conn->query($query);
        
        
            if($result){
        
                move_uploaded_file($_FILES['image']['tmp_name'], "../upload/".$save_name);
                $data = array("status" => true, "data" => "SucessFully Update");
        
            }else{
                $data = array("status" => false, "data" => $conn->error);
            }
    
        }else{
            $data = array("status" => false, "data" => $error_arrray);
        }
    }
    else{
       
        

        $query = "UPDATE users set users.user_name = '$user_name', password = '$password' , users.Type = '$Type' where users.id = '$id'";
    
        // Excecution
    
        $result = $conn->query($query);
    
        // chck if there is an error or not
        if($result){
    
          
            $data = array("status" => true, "data" => "SucessFully Updated");
    
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }

    }
    
   
    echo json_encode($data);

}












function readforms($conn){
  
    $data = array();
    $messagDate = array();
     extract($_POST);

    $query = "SELECT  `user_name`,    `password`  `Type` , `Image` FROM users  where id = '$id'";

    $result = $conn->query($query);


    if($result){
        
        while($row = $result->fetch_assoc()){
            $data [] = $row;
        }
        $messagDate = array( "status" => true,"data"=>$data);

    }else{
        $messagDate = array( "status" => false, "data"=>$conn->error);
    }

 echo json_encode($messagDate);
}





 function UserDelete($conn){

    $date = array();
    extract($_POST);

    $store_addy = array();


     $query = "DELETE FROM `users` WHERE id = '$id'";

     $result = $conn->query($query);

    if($result){       
        unlink('../Upload/'.$user_name.".png");      
        
        $store_addy = array("status"=>true , "data" => $store_addy);


    }else{

        $store_addy = array("status"=>false,"data" => $conn->error);

    }
    echo json_encode($store_addy);
}


?>