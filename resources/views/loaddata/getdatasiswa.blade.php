<table class="table table-striped">
  <tr>
    <th>NISN</th>
    <td>{{$siswa->nisn}}</td>
  </tr>
  <tr>
    <th>Nama Lengkap</th>
    <td>{{strtoupper($siswa->nama_lengkap)}}</td>
  </tr>
  <tr>
    <th>Jenis Kelamin</th>
    <td>{{strtoupper($siswa->jenis_kelamin)}}</td>
  </tr>
  <tr>
    <th>Tempat / Tanggal Lahir</th>
    <td>{{strtoupper($siswa->tempat_lahir)}} / {{date('d-m-Y',strtotime($siswa->tanggal_lahir))}}</td>
  </tr>
  <tr>
    <th>Anak Ke</th>
    <td>{{$siswa->anak_ke}}</td>
  </tr>
  <tr>
    <th>Jumlah Saudara</th>
    <td>{{$siswa->jml_saudara}}</td>
  </tr>

  <tr>
    <th>Alamat</th>
    <td>{{$siswa->alamat}}</td>
  </tr>
  <tr>
    <th>Propinsi</th>
    <td>{{$siswa->prov_name}}</td>
  </tr>
  <tr>
    <th>Kota</th>
    <td>{{$siswa->regc_name}}</td>
  </tr>
  <tr>
    <th>Kecamatan</th>
    <td>{{$siswa->dist_name}}</td>
  </tr>
  <tr>
    <th>Kelurahan/Desa</th>
    <td>{{$siswa->vill_name}}</td>
  </tr>
  <tr>
    <th>Kode Pos</th>
    <td>{{$siswa->kodepos}}</td>
  </tr>
</table>