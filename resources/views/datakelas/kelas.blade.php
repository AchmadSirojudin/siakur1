@extends('admin.app')
@section('title-content')
    Data Kelas
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Kelas</h6>
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
                                        Nama Kelas</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Wali Kelas</th>

                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $u)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $u->namakelas }}
                                        </td>
                                        <td class="text-center">
                                            {{ $u->guru->nama }}
                                        </td>

                                        <td class="text-center">
                                            <button type="button"data-bs-toggle="modal"
                                                data-bs-target="#edit-modal{{ $u->id }}"
                                                class="btn
                                                btn-warning font-weight-bold btn--edit text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                                                <i class="fa fa-edit"></i>

                                            </button>

                                            <a href="data-kelas-hapus/{{ $u->id }}"
                                                onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                                class=" btn btn-danger font-weight-bold text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- modal edit --}}
                                    <div class="modal fade" id="edit-modal{{ $u->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Kelas
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <br>
                                                    <form action="data-kelas-update/{{ $u->id }}"
                                                        class="row g-3 px-4" method="post" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row g-2 align-items-center px-3">
                                                            <div class="col-auto">
                                                                <label for="inputPassword6" class="col-form-label">Nama
                                                                    Kelas</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="namakelas"
                                                                    class="form-control text-sm" value="{{ $u->namakelas }}"
                                                                    required>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row g-2 align-items-center px-3">
                                                            <div class="col-auto">
                                                                <label for="inputPassword6" class="col-form-label">Wali
                                                                    Kelas &nbsp&nbsp</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    <select
                                                                        class="form-select rounded-3 form-control-lg text-sm"
                                                                        aria-label="Default select example" name="guru_id">
                                                                        <option value="0" selected disabled>-- Pilih
                                                                            Guru --</option>
                                                                        @foreach ($guru as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $u->guru->id == $item->id ? 'selected' : '' }}>
                                                                                {{ $item->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
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
                    <form action="data-kelas-insert" class="row g-3 px-4" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Nama Kelas</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="namakelas" class="form-control" required>
                            </div>

                        </div>
                        <br>
                        <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Wali Kelas &nbsp&nbsp</label>
                            </div>
                            <div class="col-md-9">
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
