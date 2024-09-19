@extends('layouts.appAdmin')

@section('title', 'Tambah Kategori')

@section('page-title', 'Daftar Kategori')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Kategori</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                {{-- Nama Kategori --}}
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Kategori">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Deskripsi Kategori --}}
                <div class="form-group">
                    <label for="description">Deskripsi Kategori</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                        id="description" placeholder="Masukkan Deskripsi Kategori">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tombol Submit dan Kembali --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

