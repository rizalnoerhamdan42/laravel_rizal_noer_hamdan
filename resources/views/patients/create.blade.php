@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Tambah Pasien</h3>
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <div class="form-group" style="margin-top: 20px">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group" style="margin-top: 20px">
                <label>Alamat</label>
                <textarea name="address" class="form-control">{{ old('address') }}</textarea>
            </div>
            <div class="form-group" style="margin-top: 20px">
                <label>No. Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>
            <div class="form-group" style="margin-top: 20px">
                <label>Rumah Sakit</label>
                <select name="hospital_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach($hospitals as $h)
                        <option value="{{ $h->id }}" {{ old('hospital_id') == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="margin-top: 40px">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
@endsection