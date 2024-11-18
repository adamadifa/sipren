<form action="/kelas/{{ Crypt::encrypt($kode_kelas) }}/storesiswa" method="post" id="formaddSiswa">
    @csrf
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>No. Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listsiswa as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->no_pendaftaran }}</td>
                    <td>{{ $d->nama_lengkap }}</td>
                    <td>
                        <input type="checkbox" name="no_pendaftaran[]" value="{{ $d->no_pendaftaran }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-primary w-100"><i class="fa fa-plus mr-1"></i>Tambahkan Siswa</button>
</form>

<script>
    $(document).ready(function() {
        $('#formaddSiswa').on('submit', function(e) {
            if ($('input[name="no_pendaftaran[]"]:checked').length === 0) {
                e.preventDefault();
                swal({
                    title: 'Peringatan',
                    text: 'Silakan pilih setidaknya satu siswa untuk ditambahkan.',
                    icon: 'warning',
                    buttons: {
                        confirm: 'OK'
                    }
                });
            }
        });
    });
</script>
