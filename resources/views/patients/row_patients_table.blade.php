@foreach($patients as $i => $p)
    <tr id="patient-row-{{ $p->id }}">
        <td>{{ $i + 1 }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->address }}</td>
        <td>{{ $p->phone }}</td>
        <td>{{ $p->hospital ? $p->hospital->name : '-' }}</td>
        <td>
            <a href="{{ route('patients.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $p->id }}" data-name="{{ $p->name }}">
                Hapus</button>
        </td>
    </tr>
@endforeach

@if($patients->count() == 0)
    <tr>
        <td colspan="999" class="text-center">Tidak ada data</td>
    </tr>
@endif




@push('scripts')
    <script>
        $(document).on('click', '.deleteBtn', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let url = "/patients/" + id;

            Swal.fire({
                title: 'Apakah Anda yakin menghapus data pasien ' + name + ' ?',
                text: "Data pasien akan dihapus permanen!",
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
                        data: { _token: "{{ csrf_token() }}" },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                $('#patient-row-' + id).remove();
                            } else {
                                Swal.fire('Gagal!', 'Data gagal dihapus.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error!', 'Terjadi kesalahan pada server.', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush