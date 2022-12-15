<div class="row">
    <div class="col-md-4">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Unit</th>
                    <th>Jumlah Yang Mengisi</th>
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
            </tr>
        </thead>
        <tbody>

            @foreach ($checklistibadah as $d)

            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->npp}}</td>
                <td>{{$d->nama_lengkap}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
