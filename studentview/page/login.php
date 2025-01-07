<?php
 session_start();
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/stype.css">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        color: #fff;
    }

    .login-container {
        background:#ffff;
        border-radius: 15px;
        padding: 30px;
        width: 50%;
        height: 400px;
        max-width: 400px;
        text-align: center;
        border: 1px solid rgb(111, 111, 151);
    }

    .login-container h2 {
        margin-bottom: 10px;
        font-size: 26px;
        font-weight: 600;
        color: black;
    }

    .login-container .subtitle {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }

   .logo{
    display: flex;
    position: relative;
    margin-left: 100px;
    gap: 1em;
   }
    .logo h2{
  color: rgb(75, 75, 233);
  font-weight: bold;
  font-size: 30px;
  margin-top: 10px;
}
img {
  width: 60px;
  height: 60px;
 }
   
    .alert {
        display: none;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #4caf50;
        color: #fff;
    }

    .alert-error {
        background-color: #f44336;
        color: #fff;
    }
    #login_from {
        text-align: left;
        margin-bottom: 15px;
    }

    #login_from label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #333;
        font-weight: 500;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 14px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease, background-color 0.3s ease;
    }

    .login-container input[type="text"]:focus,
    .login-container input[type="password"]:focus {
        border-color: #2575fc;
        background-color: #fff;
        outline: none;
    }

    .login-container button {
        width: 100%;
        padding: 12px;
        background:#2575fc;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }

    .login-container button:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    .login-container .forgot-password {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .login-container .forgot-password a {
        text-decoration: none;
        color: #2575fc;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .login-container .forgot-password a:hover {
        color: #6a11cb;
    }


    @media (max-width: 768px) {
        .login-container {
            padding: 20px;
        }

        .login-container h2 {
            font-size: 22px;
        }

        .login-container button {
            font-size: 14px;
        }
    }
</style>

</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="../Image/logo.png" alt="">
             <h2>HER<span>SI</span></h2>
          </div>
        <h2>Login</h2>
        <div id="alertBox" class="alert"></div>
        <form   method="POST"  id="login_from"  >
            <label for="">student code</label>
            <input type="text" id="student_code" name="student_code" placeholder="studentcode" required>
            <label for="">password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" name ="submit" id="submit">Login</button>
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>

    
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../node_modules/login.js" defer></script>
</html>

