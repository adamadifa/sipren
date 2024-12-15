@extends('layouts.tabler')
@section('title', 'Input Data Mata Pelajaran')
@section('page-pretitle', 'Input Data Mata Pelajaran')
@section('page-title', 'Input Data Mata Pelajaran')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/matapelajaran/store" method="post" id="formMataPelajaran">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <x-inputnolabel label="Kode Mata Pelajaran" placeholder="Kode Mata Pelajaran" field="kode_matpel"
                                    icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>' />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <x-inputnolabel label="Nama Mata Pelajaran" placeholder="Nama Mata Pelajaran" field="nama_matpel"
                                    icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>' />
                            </div>
                        </div>

                        <button class="btn btn-primary w-100">
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
        $("#formMataPelajaran").submit(function(e) {
            let kode_matapelajaran = $("input[name='kode_matpel']").val();
            let nama_matapelajaran = $("input[name='nama_matpel']").val();
            if (kode_matapelajaran == "") {
                swal('Oops', 'Kode Mata Pelajaran Harus diisi !', "warning");
                return false;
            } else if (nama_matapelajaran == "") {
                swal('Oops', 'Nama Mata Pelajaran Harus diisi !', "warning");
                return false;
            } else {
                return true;
            }
        });
    </script>
@endpush
