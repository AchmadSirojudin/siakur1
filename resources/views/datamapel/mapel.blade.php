@extends('admin.app')
@section('title-content')
    Data Mapel
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-mapel">Mapel</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Mata Pelajaran</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Mata Pelajaran</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <button type="button" id="btntambah" class="btn btn-primary font-weight-bold text-xs"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="material-icons opacity-10">add</i>
                            Tambah
                        </button>
                        <!-- Button trigger modal -->

                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Kode Mapel</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Mapel</th>

                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapel as $u)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $u->kodemapel }}
                                        </td>
                                        <td class="text-center">
                                            {{ $u->namamapel }}
                                        </td>

                                        <td class="text-center">
                                            <button type="button"data-bs-toggle="modal"
                                                data-bs-target="#edit-modal{{ $u->id }}"
                                                class="btn
                                                btn-warning font-weight-bold btn--edit text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                                <i class="fa fa-edit"></i>

                                            </button>

                                            <a href="data-mapel-hapus/{{ $u->id }}"
                                                onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                                class=" btn btn-danger font-weight-bold text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- modal detail --}}
                                    <div class="modal fade" id="edit-modal{{ $u->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Mata
                                                        Pelajaran
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <br>
                                                    <form action="data-mapel-update/{{ $u->id }}"
                                                        class="row g-3 px-3" method="post" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row g-2 align-items-center px-3">
                                                            <div class="col-auto">
                                                                <label for="inputPassword6" class="col-form-label">Kode
                                                                    Mapel&nbsp&nbsp</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="kodemapel"
                                                                    class="form-control text-sm" value="{{ $u->kodemapel }}"
                                                                    required readonly>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row g-2 align-items-center px-3">
                                                            <div class="col-auto">
                                                                <label for="inputPassword6" class="col-form-label">Nama
                                                                    Mapel</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="namamapel"
                                                                    class="form-control text-sm" value="{{ $u->namamapel }}"
                                                                    required>
                                                            </div>

                                                        </div>
                                                        <br>
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
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="data-mapel-insert" class="row g-3 px-3" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Kode Mapel&nbsp</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="kodemapel" class="form-control" required disabled>
                            </div>

                        </div> --}}
                        <br>
                        <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Nama Mapel</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="namamapel" class="form-control" required>
                            </div>

                        </div>
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
