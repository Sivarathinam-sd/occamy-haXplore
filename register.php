<?php
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
</form>