@extends('layouts.admin')

@section('title', 'Form Edit')
@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('employee.update', $item->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="col-12">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->nama }}">
                </div>
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $item->nip }}">
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $item->tanggal_lahir }}">
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                        <option value="">Pilih Jenis Kelamin</option>
                        @foreach ($genders as $value)
                            <option value="{{ $value->id }}" {{ $item->jenis_kelamin == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}">
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $item->nomor_telepon }}">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control">{{ $item->alamat }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select name="agama" class="form-control" id="agama">
                        <option value="">Pilih Agama</option>
                        @foreach ($genders as $value)
                            <option value="{{ $value->id }}" {{ $item->agama == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
