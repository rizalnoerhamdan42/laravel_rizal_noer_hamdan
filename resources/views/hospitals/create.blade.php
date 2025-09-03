@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tambah Rumah Sakit</h3>
        <form action="{{ route('hospitals.store') }}" method="POST">
            @csrf

            {{-- Kode Rumah Sakit --}}
            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Kode Rumah Sakit</label>
                <input type="text" name="hospital_code" class="form-control @error('hospital_code') is-invalid @enderror"
                    value="{{ old('hospital_code') }}">
                @error('hospital_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Nama --}}
            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Nama</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Alamat</label>
                <textarea name="address"
                    class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Telepon --}}
            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Telepon</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-2" style="margin-top: 40px">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('hospitals.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection