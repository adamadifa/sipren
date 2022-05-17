@foreach ($biayatemp as $b)
<tr>
  <td>{{$loop->iteration}}</td>
  <td>{{$b->jenisbayar}}</td>
  <td style="text-align: right">{{number_format($b->jumlah_biaya,'0','','.')}}</td>
  <td>
    <a href="#" class="btn btn-danger btn-sm hapus" data-kodebiaya="{{$b->kodebiaya}}"
      data-jenisbayar="{{$b->id_jenisbayar}}">
      <i class="fa fa-trash-o"></i>
    </a>
  </td>
</tr>
@endforeach

<script>
  $(function(){
      function loaddatabiaya(){
          var kodebiaya = $("#kodebiaya").val();
          $.ajax({
              type:'POST',
              url:'/biaya/showtemp',
              data:{
                  _token: "{{ csrf_token() }}",
                  kodebiaya:kodebiaya
              },
              cache:false,
              success:function(respond){
                  $("#loadbiayatemp").html(respond);
              }
          });
      }

      function loadcheckbiaya(){
        var kodebiaya = $("#kodebiaya").val();
        $.ajax({
          type:'POST',
          url:'/biaya/cektemp',
          data:{
            _token: "{{ csrf_token() }}",
            kodebiaya:kodebiaya
          },
          cache:false,
          success:function(respond){
            $("#cektemp").val(respond);
          }
        });
      }
      $(".hapus").click(function(e){
          e.preventDefault();
          var kodebiaya = $(this).attr("data-kodebiaya");
          var jenisbayar = $(this).attr("data-jenisbayar");
          $.ajax({
              type:'POST',
              url:'/biaya/deletetemp',
              data:{kodebiaya:kodebiaya,jenisbayar:jenisbayar,_token: "{{ csrf_token() }}",},
              cache:false,
              success:function(respond){
                loaddatabiaya();
                loadcheckbiaya();
              }
          });
      });
  });

</script>