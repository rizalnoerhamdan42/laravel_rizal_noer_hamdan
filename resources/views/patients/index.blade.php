@extends('layouts.app')

@section('content')


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="container">
        <h4>Data Pasien</h4>

        <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Tambah Pasien</a>

        <div class="mb-3">
            <label for="hospital-id">Filter Rumah Sakit</label>
            <select id="hospital-id" class="form-control">
                <option value="">-- Semua Rumah Sakit --</option>
                @foreach($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        <table class="table table-bordered" id="patientsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="patients-table-body">
                @include('patients.row_patients_table', ['patients' => $patients])

            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {
            $('#hospital-id').change(function () {
                let hospital_id = $(this).val();
                $.ajax({
                    url: "{{ route('patients.filter') }}",
                    type: "GET",
                    data: { hospital_id: hospital_id },
                    success: function (html) {
                        $('#patientsTable tbody').html(html);
                    }
                });
            });

            // load semua pasien pertama kali
            $.ajax({
                url: "{{ route('patients.filter') }}",
                type: "GET",
                success: function (html) {
                    $('#patientsTable tbody').html(html);
                }
            });
        });
    </script>
@endpush