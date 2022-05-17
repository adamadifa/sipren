<table class="table table-striped">
  <tr>
    <th>No. KK</th>
    <td>{{$siswa->no_kk}}</td>
  </tr>
  <tr>
    <th>NIK</th>
    <td>{{strtoupper($siswa->nik_ayah)}}</td>
  </tr>
  <tr>
    <th>Nama Ayah</th>
    <td>{{strtoupper($siswa->nama_ayah)}}</td>
  </tr>
  <tr>
    <th>Pendidikan</th>
    <td>{{$siswa->pendidikan_ayah}}</td>
  </tr>
  <tr>
    <th>Pekerjaan</th>
    <td>{{$siswa->pekerjaan_ayah}}</td>
  </tr>
  <tr>
    <th>NIK</th>
    <td>{{strtoupper($siswa->nik_ibu)}}</td>
  </tr>
  <tr>
    <th>Nama Ibu</th>
    <td>{{strtoupper($siswa->nama_ibu)}}</td>
  </tr>
  <tr>
    <th>Pendidikan</th>
    <td>{{$siswa->pendidikan_ibu}}</td>
  </tr>
  <tr>
    <th>Pekerjaan</th>
    <td>{{$siswa->pekerjaan_ibu}}</td>
  </tr>
  <tr>
    <th>No. HP</th>
    <td>{{$siswa->no_hp_ortu}}</td>
  </tr>
</table>