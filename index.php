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
    <div id="bar"><span id="question" onclick="showHelp()" display="hidden">?</span>SSH attack map</div>
    <div id="help" class="hidden">
        
        <h1>FAQ<a href="#" onclick="hideHelp()" id="closehelp">Close</a></h1>
        <h2>What am I looking at?</h2>
        <p>This is a map showing where all attempted SSH logins to this
            server in the past 14 days originated from. These logins were likely
            attempted by hackers scanning the internet for insecure servers.
            The size of a marker indicates how recently the attempt happened.
            A darker color indicates many attempts came from that location.</p>
        <h2>Can they get in?</h2>
        <p>I have my server set up to not accept password authentication,
            only SSH keys. This makes all of these automated attacks worthless,
            save for any unkown vulnerabilities in SSH. It does however illustrate
            the need for awereness of security. If you expose any device to the
            internet, people <i>will</i> attempt to break in.</p>
        <h2>What is SSH?</h2>
        <p><a href="https://en.wikipedia.org/wiki/Secure_Shell">SSH</a> is a protocol used to connect to computers with unix-like operating systems remotely.</p>
    </div>
    <div id="map"></div>
    <script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>
