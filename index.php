<!-- <!DOCTYPE html>
<html>
<head>
    <title>Index</title>
</head>
<body>
    <h2>Select Role</h2>
    <a href="admin_login.php">Admin</a><br><br>
    <a href="register.php?role=farmer">Farmer</a><br><br>
    <a href="register.php?role=officer">Officer</a>
</body>
</html>  -->
<!DOCTYPE html>
<html>

<head>
    <title>Select Role</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #5d8f95, #acb6e5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        form {
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .admin {
            background-color: #b03a2e;
            color: white;
        }

        .farmer {
            background-color: #2e7d32;
            color: #2d3436;
        }

        .officer {
            background-color: #1565c0;
            color: white;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Select Role</h2>

        <form action="admin_login.php" method="get">
            <button class="admin" type="submit">Admin</button>
        </form>

        <form action="register.php" method="get">
            <input type="hidden" name="role" value="farmer">
            <button class="farmer" type="submit">Farmer</button>
        </form>

        <form action="register.php" method="get">
            <input type="hidden" name="role" value="officer">
            <button class="officer" type="submit">Officer</button>
        </form>
    </div>

</body>

</html>