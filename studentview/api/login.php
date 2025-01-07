<?php
  session_start();


  header("Content-type: appliction/json");
  include '../config/conn.php';
  
  
  
  function p_login($conn){
  
      $data = array();
      extract($_POST);
  
      $query = "CALL p_login('$student_code',$password)";
      $reselt = $conn->query($query);
  
      if ($reselt) {
        $row = $reselt->fetch_assoc();
        $_SESSION['student_code'] = $row['student_code'];
        
        // echo '<pre>';
        // print_r($row); 
        // echo '</pre>';
        
        
    
        if (isset($row['msg']) && $row['msg'] === 'deny') {
             
            $data = ["status" => false, "message" => "Username or password is incorrect"];
        } else {
            foreach ($row as $key => $value) {
                $_SESSION[$key] = $value ?? 'Not Available';
                
            }
            $data = ["status" => true, "message" => "Login successful"];
        }
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