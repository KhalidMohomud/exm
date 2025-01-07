<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #dfe6e5;
        
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1000px;
            height: 60%;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(204, 201, 201, 0.1);
            overflow: hidden;
             
        }

        .illustration {
            flex: 1;
            /* background: #6C63FF; */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .illustration img {
            max-width: 120%;
            border-radius: 10px;
            height: 150%;
        }

        .login-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }

        .login-section h1 {
            font-size: 28px;
            color: #6C63FF;
            margin-bottom: 10px;
        }

        .login-section h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 30px;
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #6C63FF;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .actions a {
            font-size: 14px;
            color: #6C63FF;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: white;
            background-color: #6C63FF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background-color: #594dcf;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Illustration Section -->
        <div class="illustration">
            <img src="../Image/image_login.jpg" alt="Illustration">
        </div>

   
        <div class="login-section">
            <h1>Login!</h1>
            <div id="alertBox" class="alert"></div>

            <form onsubmit="handleLogin(event)" id="login_from">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                </div>

              
                <button type="submit" class="btn">Login</button>
            </form>

           
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../node_modules/login.js" defer></script>
</html>
