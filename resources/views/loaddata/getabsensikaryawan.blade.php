@php
$url = "https://simpeg.persisalamin.com/content/present/";
@endphp
@foreach ($absensi as $d)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{\Carbon\Carbon::parse($d->presence_date)->translatedFormat('l, d F Y')}}</td>
    <td>
        <span class="avatar avatar-sm" style="background-image: url({{$url.$d->picture_in}})"></span>
    </td>
    <td>
        <span class="badge bg-green">{{$d->time_in}}</span>
    </td>
    <td>
        <span class="avatar avatar-sm" style="background-image: url({{$url.$d->picture_out}})"></span>
    </td>
    <td>
        <span class="badge bg-red">{{$d->time_out}}</span>
    </td>
    <td>
        <a href="#" data-nama="{{$d->nama_lengkap}}" data-adress="{{$d->presence_address}}"
            class="btn btn-primary btn-sm btn-lokasi"><i class="fa fa-map mr-2"></i> Cek Lokasi</a>
    </td>
</tr>
@endforeach
