@extends('admin.app')
@section('title-content')
    Dashboard
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
@endsection
@section('content')
    <!-- End Navbar -->
    @if (Auth::guard('admin')->check())
        <div class="row">
            {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">people</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA PEGAWAI</b></p>
                            <h4 class="mb-0">{{ $pegawai->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA GURU</b></p>
                            <h4 class="mb-0">{{ $guru->count() }}</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA KELAS</b></p>
                            <h4 class="mb-0">{{ $kelas->count() }}</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-warning shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">group</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA SISWA</b></p>
                            <h4 class="mb-0">{{ $siswa->count() }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @elseif(Auth::guard('guru')->check())
        <div class="row">
            <div class="col-lg-12 col-md-6 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div class="chart">
                                {{-- <canvas id="chart-bars" class="chart-canvas" height="170"></canvas> --}}
                                <h6 class="text-white text-capitalize ps-3">Data Guru
                                    {{-- {{ $kelas->guru_id ? 'ada' : 'tidak' }} --}}
                                </h6>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="foto">
                                    <img src="{{ Auth::guard('guru')->user()->foto ? asset('assets/img/pegawai/' . Auth::guard('guru')->user()->foto) : asset('assets/img/thumbnail.png') }} "
                                        alt="" width="100%" height="auto">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">NIP</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('guru')->user()->NIP }}
                                                {{-- {{ $g->NIP }} --}}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Nama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('guru')->user()->nama }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Jenis
                                                    Kelamin</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('guru')->user()->jk }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tempat,
                                                    tanggal
                                                    lahir</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('guru')->user()->tempatlahir }},

                                                {{ \Carbon\Carbon::parse(Auth::guard('guru')->user()->tgllahir)->format('d-m-Y') }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">No Telepon
                                                </span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('guru')->user()->notelp }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Agama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('guru')->user()->agama }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Alamat</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('guru')->user()->alamat }}

                                            </div>
                                        </div>
                                    </li>
                                    @if ($walikelas)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Wali Kelas</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $walikelas->namakelas }}

                                                </div>
                                            </div>
                                        </li>
                                    @else
                                    @endif


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::guard('siswa')->check())
        <div class="row">
            <div class="col-lg-12 col-md-6 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div class="chart">

                                <h6 class="text-white text-capitalize ps-3">Data Siswa
                                </h6>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="foto">
                                    <img src="{{ Auth::guard('siswa')->user()->foto ? asset('assets/img/pegawai/' . Auth::guard('siswa')->user()->foto) : asset('assets/img/thumbnail.png') }} "
                                        alt="" width="100%" height="auto">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">NISN</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('siswa')->user()->nisn }}
                                                {{-- {{ $g->NIP }} --}}
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Nama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('siswa')->user()->fullname }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Kelas</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('siswa')->user()->kelas->namakelas }}

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Jenis
                                                    Kelamin</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7 text-capitalize">
                                                {{ Auth::guard('siswa')->user()->jk }}
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">No Telepon
                                                </span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('siswa')->user()->notelp }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Agama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('siswa')->user()->agama }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Alamat</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7">
                                                {{ Auth::guard('siswa')->user()->alamat }}

                                            </div>
                                        </div>
                                    </li>



                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::guard('kepsek')->check())
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">people</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA PEGAWAI</b></p>
                            <h4 class="mb-0">{{ $pegawai->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA GURU</b></p>
                            <h4 class="mb-0">{{ $guru->count() }}</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA KELAS</b></p>
                            <h4 class="mb-0">{{ $kelas->count() }}</h4>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-warning shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">group</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>DATA SISWA</b></p>
                            <h4 class="mb-0">{{ $siswa->count() }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection
