@extends('layouts.tabler')
@section('page-pretitle', 'Input Data Kelas')
@section('page-title', 'Input Data Kelas')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/kelas/store" method="post" id="formKelas">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <x-inputnolabel label="Nama Kelas" placeholder="Nama Kelas" field="nama_kelas"
                                    icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>' />
                            </div>
                        </div>
                        <div class="form-group">

                            <select name="jenjang" id="jenjang" class="form-select">
                                <option value="">Jenjang</option>
                                @foreach ($jenjang as $j)
                                    <option data-tingkat={{ $j->jumlah_tingkat }} value="{{ $j->nama_unit }}">{{ $j->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="tingkat" id="tingkat" class="form-select">
                                <option value="">Tingkat</option>
                            </select>
                        </div>
                        <button class="btn btn-primary  w-100">
                            <!-- Download SVG icon from http://tabler-icons.io/i/send -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="10" y1="14" x2="21" y2="3" />
                                <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                            </svg>
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('myscript')
    <script>
        $(function() {
            $("#jenjang").change(function() {
                var jumlah_tingkat = $('option:selected', this).attr('data-tingkat');
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/gettingkat',
                    data: {
                        _token: "{{ csrf_token() }}",
                        jumlah_tingkat: jumlah_tingkat
                    },
                    cache: false,
                    success: function(respond) {
                        console.log(respond);
                        $("#tingkat").html(respond);
                    }
                });
            });

            $("#formKelas").submit(function(e) {
                let nama_kelas = $("#nama_kelas").val();
                let jenjang = $("#jenjang").val();
                let tingkat = $("#tingkat").val();
                if (nama_kelas == "") {
                    swal('Oops', 'Nama Kelas Harus diisi !', "warning");
                    return false;
                } else if (jenjang == "") {
                    swal('Oops', 'Jenjang Harus dipilih !', "warning");
                    return false;
                } else if (tingkat == "") {
                    swal('Oops', 'Tingkat Harus dipilih !', "warning");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
@endpush
