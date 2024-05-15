<?php
$key = "1f4e6e4600a0ba8990b2f2582b1213e6";
$location = ucfirst(strtolower(readline("Enter city ")));
$page1 = "http://api.openweathermap.org/geo/1.0/direct?q=$location&limit=3&appid=$key";
$coords = file_get_contents($page1);
if ($coords === false) {
    die('Error fetching data from API1');
}
$data = json_decode($coords, true);
if ($data === null) {
    die('Error decoding JSON');
}
$lat = $data[0]["lat"];
$lon = $data[0]["lon"];
$page2 = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&units=metric&appid=$key";
$weather = file_get_contents($page2);
if ($weather === false) {
    die('Error fetching data from API2');
}
$data2 = json_decode($weather, true);
if ($data2 === null) {
    die('Error decoding JSON1');
}
$description = $data2["weather"][0]["description"];
$temp = $data2["main"]["temp"];
echo "The weather in $location is: $description, Temperature: $temp °C";
