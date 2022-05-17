@foreach ($unittambahan as $u)
<tr>
    <td>{{$loop->iteration}}</td>
    <td style="width:80%">{{$u->nama_unit}}</td>
    <td>
        <a href="#" class="btn btn-danger btn-sm hapus" id="hapusunit" data-npp="{{$u->npp}}"
            data-unit="{{$u->id_unit}}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="4" y1="7" x2="20" y2="7" />
                <line x1="10" y1="11" x2="10" y2="17" />
                <line x1="14" y1="11" x2="14" y2="17" />
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
            </svg>
            Hapus
        </a>
    </td>
</tr>
@endforeach

<script>
    $(function(){
        function loadunittambahan(){
            var npp = $("#npp").val();
            $.ajax({
                type:'POST',
                url:'/karyawan/getunittambahan',
                data:{
                    _token: "{{ csrf_token() }}",
                    npp:npp
                },
                cache:false,
                success:function(respond){
                    $("#loadunittambahan").html(respond);
                }
            });
        }
        $(".hapus").click(function(e){
            e.preventDefault();
            var npp = $(this).attr("data-npp");
            var id_unit = $(this).attr("data-unit");
            $.ajax({
                type:'POST',
                url:'/karyawan/deleteunittambahan',
                data:{npp:npp,id_unit:id_unit,_token: "{{ csrf_token() }}",},
                cache:false,
                success:function(respond){
                    loadunittambahan();
                }
            });
        });
    });

</script>