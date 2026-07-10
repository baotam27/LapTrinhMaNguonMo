<!DOCTYPE html>
<html>

<body>
    <input type="text" id="txt" placeholder="Nhập gì đó">
    <button onclick="showText()">Hiển thị</button>
    <div id="output"></div>
    <script>
        function showText() {
            document.getElementById("output").innerText =

                document.getElementById("txt").value;
        }
    </script>
</body>

</html>