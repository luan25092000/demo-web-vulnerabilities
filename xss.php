<?php
    if (isset($_POST['submit'])) {
        $keyword = $_POST['q'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS</title>
    <?php include 'inc/style.php' ?>
</head>
<body>
    <div class="container">
        <h1>Demo XSS</h1>
        <!-- 
        <script>
            function getCookie(name) {
                const m = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
                return m ? m[2] : null;
            }

            let raw = getCookie("user"); 
            if (raw) {
                let decoded = decodeURIComponent(raw);
                try {
                    let obj = JSON.parse(decoded);
                    console.log("User cookie:", obj);
                } catch (e) {
                    console.log("Cookie không phải JSON:", decoded);
                }
            } else {
                console.log("Không tìm thấy cookie 'user'");
            }
        </script>
        -->
        <form method="POST" class="mt-3" action="">
            <div class="form-group">
                <input type="text" class="form-control" name="q" placeholder="Nhập từ khóa" required>
            </div>
            <button class="btn btn-primary" name="submit">Tìm kiếm</button>
        </form>
        <?php if (!empty($keyword)): ?>
            <!-- Cách 1: không an toàn -->
            <p class="mt-3">Kết quả tìm kiếm: <?= $keyword ?></p>
            <!-- Cách 2: an toàn -->
            <!-- <p class="mt-3">Kết quả tìm kiếm: <?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?></p> -->
        <?php endif; ?>
    </div>
</body>
</html>