<!DOCTYPE html>
<html>

<body>
    <input type="text" id="item">
    <button onclick="addItem()">Thêm</button>
    <ul id="list"></ul>
    <script>
        function addItem() {
            let val = document.getElementById("item").value;
            if (val.trim() !== "") {
                let li = document.createElement("li");
                li.innerText = val;
                document.getElementById("list").appendChild(li);
            }
        }
    </script>
</body>

</html>