<?php
  session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f9fafc;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 680px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
        }

        .semester-select {
            padding: 15px;
            background: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }

        .semester-select select {
            width: 60%;
            padding: 15px 45px;
            font-size: 1em;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            outline: none;
            font-size: 18px;
        }

        #student table {
            width: 80%;
            border-collapse: collapse;
            margin: 15px 0;
        }
         #subject table{
            width: 80%;
            border-collapse: collapse;
            margin: 15px 0;

         }
         .summary-table {
            width: 40%;
            border-collapse: collapse;
            margin: 15px 0;
            position: relative;
            margin-left: 200px;

         }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #e5e7eb;
        }

        th {
            background-color: #3b82f6;
            color: #fff;
            font-size: 0.9em;
        }

        tr:nth-child(even) {
            background-color: #f9fafc;
        }

        .summary-table td:first-child {
            font-weight: bold;
        }

        /* .......total section ka */
         
        .result_total{
            position: relative;
           margin-left: 200px;
           margin-top:30px;
           margin-bottom:20px ;
           

        }
        .result_total h2{
             font-family: Arial, Helvetica, sans-serif;
             font-size: 20px;
   }

        .footer {
            background: #f1f5f9;
            text-align: center;
            padding: 10px;
            font-size: 0.9em;
            color: #6b7280;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 480px) {
            th, td {
                font-size: 0.8em;
            }

            .header {
                font-size: 1em;
            }

            .semester-select select {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header">
           Port Student 
        </div>

        <div class="semester-select">
            <select id="semester_id" name="semester_id">
            <option value="">Select Semester</option>
                <?php
                include('../config/conn.php');
                
                // $student_code = $_SESSION['student_code'];
               
                $sql = mysqli_query($conn, "SELECT s.semester_id ,s.semester_name
                 FROM semester s   ");
                
                
                if (mysqli_num_rows($sql) > 0) {
                
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo "<option value='{$row['semester_id']}'>{$row['semester_name']} </option>";
                        $semester_name  = $row['semester_name'];
                      
                        
                        
                    }
                  
                } else {
                    echo "<option value=''>No students found</option>";
                }
                 ?> 
            </select>
        </div>

        

       
        <table id="student">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><?php echo ($_SESSION['first_name']) ?></td>
              <td><?php echo ($_SESSION['class_name'])  ?></td>
               <td><?php echo ($_SESSION['department_name']) ?></td>

                    
                </tr>
            </tbody>
        </table>

       
        <table id="subject_reslut_re">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Midterm</th>
                    <th>Coursework</th>
                    <th>Final</th>
                    <th>Reexam</th>
                    <th>Total Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    
                </tr>
            </tbody>
        </table>

      
        <!-- <table class="select_total">
            <tbody>
                <tr>
                    <td>Total Marks:</td>
                    <td>600</td>
                </tr>
                <tr>
                    <td>Percentage:</td>
                    <td>86%</td>
                </tr>
                <tr>
                    <td>Grade:</td>
                    <td>B+</td>
                </tr>
            </tbody>
        </table> -->
        <div class="result_total">
               <h2>Total: 
               
               </h2>
                <h2>Precentage: </h2>
                <h2>Grade: </h2>
                <h2>Positions: </h2>
            </div>
  
        <div class="footer">
            &copy; 2024  KHALID MOHOMUD HERSI
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/view.js" defer></script>
</html>
