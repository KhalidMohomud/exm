
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student</title>
    <link rel="stylesheet" href="../style/stype.css">
    <link rel="stylesheet" href="../style/student.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        /* Search Bar Styles */
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            margin-top: 140px;
            margin-left: -47rem;
           
        }

        .search-form {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 50px;
            padding: 10px;
            transition: all 0.3s ease;
            width: 50%;
            max-width: 250px;
        }

        .search-input {
            width: 90%;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            outline: none;
            border-radius: 50px;
            box-sizing: border-box;
             color: #7a7a7a;
            transition: width 0.4s ease-in-out;
        }

        .search-input:focus {
            width: 100%;
            background-color: #e9f5f1;
        }

        .search-button {
            background-color: #007bff;
            border: none;
            border-radius: 50%;
            padding: 12px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button i {
            color: white;
            font-size: 18px;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        .search-input::placeholder {
            color: #7a7a7a;
            font-style: italic;
        }

        .search-container:hover .search-form {
            box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.10);
        }
    </style>

</head>

<body class="">

    <?php include("sidebar.php"); ?>

    <?php include("header.php"); ?>

    <div class="container-classs">
        <!-- Search Bar Section -->
        <div class="search-container">
            <form action="#" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Search for students..." id="search-bar">
                <!-- <button type="submit" class="search-button"> -->
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Add New Student Button -->
        <button class="Addbtn-class" id="openModalBtn">
            <span class="material-symbols-outlined">
                add
            </span>
        </button>

        <div class="container ">
            <table id="student_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table content will go here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Student Information -->
    <div class="modal_information">
        
        <span class="close" id="Xbtn">&times;</span>
        
        <h1>Student Information: </h1>
        <h2>Student Name: 
    <?php 
    echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Not available'; 
    ?>
</h2>
<h2>Email: 
    <?php 
    echo isset($_SESSION['email']) ? $_SESSION['email'] : 'Not available'; 
    ?>
</h2>
        <h2>Contact Number:</h2>
        <h2>Gender:</h2>
        <h2>Department Name:</h2>
        <h2>Class Name:</h2>
        <h2>Date:</h2>
        <img src="" alt="" id="image" name="image">
     
    </div>
   
    <!-- Modal for Student Registration -->
    <div class="modal-class" id="modal-class">
        <span class="close" id="Xbtn2">&times;</span>
        <h2>Student Registration</h2>

        <form id="student_from">
            <div class="form-group">
                <div class="input-field">
                    <input type="hidden" id="update_id">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" require>
                </div>
                <div class="input-field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" require>
                </div>
            </div>
            <div class="form-group">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" require>
                </div>
                <div class="input-field">
                    <label for="contact-number">Contact Number</label>
                    <input type="number" id="contact_number" name="contact_number" placeholder="Enter your contact number" require>
                </div>
            </div>

            <div class="form-group">
                <div class="input-field">
                    <label for="gender">Gender</label>
                    <select id="Gender" name="Gender"  require>
                        <option value="" disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="department">Department</label>
                    <select name="department_id" id="department_id" require>
                        <option value="" disabled selected>Select your Department</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="input-field">
                    <label for="class">Class</label>
                    <select id="class_id" name="class_id" require>
                        <option value="" disabled selected>Select your class</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="date-of-birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" require>
                </div>
            </div>

            <div class="form-group">
                <div class="input-field">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" require>
                </div>
                <div class="showimg">
                    <img id="show" require>
                </div>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>

</body>

<script type="text/javascript" src="../node_modules/app.js" defer></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../node_modules/studen.js" defer></script>

</html>
