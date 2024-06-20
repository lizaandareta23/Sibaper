<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, #2dbd6e, #a6f77b); /* Gradient background for body */
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-container h2 {
            text-align: center;
        }

        .login-container input[type="email"],
        .login-container input[type="password"],
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-container input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .register-link {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login RUTILAHU</h2>
        <form action="periksa.php" method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="sandi" placeholder="Kata Sandi">
            <input type="submit" value="Login">
        </form>
        <p class="register-link">Belum punya akun? <a href="tambah_user.php">Daftar sekarang</a></p>
    </div>
</body>
</html>
