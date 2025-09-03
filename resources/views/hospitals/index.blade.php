@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">
        <h3>Data Rumah Sakit</h3>
        <a href="{{ route('hospitals.create') }}" class="btn btn-primary mb-3">Tambah Rumah Sakit</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Rumah Sakit</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hospitals as $i => $hospital)
                    <tr id="hospital-row-{{ $hospital->id }}">
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $hospital->hospital_code }}</td>
                        <td>{{ $hospital->name }}</td>
                        <td>{{ $hospital->address }}</td>
                        <td>{{ $hospital->email }}</td>
                        <td>{{ $hospital->phone }}</td>
                        <td>
                            <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $hospital->id }}"
                                data-name="{{ $hospital->name }}"> Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="999" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.deleteBtn').click(function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let url = "/hospitals/" + id;

                Swal.fire({
                    title: 'Apakah Anda yakin menghapus data ' + name + ' ?',
                    text: "Data Rumah sakit akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        location.reload(); // reload setelah alert ditutup
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Data gagal dihapus.',
                                        'error'
                                    );
                                }
                            },

                            error: function (xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan pada server.',
                                    'error'
                                )
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush