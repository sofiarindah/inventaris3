@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Detail Barang</h5>

            <div class="text-center mb-3">
                @if ($item->photo)
                    <img src="{{ asset('photos/' . $item->photo) }}" alt="{{ $item->name }}"
                         style="max-width:260px;max-height:260px;object-fit:cover;border-radius:8px;">
                @else
                    <span class="text-muted">Tidak ada foto</span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-4">Nama Barang</dt>
                        <dd class="col-8">{{ $item->name }}</dd>

                        <dt class="col-4">Nomor Seri</dt>
                        <dd class="col-8">{{ $item->unique_code }}</dd>

                        <dt class="col-4">Lokasi</dt>
                        <dd class="col-8">{{ $item->location ?? '-' }}</dd>

                        <dt class="col-4">Status/Kondisi</dt>
                        <dd class="col-8">{{ $item->condition }}</dd>

                        <dt class="col-4">Penanggung Jawab</dt>
                        <dd class="col-8">{{ optional($item->user)->name ?? '-' }}</dd>

                        <dt class="col-4">Terakhir Diupdate</dt>
                        <dd class="col-8">{{ $item->updated_at?->format('d-m-Y H:i') }}</dd>
                    </dl>
                </div>
            </div>

            <a href="{{ route('item.index') }}" class="btn btn-primary mt-2">Kembali</a>
        </div>
    </div>
@endsection