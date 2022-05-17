@foreach ($biaya as $b)
<tr>
  <td>{{$loop->iteration}}</td>
  <td>{{$b->jenisbayar}}</td>
  <td style="text-align: right">
    <input type="text" name="jumlah_biaya" class="form-control jumlah_biaya" data-kodebiaya="{{$b->kodebiaya}}"
      data-jenisbayar="{{$b->id_jenisbayar}}" style="text-align: right"
      value="{{number_format($b->jumlah_biaya,'0','','.')}}">
  </td>
  {{-- <td>
    <a href="#" class="btn btn-danger btn-sm hapus" data-kodebiaya="{{$b->kodebiaya}}"
  data-jenisbayar="{{$b->id_jenisbayar}}">
  <i class="fa fa-trash-o"></i>
  </a>
  </td> --}}
</tr>
@endforeach

<script>
  $(function(){
    $(".jumlah_biaya").maskNumber({
      integer:true,
      thousands:'.'
    });
    $('.jumlah_biaya').keyup(function(){
      var kodebiaya = $(this).attr("data-kodebiaya");
      var jenisbayar = $(this).attr("data-jenisbayar");
      var jumlah_biaya = $(this).val();
      $.ajax({
        type:'POST',
        url:'/biaya/updatedetailbiaya',
        data:{_token: "{{ csrf_token() }}",kodebiaya:kodebiaya,jenisbayar:jenisbayar,jumlah_biaya:jumlah_biaya},
        cache:false,
        success:function(respond){
          console.log(respond);
        }
      });
    });
  });
</script>