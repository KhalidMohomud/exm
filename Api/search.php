<?php
header("Content-Type: application/json"); 

include "../Config/conn.php";


if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $sql = "SELECT * FROM students WHERE first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    $students = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }

  
    echo json_encode($students);
    exit;
}



?>