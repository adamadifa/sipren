<div class="collapse navbar-collapse" id="navbar-menu">
    <ul class="navbar-nav pt-lg-3">
        @if (!empty(Auth::guard('user')->user()->level))
            @if (Auth::guard('user')->user()->level == 'admin')
                <li class="nav-item {{ set_active(['dashboard']) }}">
                    <a class="nav-link" href="{{ url('dashboard ') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ set_show(['karyawan', 'karyawan/create', 'unit']) }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ set_true(['karyawan', 'karyawan/create', 'unit']) }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                                <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
                                <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Data Master
                        </span>
                    </a>
                    <div
                        class="dropdown-menu  {{ request()->is(['siswa', 'siswa/*', 'jenisbayar', 'jenisbayar/*', 'karyawan', 'karyawan/*']) ? 'show' : '' }}">
                        <a class="dropdown-item  {{ request()->is(['karyawan', 'karyawan/*']) ? 'active' : '' }}" href="/karyawan">
                            Karyawan
                        </a>
                        <a class="dropdown-item {{ set_active(['siswa', 'siswa/create', 'siswa/cari']) }} {{ request()->is('siswa/*') ? 'active' : '' }}"
                            href="/siswa">
                            Siswa
                        </a>
                        {{-- <a class="dropdown-item {{ set_active('unit') }}" href="/unit">
                    Unit
                </a> --}}
                        <a class="dropdown-item {{ set_active(['jenisbayar', 'jenisbayar/create']) }} {{ request()->is('jenisbayar/*') ? 'active' : '' }}"
                            href="/jenisbayar">
                            Jenis Bayar
                        </a>
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is(['pendaftaran/*']) ? 'show' : '' }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ request()->is(['pendaftaran/*']) ? 'true' : '' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                            <!-- Download SVG icon from http://tabler-icons.io/i/user-check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 11l2 2l4 -4" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Pendaftaran
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->is(['pendaftaran/*']) ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->is(['pendaftaran/TK', 'pendaftaran/TK/*']) ? 'active' : '' }}" href="/pendaftaran/TK">
                            TK
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/SDIT', 'pendaftaran/SDIT/*']) ? 'active' : '' }}"
                            href="/pendaftaran/SDIT">
                            SDIT
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/MDU', 'pendaftaran/MDU/*']) ? 'active' : '' }}"
                            href="/pendaftaran/MDU">
                            MDU
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/MTS', 'pendaftaran/MTS/*']) ? 'active' : '' }}"
                            href="/pendaftaran/MTS">
                            MTs
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/MA', 'pendaftaran/MA/*']) ? 'active' : '' }}" href="/pendaftaran/MA">
                            MA
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/ASRAMA', 'pendaftaran/ASRAMA/*']) ? 'active' : '' }}"
                            href="/pendaftaran/ASRAMA">
                            ASRAMA
                        </a>
                    </div>

                </li>
                <li class="nav-item {{ request()->is(['pembayaran', 'pembayaran/*']) ? 'active' : '' }}">
                    <a class="nav-link" href="/pembayaran">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/report-money -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <rect x="9" y="3" width="6" height="4" rx="2" />
                                <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                <path d="M12 17v1m0 -8v1" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Pembayaran
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is(['absensi/*']) ? 'show' : '' }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ request()->is(['absensi/*']) ? 'true' : '' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                            <!-- Download SVG icon from http://tabler-icons.io/i/user-check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 11l2 2l4 -4" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Absensi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->is(['absensi/*']) ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->is(['absensi/karyawan', 'absensi/karyawan/*']) ? 'active' : '' }}"
                            href="/absensi/karyawan">
                            Karyawan
                        </a>
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is(['checklistibadah/*']) ? 'show' : '' }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ request()->is(['checklistibadah/*']) ? 'true' : '' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                            <!-- Download SVG icon from http://tabler-icons.io/i/user-check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 11l2 2l4 -4" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Checklist Ibadah
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->is(['checklistibadah/*']) ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->is(['checklistibadah/karyawanlist', 'checklistibadah/karyawan/*']) ? 'active' : '' }}"
                            href="/checklistibadah/karyawanlist">
                            Karyawan
                        </a>
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ set_show(['checkingibadah']) }}" href="#navbar-extra" data-toggle="dropdown"
                        role="button" aria-expanded="{{ set_true(['checkingibadah']) }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <line x1="9" y1="9" x2="10" y2="9" />
                                <line x1="9" y1="13" x2="15" y2="13" />
                                <line x1="9" y1="17" x2="15" y2="17" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Lap. MSDM
                        </span>
                    </a>
                    <div class="dropdown-menu {{ set_show(['checkingibadah/laporan', 'absensi/laporan', 'checkingibadah/rekap']) }}">
                        <a class="dropdown-item {{ set_active(['checkingibadah/laporan']) }}" href="/checkingibadah/laporan">
                            Checklist Ibadah
                        </a>
                        <a class="dropdown-item {{ set_active(['checkingibadah/rekap']) }}" href="/checkingibadah/rekap">
                            Rekap Ibadah
                        </a>
                        <a class="dropdown-item {{ set_active(['absensi/laporan']) }}" href="/absensi/laporan">
                            Absensi SDM
                        </a>
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle href=" #navbar-extra" data-toggle="dropdown" role="button">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <line x1="9" y1="9" x2="10" y2="9" />
                                <line x1="9" y1="13" x2="15" y2="13" />
                                <line x1="9" y1="17" x2="15" y2="17" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Lap. Pendidikan
                        </span>
                    </a>
                    <div class="dropdown-menu {{ set_show(['absensi/laporansiswa']) }}">
                        <a class="dropdown-item {{ set_active(['absensi/laporansiswa']) }}" href="/absensi/laporansiswa">
                            Presensi Siswa
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is(['laporanpembayaran']) ? 'show' : '' }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <line x1="9" y1="9" x2="10" y2="9" />
                                <line x1="9" y1="13" x2="15" y2="13" />
                                <line x1="9" y1="17" x2="15" y2="17" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Lap. Keuangan
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->is(['laporanpembayaran', 'laporantagihan']) ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->is(['laporanpembayaran']) ? 'active' : '' }}" href="/laporanpembayaran">
                            Lap. Pembayaran
                        </a>
                        <a class="dropdown-item {{ request()->is(['laporantagihan']) ? 'active' : '' }}" href="/laporantagihan">
                            Lap. Tagihan
                        </a>
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ set_show(['tahunakademik', 'tahunakademik/create']) }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ set_true(['tahunakademik', 'tahunakademik/create']) }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Konfigurasi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ set_show(['tahunakademik', 'tahunakademik/create', 'biaya', 'biaya/create']) }}">
                        <a class="dropdown-item {{ set_active(['tahunakademik', 'tahunakademik/create']) }}" href="/tahunakademik">
                            Tahun Akademik
                        </a>
                        <a class="dropdown-item {{ set_active(['biaya', 'biaya/create']) }}" href="/biaya">
                            Biaya
                        </a>
                    </div>

                </li>
            @elseif(Auth::guard('user')->user()->level == 'admin_unit')
                <li class="nav-item {{ set_active(['dashboard']) }}">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is(['pembayaran', 'pembayaran/*']) ? 'active' : '' }}">
                    <a class="nav-link" href="/pembayaran">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/report-money -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <rect x="9" y="3" width="6" height="4" rx="2" />
                                <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                <path d="M12 17v1m0 -8v1" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Pembayaran
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is(['absensi/*']) ? 'show' : '' }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ request()->is(['absensi/*']) ? 'true' : '' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                            <!-- Download SVG icon from http://tabler-icons.io/i/user-check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 11l2 2l4 -4" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Absensi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->is(['absensi/*']) ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->is(['absensi/karyawan', 'absensi/karyawan/*']) ? 'active' : '' }}"
                            href="/absensi/karyawan">
                            Karyawan
                        </a>
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ set_show(['checkingibadah']) }}" href="#navbar-extra" data-toggle="dropdown"
                        role="button" aria-expanded="{{ set_true(['checkingibadah']) }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <line x1="9" y1="9" x2="10" y2="9" />
                                <line x1="9" y1="13" x2="15" y2="13" />
                                <line x1="9" y1="17" x2="15" y2="17" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Laporan
                        </span>
                    </a>
                    <div class="dropdown-menu {{ set_show(['checkingibadah/laporan', 'absensi/laporan', 'absensi/laporansiswa']) }}">
                        <a class="dropdown-item {{ set_active(['checkingibadah/laporan']) }}" href="/checkingibadah/laporan">
                            Amalan Harian
                        </a>
                        <a class="dropdown-item {{ set_active(['absensi/laporan']) }}" href="/absensi/laporan">
                            Presensi SDM
                        </a>
                        <a class="dropdown-item {{ set_active(['absensi/laporansiswa']) }}" href="/absensi/laporansiswa">
                            Presensi Siswa
                        </a>
                    </div>

                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ set_show(['tahunakademik', 'tahunakademik/create']) }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ set_true(['tahunakademik', 'tahunakademik/create']) }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Konfigurasi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ set_show(['tahunakademik', 'tahunakademik/create', 'biaya', 'biaya/create']) }}">
                        <a class="dropdown-item {{ set_active(['biaya', 'biaya/create']) }}" href="/biaya">
                            Biaya
                        </a>
                    </div>

                </li>
            @elseif(Auth::guard('user')->user()->level == 'admin_ppdb')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is(['pendaftaran/*']) ? 'show' : '' }}" href="#navbar-extra"
                        data-toggle="dropdown" role="button" aria-expanded="{{ request()->is(['pendaftaran/*']) ? 'true' : '' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                            <!-- Download SVG icon from http://tabler-icons.io/i/user-check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 11l2 2l4 -4" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Pendaftaran
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->is(['pendaftaran/*']) ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->is(['pendaftaran/TK', 'pendaftaran/TK/*']) ? 'active' : '' }}"
                            href="/pendaftaran/TK">
                            TK
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/SDIT', 'pendaftaran/SDIT/*']) ? 'active' : '' }}"
                            href="/pendaftaran/SDIT">
                            SDIT
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/MDU', 'pendaftaran/MDU/*']) ? 'active' : '' }}"
                            href="/pendaftaran/MDU">
                            MDU
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/MTS', 'pendaftaran/MTS/*']) ? 'active' : '' }}"
                            href="/pendaftaran/MTS">
                            MTs
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/MA', 'pendaftaran/MA/*']) ? 'active' : '' }}"
                            href="/pendaftaran/MA">
                            MA
                        </a>
                        <a class="dropdown-item {{ request()->is(['pendaftaran/ASRAMA', 'pendaftaran/ASRAMA/*']) ? 'active' : '' }}"
                            href="/pendaftaran/ASRAMA">
                            ASRAMA
                        </a>
                    </div>

                </li>
            @endif
        @elseif (!empty(Auth::guard('karyawan')->user()->level))
            @if (Auth::guard('karyawan')->user()->level == 'user')
                <li class="nav-item {{ set_active(['karyawan/' . Auth::guard('karyawan')->user()->npp]) }}">
                    <a class="nav-link" href="/karyawan/{{ Auth::guard('karyawan')->user()->npp }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ set_active(['checkingibadah']) }}">
                    <a class="nav-link" href="/checkingibadah">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="9 11 12 14 20 6" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Check List Ibadah
                        </span>
                    </a>

                </li>
                <li class="nav-item {{ set_active(['checkingibadah/laporan']) }}">
                    <a class="nav-link" href="/checkingibadah/laporan">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <i class="fa fa-file"></i>
                        </span>
                        <span class="nav-link-title">
                            Lap. Amalan Harian
                        </span>
                    </a>

                </li>
            @endif
        @endif
    </ul>

</div>
