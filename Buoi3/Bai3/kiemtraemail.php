<html>

<body>
    <form onsubmit="return validateEmail()">
        <input type="text" id="email" placeholder="Nhập email">
        <button type="submit">Kiểm tra</button>
    </form>
    <p id="msg"></p>
    <script>
        function validateEmail() {
            let email = document.getElementById("email").value;
            let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (regex.test(email)) {
                document.getElementById("msg").innerText = "Email hợp lệ";
            } else {
                document.getElementById("msg").innerText = "Email không hợp lệ";

            }
            return false;
        }
    </script>
</body>

</html>