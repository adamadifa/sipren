@extends('layouts.tabler')
@section('title', 'Edit Data Guru')
@section('page-pretitle', 'Edit Data Guru')
@section('page-title', 'Edit Data Guru')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/guru/{{ Crypt::encrypt($guru->kode_guru) }}/update" method="post" id="formGuru">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                                            <path d="M5 11h1v2h-1z" />
                                            <path d="M10 11l0 2" />
                                            <path d="M14 11h1v2h-1z" />
                                            <path d="M19 11l0 2" />
                                        </svg>
                                    </span>
                                    <input type="text" name="kode_guru" disabled id="kode_guru" value="{{ $guru->kode_guru }}"
                                        class="form-control uppercase" placeholder="Kode guru">
                                </div>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <x-inputnolabel label="Nama Guru" placeholder="Nama Guru" field="nama_guru" value="{{ $guru->nama_guru }}"
                                    icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>' />
                            </div>
                        </div>
                        <div class="form-group">
                            <x-inputnolabel label="Alamat" placeholder="Alamat" field="alamat" value="{{ $guru->alamat }}"
                                icon='
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>' />
                        </div>
                        <div class="form-group">
                            <x-inputnolabel label="No Telepon" placeholder="No Telepon" field="no_telepon" value="{{ $guru->no_telepon }}"
                                icon='<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 12a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>' />
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
        $("#formGuru").submit(function(e) {
            let kode_guru = $("input[name='kode_guru']").val();
            let nama_guru = $("input[name='nama_guru']").val();
            let alamat = $("input[name='alamat']").val();
            let no_telepon = $("input[name='no_telepon']").val();
            if (kode_guru == "") {
                swal('Oops', 'Kode Guru Harus diisi !', "warning");
                return false;
            } else if (nama_guru == "") {
                swal('Oops', 'Nama Guru Harus diisi !', "warning");
                return false;
            } else if (alamat == "") {
                swal('Oops', 'Alamat Harus diisi !', "warning");
                return false;
            } else if (no_telepon == "") {
                swal('Oops', 'No Telepon Harus diisi !', "warning");
                return false;
            } else {
                return true;
            }
        });
    </script>
@endpush
