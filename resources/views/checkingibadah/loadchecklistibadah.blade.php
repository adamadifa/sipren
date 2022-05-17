@php
$kategori = "";
@endphp
@foreach ($kegiatan as $k)
@if ($kategori != $k->kategori_ibadah)
<tr>
    <th colspan="2"><b>{{$k->nama_kategori_ibadah}}</b></th>
</tr>
@endif
<tr>
    <td>{{$k->kegiatan_ibadah}}</td>
    <td style="text-align: center">
        <label class="form-check">
            <input class="form-check-input checklist" data-id="<?php echo $k->id; ?>"
                <?php if($k->cekkegiatan == 1){echo "checked";} ?> type="checkbox">
        </label>
    </td>

</tr>
@php
$kategori = $k->kategori_ibadah;
@endphp
@endforeach


<script>
    $(function(){
    $('.checklist').click(function(){
      var tanggal = $("#tanggal").val();
      var id = $(this).attr("data-id");
      if($(this).prop("checked") == true){
        $.ajax({
            type:'POST',
            url : '/simpanchecklistibadah',
            data :{
                _token: "{{ csrf_token() }}",
                tanggal:tanggal,
                id:id
            },
            cache:false,
            success:function(){
               //alert('success');
            }
        });
      }
      else if($(this).prop("checked") == false){
        $.ajax({
            type:'POST',
            url : '/hapuschecklistibadah',
            data :{
                _token: "{{ csrf_token() }}",
                tanggal:tanggal,
                id:id
            },
            cache:false,
            success:function(){
               //alert('success');
            }
        });
      }
    });
  });
</script>
