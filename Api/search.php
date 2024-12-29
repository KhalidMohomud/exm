<?php
header("Content-Type: application/json"); 

include "../Config/conn.php";


if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $sql = "SELECT * FROM students s  LEFT  JOIN  departments d ON d.department_id = s.department_id
LEFT JOIN class c ON c.class_id = s.class_id
WHERE first_name LIKE '%$searchQuery%' OR last_name LIKE
     '%$searchQuery%' OR email  LIKE '%$searchQuery%'    OR  d.department_name LIKE '%$searchQuery%' OR c.class_name   LIKE '%$searchQuery%'";
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