<?php 
    include 'inc/connect.php';
    // Cách 1: không an toàn
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash = md5($password);
        // pass là 123456
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            echo '<pre>';
            print_r($user);
            echo '</pre>';
            setcookie("user", json_encode([
                'username' => $user['username'],
                'password' => $user['password']
            ]), time()+3600, "/"); 
            exit();
        } else {
            echo '<script>
                alert("Đăng nhập thất bại!");
                window.location.href="sql-injection.php";
            </script>';
        }
    }

    // Cách 2: an toàn, dùng Prepared Statement
    // if (isset($_POST['submit'])) {
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     $hash = md5($password);
    //     // pass là 123456
    //     $stmt = $con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    //     $stmt->bind_param("ss", $username, $hash);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if ($result->num_rows > 0) {
    //         $user = $result->fetch_assoc();
    //         echo '<pre>';
    //         print_r($user);
    //         echo '</pre>';
    //         setcookie("user", json_encode([
    //               'username' => $user['username'],
    //               'password' => $user['password']
    //         ]), time()+3600, "/"); 
    //         exit();
    //     } else {
    //         echo '<script>
    //             alert("Đăng nhập thất bại!");
    //             window.location.href="sql-injection.php";
    //         </script>';
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sql Injection</title>
    <?php include 'inc/style.php' ?>
</head>
<body>
    <div class="container">
        <h1>Demo Sql Injection</h1>
        <!-- admin'--  -->
        <form method="POST" class="mt-3" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Nhập username" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
            </div>
            <button class="btn btn-primary" name="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>