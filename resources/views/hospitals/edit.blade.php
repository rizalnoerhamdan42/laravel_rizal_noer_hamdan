@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Data Rumah Sakit</h2>

        <form action="{{ route('hospitals.update', $hospital->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-2" style="margin-top: 20px">
                <label for="nama">Kode Rumah Sakit</label>
                <input type="text" name="hospital_code" class="form-control @error('hospital_code') is-invalid @enderror"
                    value="{{ old('hospital_code', $hospital->hospital_code) }}">
                @error('hospital_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Nama -->
            <div class="form-group mb-2" style="margin-top: 20px">
                <label for="nama">Nama Rumah Sakit</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $hospital->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="form-group mb-2" style="margin-top: 20px">
                <label for="alamat">Alamat</label>
                <textarea name="address"
                    class="form-control @error('address') is-invalid @enderror">{{ old('address', $hospital->address) }}</textarea>

                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <!-- Email -->
            <div class="form-group mb-2" style="margin-top: 20px">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $hospital->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Telepon -->
            <div class="form-group mb-2" style="margin-top: 20px">
                <label for="telepon">Telepon</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $hospital->phone) }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-2" style="margin-top: 20px">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('hospitals.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
@endsection