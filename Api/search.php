<?php

include('../config/conn.php');




$first_name = $_POST['first_name'];
// extract($_POST);
$sql="select *from students where first_name  Like '$first_name%'";

$query=mysqli_query($conn,$sql);
// $data='';
while($row=mysqli_fetch_assoc($query)){

    $data .= "<tr> 
    <td>" . $row['id'] . "</td>

    <td>" . $row['last_name'] . "</td>
    <td>" . $row['email'] . "</td>
    <td>" . $row['contact_number'] . "</td>
        <td>" . $row['department_name'] . "</td>
            <td>" . $row['class_name'] . "</td>
               <td>" . $row['date_of_birth'] . "</td>
                   <td>" . $row['date_of_birth'] . "</td> 
                       <td>" . $row['enrollment_year'] . "</td>

   

</tr>";

 
}


 //      <td>
    //     <button id='btnveiw' user_id='" . $row['id'] . "'  class = btn btn-info text-light'>View</button>
    // </td>


    // <td>
    //     <button id='btnupdate' data-bs-toggle='modal' data-bs-target='#updatemodal' user_id='" . $row['id'] . "' class='btn btn-primary text-light'>Update</button>
    // </td>
    // <td>
    //     <button id='btndelete' user_id='" . $row['id'] . "' class='btn btn-danger text-light'>Delete</button>
    // </td>
// <td>
// <button id='btndelete' user_id='" . $row['id'] . "' class='btn btn-success text-light'>Print</button>
// </td>
echo $data;
















?>
