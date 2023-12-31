@extends('admin.app')
@section('title-content')
    Data Jadwal
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Jadwal Mengajar</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Jadwal Mengajar Guru :
                            {{ Auth::guard('guru')->user()->nama }} ({{ Auth::guard('guru')->user()->NIP }})
                            {{-- {{ $guru->nama ?? '' }} ({{ $guru->NIP ?? '' }}) --}}
                            {{-- {{ $j->mapel->namamapel ?? '' }} --}}
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <div class="col text-right">

                            <a href="/data-jadwalguru/cetak_pdf/{{ $guru->id }}" target="_blank" type="button"
                                class="btn btn-cetak font-weight-bold text-xs text-white"
                                style="float: left;margin-right:10px; background-color:rgb(167, 72, 255);"> <i
                                    class="material-icons opacity-10">print</i>
                                Cetak
                            </a>
                        </div>
                        <!-- Button trigger modal -->
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Hari</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Jam
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Kelas
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Keterangan</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $j)
                                    <tr>

                                        <td class="text-center">
                                            {{ $hari[$j->hari] }}
                                        </td>

                                        <td class="text-center">
                                            {{ Carbon\Carbon::parse($j->jamawal)->format('G:i') }} -
                                            {{ Carbon\Carbon::parse($j->jamaakhir)->format('G:i') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $j->kelas->namakelas ?? '-' }}
                                        </td>

                                        <td class="text-center">
                                            {{ $j->keterangan ?? '-' }}
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
{{-- footer --}}
