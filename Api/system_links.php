<?php

header("Content-type: application/json");

include '../config/conn.php';



function read_all_system_links(){
    $data = array();
    $data_array = array();

    $search_results = glob('../HTML/*.php');

    foreach($search_results as $sr){
        $pure_link = explode("/",$sr);
        $data_array[] = $pure_link[2];
    }

    if(count($search_results) > 0 ){
        $data = array("status" => true, "data" => $data_array);
    }else{
        $data = array("status" => false, "data" => "Not Found");
    }

    echo json_encode($data);

    // print_r($search_results);

}

function register_link($conn){

    extract($_POST);

    $data = array();
   
    // buliding the query and cAll the stored procedures
    $query = "INSERT INTO system_links (name,link,category_id) VALUES('$name','$link','$category')";

    // Excecution

    $result = $conn->query($query);

    // chck if there is an error or not
    if($result){
            $data = array("status" => true, "data" => "Registred 😊😊😎");  
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}

function update_link($conn){

    extract($_POST);

    $data = array();
   
    // buliding the query and cAll the stored procedures
    $query = "UPDATE system_links set name='$name', link = '$link', category_id = '$category' WHERE id = '$id'";

    // Excecution

    $result = $conn->query($query);

    // chck if there is an error or not
    if($result){

            $data = array("status" => true, "data" => "Updated Successfully");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);

}

function read_all_db_links($conn){

    $data = array();
    $array_data = array();
    $query = "SELECT * FROM system_links";
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

function get_link_info($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "SELECT * FROM `system_links` where id = '$id'";
    $result = $conn->query($query);

    if($result){

       $row = $result->fetch_assoc();
       
        $data = array("status" => true, "data" =>$row);

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


function delete_link_info($conn){

    extract($_POST);
    $data = array();
    $array_data = array();
    $query = "DELETE FROM `system_links` where id = '$id'";
    $result = $conn->query($query);

    if($result){

        $data = array("status" => true, "data" =>"Deleted Successfully 😘");

    }else{

        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action Required..."));
}