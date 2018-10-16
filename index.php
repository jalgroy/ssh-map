<?php
$file = fopen("locations.json","r") or die("Error reading file");
$json = fread($file, filesize("locations.json"));
fclose($file);
?>

<!DOCTYPE html>
<head>
    <title>SSH Attempted logins</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" 
            integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin="">
    </script>
    <script type="text/javascript">
        var json = <?=$json;?>;
    </script>
</head>
<body>
    <h1>SSH Connection map</h1>
    <div id="map"></div>
    <script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>
