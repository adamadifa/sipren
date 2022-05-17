<link href="{{asset('assets/dist/leatfet/leaflet.css')}}" rel="stylesheet" />
<script src="{{asset('assets/dist/leatfet/leaflet.js')}}"></script>



<div id="peta" style="height:500px; width: 100%"></div>
<script type="text/javascript">
    var latitude ="{{$latitude}}";
    var longitude = "{{$longitude}}";
    var nama = "{{$nama}}";
    var mymap = L.map('peta').setView([latitude, longitude], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWRpZ3VuYXdhbnhkIiwiYSI6ImNrcWp2Yjg2cDA0ZjAydnJ1YjN0aDNnbm4ifQ.htvHCgSgN0UuV8hhZBfBfQ', {
        maxZoom: 20,
        attribution: '',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiYWRpZ3VuYXdhbnhkIiwiYSI6ImNrcWp2Yjg2cDA0ZjAydnJ1YjN0aDNnbm4ifQ.htvHCgSgN0UuV8hhZBfBfQ'
    }).addTo(mymap);
    L.marker([latitude, longitude]).addTo(mymap);
		L.circle([latitude, longitude], 550, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.5
		}).addTo(mymap).bindPopup(nama).openPopup();
		var popup = L.popup();

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("" + e.latlng.toString())
				.openOn(mymap);
		}
		mymap.on('click', onMapClick);

</script>
