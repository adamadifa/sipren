@extends('layouts.tabler')
@section('title','Data Tahun Akademik')
@section('page-pretitle','Data Tahun Akademik')
@section('page-title','Data Tahun Akademik')
@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card mt-2">
      <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-important alert-success alert-dismissible" role="alert">
          <div class="d-flex">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        @if ($message = Session::get('failed'))
        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
          <div class="d-flex">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <a href="/tahunakademik/create" class="btn btn-primary d-none d-sm-inline-block mb-3"
          style="background-color:#004c2d; color:white">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" /></svg>
          Tambah Data
        </a>
        <div class="table-responsive mt-3">
          <table class="table table-boredered table-striped">
            <thead class="thead-dark">
              <tr>

                <th>Tahun Akademik</th>
                <th>Status</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($ta as $t)
              <tr>

                <td>{{$t->tahunakademik}}</td>
                <td>
                  @if ($t->status==1)
                  <span class="badge bg-green">Aktif</span>
                  @else
                  <span class="badge bg-red">Nonaktif</span>
                  @endif
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection