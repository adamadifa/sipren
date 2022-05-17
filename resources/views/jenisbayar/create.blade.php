@extends('layouts.tabler')
@section('page-pretitle','Input Data Jenis Bayar')
@section('page-title','Input Data Jenis Bayar')
@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card mt-2">
      <div class="card-body">
        <form action="/jenisbayar" method="post">
          @csrf
          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Jenis Bayar" placeholder="Contoh : SPP" field="jenisbayar"
                icon='<!-- Download SVG icon from http://tabler-icons.io/i/file-invoice -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>' />
            </div>
          </div>
          <button class="btn btn-primary  w-100" style="background-color:#004c2d; color:white">
            <!-- Download SVG icon from http://tabler-icons.io/i/send -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <line x1="10" y1="14" x2="21" y2="3" />
              <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
            Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection