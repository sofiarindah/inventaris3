@extends('admin.layouts.app')

@section('css')
    {{-- CSS Tambahan --}}
@endsection

@section('content')
    <div class="card">

        <div class="card-body">

            <h5 class="card-title fw-semibold mb-4">Ubah Data {{ $title }}</h5>

            <div class="card">

                <div class="card-body">

                    <form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Item --}}

                        <div class="mb-3">

                            <label for="name" class="form-label">Nama Item</label>

                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Nama Item"
                                value="{{ old('name', $item->name) }}">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            
                        </div>



                        {{-- Kategori --}}

                        <div class="mb-3">

                            <label for="category_id" class="form-label">Kategori</label>

                            <select
                                class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                id="category_id">

                                <option value="" disabled>Pilih Kategori</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach

                                </select>

                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            
                        </div>



                        {{-- Foto --}}

                        <div class="mb-3">

                            <label for="photo" class="form-label">Ganti Foto
                                (Opsional)</label>

                            @if ($item->photo)
                                <p>Foto saat ini: <img src="{{ asset('photos/' . $item->photo) }}" alt="Foto Item"
                                        width="100"></p>
                            @endif

                            <input type="file"
                                class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo">

                            @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            
                        </div>



                        {{-- Kode Unik --}}

                        <div class="mb-3">

                            <label for="unique_code" class="form-label">Kode Unik</label>

                            <input type="text"
                                class="form-control @error('unique_code') is-invalid @enderror" name="unique_code"
                                id="unique_code" placeholder="Contoh: MM-001"
                                value="{{ old('unique_code', $item->unique_code) }}">

                            @error('unique_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            
                        </div>



                        {{-- Kondisi --}}

                        <div class="mb-3">

                            <label for="condition" class="form-label">Kondisi</label>

                            <select class="form-select @error('condition') is-invalid @enderror"
                                name="condition" id="condition">

                                <option value="Baik"
                                    {{ old('condition', $item->condition) == 'Baik' ? 'selected' : '' }}>Baik</option>

                                <option value="Rusak"
                                    {{ old('condition', $item->condition) == 'Rusak' ? 'selected' : '' }}>Rusak</option>

                                </select>

                            @error('condition')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            
                        </div>



                        {{-- Lokasi --}}
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                   name="location" id="location" placeholder="Contoh: musholla / kelas"
                                   value="{{ old('location', $item->location) }}">
                            @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Penanggung Jawab --}}
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Penanggung Jawab</label>
                            <select class="form-select @error('user_id') is-invalid @enderror"
                                    name="user_id" id="user_id">
                                <option value="" disabled>Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Tombol --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>

                        <a href="{{ route('item.index') }}" class="btn btn-warning">Kembali</a>

                        </form>

                    </div>

                </div>

            </div>

        </div>
@endsection

@section('js')
    {{-- JS Tambahan --}}
@endsection
