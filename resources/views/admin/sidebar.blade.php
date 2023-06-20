<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" /dashboard">
            {{-- <img src="{{ asset('') }}assets/img/logo2.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <div class="text-white w-auto ">
                <i class="material-icons opacity-10" style="font-size:35px">school</i> <span
                    class="ms-1 font-weight-bold text-white" style="font-size:23px">SIAKUR</span>
            </div>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (Auth::guard('admin')->check())
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'dashboard' ? 'bg-gradient-primary ' : '' }} "
                        href="/dashboard">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-pegawai' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-pegawai-edit' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-pegawai-add' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-pegawai">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">people</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Pegawai</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-guru' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-guru-edit' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-guru-add' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-guru">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-mapel' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-mapel">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">task</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Mata Pelajaran</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-jadwal' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-jadwal-atur' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-jadwal">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Jadwal Pelajaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-jadwalmengajar' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-jadwalmengajar-atur' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-jadwalmengajar-cek' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-jadwalmengajar">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">description</i>
                        </div>
                        <span class="nav-link-text ms-1">Jadwal Mengajar Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-raport-admin' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-raport-cek' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-raport-admin">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">document_scanner</i>
                        </div>
                        <span class="nav-link-text ms-1">Raport</span>
                    </a>
                </li>
            @elseif(Auth::guard('guru')->check())
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'dashboard' ? 'bg-gradient-primary ' : '' }} "
                        href="/dashboard">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'editpassword' ? 'bg-gradient-primary ' : '' }}  "
                        href="/editpassword">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">key</i>
                        </div>
                        <span class="nav-link-text ms-1">Edit Password</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-jadwalguru' ? 'bg-gradient-primary ' : '' }} "
                        href="/data-jadwalguru/{{ Auth::guard('guru')->user()->id }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">description</i>
                        </div>
                        <span class="nav-link-text ms-1">Jadwal Mengajar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-inputnilai' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-nilai-atur' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-detail-nilai' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-input-nilai' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-inputnilai/{{ Auth::guard('guru')->user()->id }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">grading</i>
                        </div>
                        <span class="nav-link-text ms-1">Input Nilai</span>
                    </a>
                </li>
                @if (App\Models\Kelas::where('guru_id', Auth::guard('guru')->user()->id)->first())
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->segment(1) == 'data-raport' ? 'bg-gradient-primary ' : '' }}   {{ request()->segment(1) == 'data-raport-input' ? 'bg-gradient-primary ' : '' }} "
                            href="/data-raport">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">document_scanner</i>
                            </div>
                            <span class="nav-link-text ms-1">Input Raport</span>
                        </a>
                    </li>
                @endif
            @elseif(Auth::guard('siswa')->check())
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'dashboard' ? 'bg-gradient-primary ' : '' }} "
                        href="/dashboard">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'editpassword' ? 'bg-gradient-primary ' : '' }}  "
                        href="/editpassword">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">key</i>
                        </div>
                        <span class="nav-link-text ms-1">Edit Password</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-jadwal' ? 'bg-gradient-primary ' : '' }} "
                        href="/data-jadwal/{{ Auth::guard('siswa')->user()->kelas_id }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">description</i>
                        </div>
                        <span class="nav-link-text ms-1">Jadwal Pelajaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        {{ request()->segment(1) == 'data-raport' ? 'bg-gradient-primary ' : '' }}
                        {{ request()->segment(1) == 'data-raport-input' ? 'bg-gradient-primary ' : '' }}>
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">document_scanner</i>
                        </div>
                        <span class="nav-link-text ms-1">Raport</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item"
                                href="/data-raport-cetak-siswa/{{ Auth::guard('siswa')->user()->id }}/1">Semester
                                1</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="/data-raport-cetak-siswa/{{ Auth::guard('siswa')->user()->id }}/2">Semester
                                2</a>
                        </li>


                    </ul>
                </li>
            @elseif(Auth::guard('kepsek')->check())
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'dashboard' ? 'bg-gradient-primary ' : '' }} "
                        href="/dashboard">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-pegawai-lihat' ? 'bg-gradient-primary ' : '' }} "
                        href="/data-pegawai-lihat">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">people</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Pegawai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-guru-lihat' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-guru-edit' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-guru-lihat">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <span class="nav-link-text ms-1">Data Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-jadwalmengajar-guru' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-jadwalmengajar-cek' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-jadwalmengajar-guru">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">description</i>
                        </div>
                        <span class="nav-link-text ms-1">Jadwal Mengajar Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->segment(1) == 'data-jadwal-cek' ? 'bg-gradient-primary ' : '' }} {{ request()->segment(1) == 'data-jadwal-cekjadwal' ? 'bg-gradient-primary ' : '' }}"
                        href="/data-jadwal-cek">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Jadwal Pelajaran</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100 font-weight-bold"
                onclick="return confirm('Apakah anda yakin akan keluar?')" href="/logout" type="button"><i
                    class="fa fa-sign-out"></i> Keluar</a>
        </div>
    </div>
</aside>
