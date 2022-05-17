@extends('layouts.tabler')
@section('title','Detail Karyawan')
@section('page-pretitle','Detail Karyawan')
@section('page-title','Detail Karyawan')
@section('content')

<div class="row row-cards mt-3">
    @include('karyawan.sideprofile')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Upload Foto</h4>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 12l5 5l10 -10" />
                                <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                        </div>
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                    <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                </div>

                @endif
                <form action="/karyawan/{{$karyawan->npp}}/gantifoto" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-2 @error('foto') is-invalid
                    @enderror">
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid
                        @enderror">
                    </div>
                    @error('foto') <div class="mb-2 mt-2 invalid-feedback">{{ucwords($message)}}</div>
                    @enderror
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <polyline points="7 9 12 4 17 9" />
                            <line x1="12" y1="4" x2="12" y2="16" /></svg>
                        Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
