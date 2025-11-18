<?php 
    include 'inc/connect.php';
    session_start();
    // Tạo CSRF token
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // User A là người chuyển tiền
    $senderId = 1;

    if (isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        // User B là người nhận tiền
        $receiverId = $_POST['receiver'];

        // Check CSRF token
        if ($_SESSION['csrf_token'] != $_POST['csrf_token']) {
            http_response_code(401);
            echo "CSRF token không hợp lệ!";
            exit;
        }

        // trừ tiền người gửi
        $sql = "UPDATE demo_csrf SET amount = amount - $amount WHERE id = $senderId";
        mysqli_query($con, $sql);

        // cộng cho người nhận
        $sql = "UPDATE demo_csrf SET amount = amount + $amount WHERE id = $receiverId";
        mysqli_query($con, $sql);

        echo '<script>
            alert("Chuyển tiền thành công!");
            window.location.href="csrf.php";
        </script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF</title>
    <?php include 'inc/style.php' ?>
</head>
<body>
    <div class="container">
        <h1>Demo CSRF</h1>
        <!-- admin'--  -->
        <form method="POST" class="mt-3" action="">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="hidden" name="receiver" value="2">
            <div class="form-group">
                <label>Số tiền</label>
                <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền" required>
            </div>
            <button class="btn btn-primary" name="submit">Chuyển</button>
        </form>
    </div>
</body>
</html>