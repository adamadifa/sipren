<div class="col-md-3">
    <div class="card">
        <div class="card-body p-4 text-center">
            <?php $path = Storage::url('foto/'.$karyawan->foto); ?>
            @if (!empty($karyawan->foto))
            <span class="avatar avatar-xl mb-3 avatar-rounded"
                style="background-image: url({{ url($path) }})"></span>
            @else
            <span class="avatar avatar-xl mb-3 avatar-rounded"
                style="background-image: url({{public_path('foto/nophoto.png')}}"></span>
            @endif

            <h3 class="m-0 mb-1"><a href="#">{{$karyawan->nama_lengkap}}</a></h3>
            <div class="text-muted">{{$karyawan->npp}}</div>
            <div class="mt-3">
                <span class="badge bg-green-lt">{{$karyawan->nama_jabatan}}</span>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <a href="/karyawan/{{$karyawan->npp}}/gantifoto" class="btn btn-info w-100"
                style="margin-left:20px; margin-right:20px">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                    <circle cx="12" cy="13" r="3" /></svg>
                Ganti Foto
            </a>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <a href="/karyawan/{{$karyawan->npp}}/edit" class="btn btn-primary w-100"
                style="margin-left:20px; margin-right:20px">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                </svg>
                Edit
            </a>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <a href="/karyawan/{{$karyawan->npp}}/uploaddokumen" class="btn btn-success w-100"
                style="margin-left:20px; margin-right:20px">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                    <line x1="9" y1="9" x2="10" y2="9" />
                    <line x1="9" y1="13" x2="15" y2="13" />
                    <line x1="9" y1="17" x2="15" y2="17" /></svg>
                Dokumen
            </a>
        </div>
    </div>
</div>
