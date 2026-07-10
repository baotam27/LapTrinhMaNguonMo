<input type="text" id="city" placeholder="Nhập tên thành phố">
<button onclick="getWeather()">Xem</button>
<div id="weather"></div>
<script>
    function getWeather() {
        let c = document.getElementById("city").value;
        fetch('weather.php?city=' + encodeURIComponent(c))
            .then(res => res.json())
            .then(data => {
                document.getElementById("weather").innerHTML =
                    `<h3>${c}</h3><p>Nhiệt độ:

${data.temp}°C</p><p>${data.desc}</p>`;

            });

    }
</script>