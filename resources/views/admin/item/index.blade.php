@extends('admin.layouts.app')
@section('css')
    {{-- CSS Tambahan --}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Barang 
                {{-- {{ $title }} --}}
            </h5>
            <a href="{{ route('item.create') }}" class="btn btn-primary mb-4">Tambah Data Barang 
                {{-- {{ $title }} --}}
            </a>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Foto</th>
                            <th>Nomor Seri</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Penanggung Jawab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->photo)
                                        <img src="{{ asset('photos/' . $item->photo) }}"
                                             alt="{{ $item->name }}"
                                             style="width:60px;height:60px;object-fit:cover;border-radius:6px;">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>{{ $item->unique_code }}</td>
                                <td>{{ $item->location ?? '-' }}</td>
                                <td>{{ $item->condition }}</td>
                                <td>{{ optional($item->user)->name ?? '-' }}</td>
                                <td>
                                    <button type="button"
                                            class="btn btn-info btn-sm"
                                            onclick="openQrModal('{{ $item->name }}','{{ route('item.show', $item->id) }}')">QR</button>
                                    <a href="{{ route('item.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">Ubah</a>

                                    <form id="deleteForm{{ $item->id }}"
                                        action="{{ route('item.destroy', $item->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $item->id }})">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal QR -->
            <div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrTitle">QR</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div id="qrContainer" class="d-flex justify-content-center"></div>
                            <small id="qrUrl" class="text-muted d-block mt-2"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        function openQrModal(name, url) {
            document.getElementById('qrTitle').innerText = 'QR - ' + name;
            document.getElementById('qrUrl').innerText = url;
            const container = document.getElementById('qrContainer');
            container.innerHTML = '';
            new QRCode(container, {
                text: url,
                width: 220,
                height: 220,
                correctLevel: QRCode.CorrectLevel.H
            });
            const modal = new bootstrap.Modal(document.getElementById('qrModal'));
            modal.show();
        }

        // Script untuk SweetAlert
        function confirmDelete(id) {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#deleteForm' + id).submit();
                    } else {
                        swal("Data tidak jadi dihapus!", { icon: "error" });
                    }
                });
        }
    </script>
@endsection
