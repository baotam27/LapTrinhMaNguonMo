<!DOCTYPE html>
<html>

<body>
    <button onclick="changeBg()">Đổi màu nền</button>
    <script>
        function changeBg() {
            document.body.style.backgroundColor = "#" +
                Math.floor(Math.random() * 16777215).toString(16);
        }
    </script>
</body>

</html>