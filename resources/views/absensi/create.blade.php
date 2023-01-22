@extends('mobile.layouts.fimobile')
@section('content')
<style>
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        height: auto !important;
        margin: auto;
        text-align: center;
        border-radius: 15px;
        overflow: hidden;
    }

    #map {
        height: 220px;
        z-index: 0;
    }

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<div class="row">
    <div class="col">
        <span class="latitude d-none" id="latitude"></span>
        <input type="hidden" id="lokasi">
        <div class="webcam-capture">
        </div>
    </div>
</div>


<div class="row mb-2">
    <div class="col">
        @if ($cek >0)
        <a href="#" class="btn btn-danger shadow-sm w-100 text-white" id="takeabsen"><i class="bi bi-camera me-2"></i>Absen Pulang</a>
        @else
        <a href="#" class="btn btn-default shadow-sm w-100" id="takeabsen"><i class="bi bi-camera me-2"></i>Absen Masuk</a>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        <div id="map"></div>
    </div>
</div>
<audio id="myAudio">
    <source src="{{ asset('thankyou.mp3') }}" type="audio/mpeg">
</audio>
<audio id="pulang">
    <source src="{{ asset('hatihati.mp3') }}" type="audio/mpeg">
</audio>
@endsection

@push('myscript')

<script>
    $(document).ready(function() {
        document.addEventListener("deviceready", onDeviceReady, false);

        function onDeviceReady() {
            window.plugins.mockgpschecker.check(successCallback, errorCallback);
        }

        function successCallback(result) {
            console.log(result); // true - enabled, false - disabled
            alert(result);
        }

        function errorCallback(error) {
            console.log(error);
            alert(error);
        }
        var result = document.getElementById("latitude");
        var lokasi = document.getElementById("lokasi");
        var x = document.getElementById("myAudio");
        var y = document.getElementById("pulang");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            swal({
                title: 'Oops!'
                , text: 'Maaf, browser Anda tidak mendukung geolokasi HTML5.'
                , icon: 'error'
                , timer: 3000
            , });
        }

        function successCallback(position) {
            result.innerHTML = "" + position.coords.latitude + "," + position.coords.longitude + "";
            lokasi.value = "" + position.coords.latitude + "," + position.coords.longitude + "";
            var lok = lokasi.value;
            var latlong = lok.split(",");
            var map = L.map('map').setView([latlong[0], latlong[1]], 15);
            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20
                , subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            var marker = L.marker([latlong[0], latlong[1]]).addTo(map);
        }


        // Define callback function for failed attempt
        function errorCallback(error) {
            if (error.code == 1) {
                swal({
                    title: 'Oops!'
                    , text: 'Anda telah memutuskan untuk tidak membagikan posisi Anda, tetapi tidak apa-apa. Kami tidak akan meminta Anda lagi.'
                    , icon: 'error'
                    , timer: 3000
                , });
            } else if (error.code == 2) {
                swal({
                    title: 'Oops!'
                    , text: 'Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau.'
                    , icon: 'error'
                    , timer: 3000
                , });
            } else if (error.code == 3) {
                swal({
                    title: 'Oops!'
                    , text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.'
                    , icon: 'error'
                    , timer: 3000
                , });
            } else {
                swal({
                    title: 'Oops!'
                    , text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.'
                    , icon: 'error'
                    , timer: 3000
                , });
            }
        }


        Webcam.set({
            width: 590
            , height: 460
            , image_format: 'jpeg'
            , jpeg_quality: 80
        , });





        var cameras = new Array(); //create empty array to later insert available devices
        navigator.mediaDevices.enumerateDevices() // get the available devices found in the machine
            .then(function(devices) {
                devices.forEach(function(device) {
                    var i = 0;
                    if (device.kind === "videoinput") { //filter video devices only
                        cameras[i] = device.deviceId; // save the camera id's in the camera array
                        i++;
                    }
                });
            })

        Webcam.set('constraints', {
            width: 590
            , height: 460
            , image_format: 'jpeg'
            , jpeg_quality: 80
            , sourceId: cameras[0]
        });

        Webcam.attach('.webcam-capture');

        $("#takeabsen").click(function() {

            Webcam.snap(function(data_uri) {
                console.log(data_uri);
                image = data_uri;
            });
            var latitude = $("#latitude").text();
            //alert(latitude);
            $("#takeabsen").hide();
            $.ajax({
                type: 'POST'
                , url: '/absensi/store'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , image: image
                    , latitude: latitude
                }
                , cache: false
                , success: function(respond) {
                    console.log(respond);
                    var result = respond.split("|");
                    if (result[0] == 'success') {
                        if (result[2] == "in") {
                            x.play();
                        } else {
                            y.play();
                        }

                        swal({
                            title: 'Berhasil!'
                            , text: result[1]
                            , icon: 'success'
                            , timer: 3500
                        , });
                        setTimeout("location.href = '/mobile/dashboard';", 3600);
                    } else {
                        swal({
                            title: 'Oops!'
                            , text: text
                            , icon: 'error'
                            , timer: 3500
                        , });
                    }
                }
            });
        });


    });

</script>
@endpush
