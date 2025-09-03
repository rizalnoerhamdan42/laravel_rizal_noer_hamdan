@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Data Pasien</h3>

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Nama</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $patient->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group mb-2" style="margin-top: 20px">
                <label for="alamat">Alamat</label>
                <textarea name="address"
                    class="form-control @error('address') is-invalid @enderror">{{ old('address', $patient->address) }}</textarea>

                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Telepon --}}
            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Telepon</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $patient->phone) }}">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group mb-2" style="margin-top: 20px">
                <label>Rumah Sakit</label>
                <select name="hospital_id" class="form-control @error('hospital_id') is-invalid @enderror">
                    <option value="">-- Pilih Rumah Sakit --</option>
                    @foreach($hospitals as $hospital)
                        <option value="{{ $hospital->id }}" {{ old('hospital_id', $patient->hospital_id) == $hospital->id ? 'selected' : '' }}>
                            {{ $hospital->name }}
                        </option>
                    @endforeach
                </select>
                @error('hospital_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group mb-2" style="margin-top: 40px">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
@endsection