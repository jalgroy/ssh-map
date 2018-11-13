var map = L.map('map',{
    minZoom: 0.5
});

var positron = 
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png').addTo(map);

var sizeDecreaseTime = 96*60*60;

for(var i = 0; i < json.length; i++) {
    var circle = L.circleMarker([json[i]["lat"],json[i]["lon"]], {
        stroke: false,
        fillColor: 'red',
        fillOpacity: 0.2,
        radius: getMarkerRadius(json[i]["time"], sizeDecreaseTime)
    }).addTo(map);
    circle.bindPopup(json[i]["ip"] + "<br>" + json[i]["city"] + ", " + json[i]["country"] + "<br>" + getTimeSince(json[i]["time"]));
}


map.setView([20,0],2)

function getMarkerRadius(time, sizeDecreaseTime) {
    var diff = (new Date()).getTime()/1000 - time;
    var min = 8, max = 20;
    return Math.max(min, (sizeDecreaseTime-diff)*max/sizeDecreaseTime);
}

function getTimeSince(time){
    var diff = (new Date()).getTime()/1000 - time;
    if(diff < 60*60){
        return Math.round(diff / 60) + " minutes ago";
    } else if (diff < 1.5*60*60){
        return "1 hour ago";
    } else if (diff < 48*60*60) {
        return Math.round(diff / (60*60)) + " hours ago";
    } else {
        return Math.round(diff / (24*60*60)) + " days ago";
    }
}

function showHelp() {
    document.getElementById("help").className = "visible";
    
}
function hideHelp() {
    document.getElementById("help").className = "hidden";
}
