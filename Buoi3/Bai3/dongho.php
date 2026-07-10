<html>

<body>
    <h1 id="clock"></h1>

    <script>
        function updateClock() {
            let now = new Date();
            document.getElementById("clock").innerText =

                now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>

</html>