<!-- <?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fnm  = $_POST['fnm'];
    $unm  = $_POST['unm'];
    $pnm  = $_POST['pnm'];
    $pwd  = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];
    $role = $_POST['role'];
    if (isset($_GET['role']) && $_GET['role'] == 'officer') {
        $role = 2;
    } elseif (isset($_GET['role']) && $_GET['role'] == 'admin') {
        $role = 1;
    } else {
        $role = 3;
    }
    if ($pwd !== $cpwd) {
        die("❌ Passwords do not match");
    }

    /* 🔍 Check Username */
    $checkUsername = $conn->query("SELECT id FROM users WHERE unm='$unm'");
    if ($checkUsername->num_rows > 0) {
        die("❌ Username already exists. Please use a different username.");
    }

    /* 🔍 Check Phone Number */
    $checkPhone = $conn->query("SELECT id FROM users WHERE pnm='$pnm'");
    if ($checkPhone->num_rows > 0) {
        die("❌ Phone number already exists. Please use a different phone number.");
    }

    /* ✅ Insert if both are unique */
    $conn->query("
        INSERT INTO users (fnm, unm, pnm, pwd, role)
        VALUES ('$fnm', '$unm', '$pnm', '$pwd', '$role')
    ");

    header("Location: login.php");
    exit;
}
?>

<form method="post">
    <h2>
        <?php
        if (isset($_GET['role'])) {
            echo ucfirst($_GET['role']);
        } else {
            echo "User";
        }
        ?>
        Registration
    </h2>

    <input type="hidden" name="role" value="<?php echo $role; ?>">

    Full Name: <input type="text" name="fnm" required><br><br>
    Username: <input type="text" name="unm" required><br><br>
    Phone No: <input type="text" name="pnm" required><br><br>
    Password: <input type="password" name="pwd" required><br><br>
    Confirm Password: <input type="password" name="cpwd" required><br><br>

    <button type="submit">Register</button>
</form> -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Registration</title>

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .form-container {
        background: #ffffff;
        padding: 30px 35px;
        width: 380px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 6px;
        color: #555;
    }

    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        outline: none;
        transition: 0.3s;
    }

    .form-group input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 2px rgba(78,115,223,0.15);
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: #4e73df;
        border: none;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background: #2e59d9;
    }

    .role-text {
        text-align: center;
        font-size: 13px;
        margin-top: 15px;
        color: #777;
    }
</style>
</head>

<body>

<div class="form-container">

    <h2>
        <?php
        if (isset($_GET['role'])) {
            echo ucfirst($_GET['role']);
        } else {
            echo "User";
        }
        ?> Registration
    </h2>

    <form method="post">

        <input type="hidden" name="role" value="<?php echo $role ?? ''; ?>">

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fnm" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="unm" required>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="pnm" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pwd" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="cpwd" required>
        </div>

        <button class="btn-submit" type="submit">Register</button>

        <!-- <div class="role-text">
            Role will be assigned automatically
        </div> -->

    </form>

</div>

</body>
</html>
