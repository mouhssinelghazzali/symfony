import Leaflet from 'leaflet'
import 'leaflet/dist/leaflet.css'
export default class Map{

static init () {
    let map = document.querySelector('#map')
    if (map === null) {
        return
    }
    let icon = L.icon({
        iconUrl: 'https://unpkg.com/leaflet@1.5.1/dist/images/marker-icon.png',
      })
let center = [map.dataset.lat, map.dataset.lng]
      


map =  L.map('map').setView(center, 13);
let token = 'pk.eyJ1IjoiZWxnaGF6emFsaSIsImEiOiJjandyeXd0eWUwMGM2M3ltdTNjZGR0bGxiIn0.O8mJg5sReCNBEbFkjNHqUQ'
L.tileLayer(`https://api.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=${token}`,{
maxZoom: 18,
minZoom: 12,
attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'

}).addTo(map)
L.marker(center, {icon: icon}).addTo(map)
L.circle(center, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 500
}).addTo(map)




}

}