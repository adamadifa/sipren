<div class="row">
    <div class="col-md-4">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Unit</th>
                    <th>Jumlah Hadir</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($rekap as $r)
                <tr>
                    <td>{{$r->nama_unit}}</td>
                    <td>{{$r->jmlhadir}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="table-responsive">
    <table class="table bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>NPP</th>
                <th>Nama Lengkap</th>
                <th>Hari/Tanggal</th>
                <th><i class="fa fa-image"></i></th>
                <th>Jam Masuk</th>
                <th><i class="fa fa-image"></i></th>
                <th>Jam Pulang</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($absensi as $d)
            @php
            $url_in = Storage::url('uploads/absensi/karyawan/'.$d->picture_in);
            $url_out = Storage::url('uploads/absensi/karyawan/'.$d->picture_out);
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->npp}}</td>
                <td>{{$d->nama_lengkap}}</td>
                <td>{{\Carbon\Carbon::parse($d->presence_date)->translatedFormat('l, d F Y')}}</td>
                <td>
                    <span class="avatar avatar-sm" style="background-image: url({{url($url_in)}})"></span>
                </td>
                <td>
                    <span class="badge bg-green">{{$d->time_in}}</span>
                </td>
                <td>
                    <span class="avatar avatar-sm" style="background-image: url({{url($url_out)}})"></span>
                </td>
                <td>
                    <span class="badge bg-red">{{$d->time_out}}</span>
                </td>
                <td>
                    <a href="#" data-nama="{{$d->nama_lengkap}}" data-address="{{$d->presence_address}}" class="btn btn-primary btn-sm btn-lokasi"><i class="fa fa-map mr-2"></i> Cek Lokasi</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
