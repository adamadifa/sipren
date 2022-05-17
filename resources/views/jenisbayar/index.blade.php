@extends('layouts.tabler')
@section('title','Data Jenis Bayar')
@section('page-pretitle','Data Jenis Bayar')
@section('page-title','Data Jenis Bayar')
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
        <a href="/jenisbayar/create" class="btn btn-primary d-none d-sm-inline-block mb-3"
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
                <th>ID</th>
                <th>Jenis Bayar</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jenisbayar as $j)
              <tr>
                <td>{{$j->id}}</td>
                <td>{{$j->jenisbayar}}</td>
                <td>
                  <a href="/jenisbayar/{{$j->id}}/edit" class="btn btn-sm btn-primary">
                    <i class="fa fa-pencil"></i>
                  </a>
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