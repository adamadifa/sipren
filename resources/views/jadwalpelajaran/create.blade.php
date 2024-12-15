@extends('layouts.tabler')
@section('title', 'Input Jadwal Pelajaran')
@section('page-pretitle', 'Input Jadwal Pelajaran')
@section('page-title', 'Input Jadwal Pelajaran ' . $tahunakademik->tahunakademik)
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/jadwalpelajaran/store" method="post" id="formJadwal">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <x-inputnolabel label="Kode Pelajaran" placeholder="Auto" field="kode_pelajaran" disabled="true"
                                    icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="semester" id="semester" class="form-select">
                                        <option value="">Semester</option>
                                        <option value="1">Ganjil</option>
                                        <option value="2">Genap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="kode_matpel" id="kode_matpel" class="form-select select2">
                                        <option value="">Mata Pelajaran</option>
                                        @foreach ($matpel as $d)
                                            <option value="{{ $d->kode_matpel }}">{{ $d->nama_matpel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="kode_guru" id="kode_guru" class="form-select select2">
                                        <option value="">Guru</option>
                                        @foreach ($guru as $d)
                                            <option value="{{ $d->kode_guru }}">{{ $d->nama_guru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="kode_kelas" id="kode_kelas" class="form-select">
                                        <option value="">Kelas</option>
                                        @foreach ($kelas as $d)
                                            <option value="{{ $d->kode_kelas }}">{{ $d->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="hari" id="hari" class="form-select">
                                        <option value="">Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <x-inputnolabel label="Jam Mulai" placeholder="Jam Mulai" field="jam_mulai"
                                    icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6v6l4 2" /></svg>' />
                            </div>
                            <div class="col-md-6">
                                <x-inputnolabel label="Jam Selesai" placeholder="Jam Selesai" field="jam_selesai"
                                    icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6v6l4 2" /></svg>' />
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
        $('.select2').select2();
        $("#jam_mulai").mask("##:##");
        $('#jam_selesai').mask('00:00', {
            placeholder: "HH:MM"
        });
        $("#formJadwal").submit(function(e) {
            let kode_pelajaran = $("input[name='kode_pelajaran']").val();
            let nama_pelajaran = $("select[name='kode_matpel']").val();
            let kelas = $("select[name='kode_kelas']").val();
            let hari = $("select[name='hari']").val();
            let semester = $("select[name='semester']").val();
            if (semester == "") {
                swal('Oops', 'Semester Harus diisi !', "warning");
                return false;
            } else if (nama_pelajaran == "") {
                swal('Oops', 'Nama Pelajaran Harus diisi !', "warning");
                return false;
            } else if (kelas == "") {
                swal('Oops', 'Kelas Harus diisi !', "warning");
                return false;
            } else if (hari == "") {
                swal('Oops', 'Hari Harus diisi !', "warning");
                return false;
            } else {
                return true;
            }
        });
    </script>
@endpush
