<table class="table table-bordered table-striped">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Jenis Biaya</th>
      <th>Jumlah Bayar</th>
    </tr>
  </thead>
  <tbody>
    @php
    $total = 0;
    @endphp
    @foreach ($detail as $d)
    @php
    $total += $d->jumlah_bayar;
    @endphp
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$d->jenisbayar}} @if ($d->jenisbayar=="SPP")
        ({{$namabulan[$d->ket]}})
        @endif <b>{{$d->jenjang}} {{ $d->tahunakademik}}</b></td>
      <td align="right">{{number_format($d->jumlah_bayar,'0','','.')}}</td>
    </tr>
    @endforeach
    <tr style="font-weight: bold">
      <td colspan="2">TOTAL</td>
      <td align="right">{{number_format($total,'0','','.')}}</td>
    </tr>
  </tbody>
</table>