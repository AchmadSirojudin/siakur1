@extends('admin.app')
@section('title-content')
    Data Jadwal
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Jadwal</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Lihat Jadwal</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="/data-jadwal" type="button" id="btntambah"
                class="btn btn-secondary rounded-pill font-weight-bold text-xs text-white">
                <i class="material-icons opacity-10">arrow_back</i>
                Kembali
            </a>
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Atur Jadwal Pelajaran Kelas :
                            {{ $kelas->namakelas ?? '' }}
                            {{-- {{ $j->mapel->namamapel ?? '' }} --}}
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <div class="col text-right">
                            <a href="/data-jadwalsiswa/cetak_pdf/{{ $kelas->id }}" type="button"
                                class="btn btn-primary font-weight-bold text-xs text-white"
                                style="float:left; background-color:rgb(167, 72, 255);" target="_blank">
                                <i class="material-icons opacity-10">print</i>
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
                                        Mata Pelajaran
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Guru
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
                                            {{ $j->mapel->namamapel ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $j->guru->nama ?? '' }}

                                        </td>
                                        <td class="text-center">
                                            {{ $j->keterangan }}
                                        </td>

                                    </tr>

                                    {{-- modal edit --}}
                                    <div class="modal fade" id="edit-modal{{ $j->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Jadwal
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-custom fw-normal" role="alert"
                                                        style="background-color:rgb(255, 213, 151) !important;">
                                                        <i>NB : Tulis keterangan jadwal jika tidak ada mapel yang dipilih.
                                                            Contoh : Upacara, Istirahat</i>
                                                    </div>
                                                    <br>
                                                    <form action="/data-jadwal-update/{{ $j->id }}"
                                                        class="row g-3 px-4" method="post" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="hidden" name="kelas_id" class="form-control rounded-3"
                                                            value="{{ $j->kelas_id ?? '' }}">
                                                        <div class="row">
                                                            <div class="col-md-6 pb-2">
                                                                <label for="inputEmail4" class="form-label">Hari</label>
                                                                <select
                                                                    class="form-select rounded-3 form-control-lg text-sm"
                                                                    aria-label="Default select example" name="hari">
                                                                    <option selected disabled>-- Pilih Hari --</option>
                                                                    <option value="1"
                                                                        {{ $j->hari == '1' ? 'Selected' : '' }}>
                                                                        Senin
                                                                    </option>
                                                                    <option value="2"
                                                                        {{ $j->hari == '2' ? 'Selected' : '' }}>
                                                                        Selasa
                                                                    </option>
                                                                    <option value="3"
                                                                        {{ $j->hari == '3' ? 'Selected' : '' }}>
                                                                        Rabu
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ $j->hari == '4' ? 'Selected' : '' }}>
                                                                        Kamis
                                                                    </option>
                                                                    <option value="5"
                                                                        {{ $j->hari == '5' ? 'Selected' : '' }}>
                                                                        Jumat
                                                                    </option>
                                                                    <option value="6"
                                                                        {{ $j->hari == '6' ? 'Selected' : '' }}>
                                                                        Sabtu
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 pb-2">
                                                                <label for="inputEmail4" class="form-label">Mapel</label>
                                                                <select
                                                                    class="form-select rounded-3 form-control-lg text-sm"
                                                                    aria-label="Default select example" name="mapel_id">
                                                                    <option value="0" selected disabled>-- Pilih
                                                                        Mapel --</option>
                                                                    @foreach ($mapel as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $j->mapel_id == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->namamapel }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 pb-2">
                                                                <label for="inputEmail4" class="form-label">Jam
                                                                    Awal</label>
                                                                <input type="time" class="form-control" name="jamawal"
                                                                    id="inputEmail4" value="{{ $j->jamawal }}">
                                                            </div>
                                                            <div class="col-md-6 pb-2">
                                                                <label for="inputEmail4" class="form-label">Jam
                                                                    Akhir</label>
                                                                <input type="time" class="form-control" name="jamaakhir"
                                                                    id="inputEmail4" value="{{ $j->jamaakhir }}">
                                                            </div>
                                                            <div class="col-md-6 pb-2">
                                                                <label for="inputEmail4" class="form-label">Guru</label>
                                                                <select
                                                                    class="form-select rounded-3 form-control-lg text-sm"
                                                                    aria-label="Default select example" name="guru_id">
                                                                    <option value="0" selected disabled>-- Pilih
                                                                        Guru --</option>
                                                                    @foreach ($guru as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $j->guru_id == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 pb-2">
                                                                <label for="inputPassword4"
                                                                    class="form-label">Keterangan</label>
                                                                <input type="text" class="form-control"
                                                                    name="keterangan" id="inputPassword4"
                                                                    value="{{ $j->keterangan }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-custom fw-normal" role="alert"
                        style="background-color:rgb(255, 213, 151) !important;">
                        <i>NB : Tulis keterangan jadwal jika tidak ada mapel yang dipilih. Contoh : Upacara, Istirahat</i>
                    </div>
                    <form action="/data-jadwal-insert" class="row g-3 px-4" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kelas_id" class="form-control rounded-3"
                            value="{{ $kelas->id ?? '' }}">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Hari</label>
                            <div class="input-group">
                                <select required class="form-select rounded-3 form-control-lg text-sm"
                                    aria-label="Default select example" name="hari">
                                    <option value="" selected disabled>-- Pilih Hari --</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jumat</option>
                                    <option value="6">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Mapel</label>
                            <div class="input-group">
                                <select class="form-select rounded-3 form-control-lg text-sm"
                                    aria-label="Default select example" name="mapel_id">
                                    <option value="0" selected disabled>-- Pilih Mapel --</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}">{{ $item->namamapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Jam Awal</label>
                            <div class="input-group">
                                <input type="time" name="jamawal" class="form-control rounded-3" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Jam Akhir</label>
                            <div class="input-group">
                                <input type="time" name="jamaakhir" class="form-control rounded-3" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Guru</label>
                            <div class="input-group">
                                <select class="form-select rounded-3 form-control-lg text-sm"
                                    aria-label="Default select example" name="guru_id">
                                    <option value="0" selected disabled>-- Pilih Guru --</option>
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Keterangan</label>
                            <div class="input-group">
                                <input type="text" onkeypress="return hanyaAngka(event)" name="keterangan"
                                    class="form-control rounded-3">
                            </div>
                        </div>
                        <br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
{{-- footer --}}
