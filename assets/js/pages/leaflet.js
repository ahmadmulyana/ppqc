const mymap = L.map('mapid').setView([-6.27160025676536, 106.80854318135795], 14);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibXN5YWlmdWxsYWhtc20iLCJhIjoiY2txdWhobHZhMDRsOTJ6bWYwZWZ5Y3c2OCJ9.JHsrR6YYmAUGFV7A4XNmuw'
}).addTo(mymap);

const marker1 = L.marker([-6.27160025676536, 106.80854318135795]).addTo(mymap);
marker1.bindPopup("<center><b>Haribima IT Consultant</b><br>Hello, I am a popup<center>").openPopup();
const marker2 = L.marker([-6.273589532434889, 106.80600388665596]).addTo(mymap);
const marker3 = L.marker([-6.2760245477489125, 106.79739169160007]).addTo(mymap);