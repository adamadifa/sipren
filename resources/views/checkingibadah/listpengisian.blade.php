@include('layouts.style')
<div class="card">
  <div class="card-header">
    <div class="card-title">
      Data Yang Sudah Mengisi Checklist Ibadah Harian Tanggal {{date('d-m-Y')}}
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead class="thead-dark">
        <th>NO</th>
        <th>NPP</th>
        <th>Nama</th>
      </thead>
      <tbody>
        @foreach ($list as $d)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$d->npp}}</td>
          <td>{{$d->nama_lengkap}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
@include('layouts.script')