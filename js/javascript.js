var map = L.map('map');

var positron = 
    L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png').addTo(map);

var days = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"]
var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]

for(var i = 0; i < json.length; i++) {
    var circle = L.circleMarker([json[i]["lat"],json[i]["lon"]], {
        stroke: false,
        fillColor: 'red',
        fillOpacity: 0.2,
        radius: 20-Math.log((new Date()).getTime()/1000-json[i]["time"])
    }).addTo(map);
    var time = new Date(json[i]["time"]*1000);
    var formattedTime = days[time.getDay()] + " " + time.getDate() + ". " + months[time.getMonth()] + " " + time.getFullYear();
    circle.bindPopup(json[i]["ip"] + "<br>" + json[i]["city"] + ", " + json[i]["country"] + "<br>" + formattedTime);
}


map.setView([15,0],3)
