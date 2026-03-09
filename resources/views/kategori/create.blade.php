@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">

            <h5 class="mb-3">Tambah Kategori</h5>

            <form method="POST" action="{{ route('kategori.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>

                    <input type="text" name="nama" class="form-control" required>
                </div>

                <button class="btn btn-primary btn-sm">
                    Simpan
                </button>

                <a href="{{ route('kategori.index') }}" class="btn btn-secondary btn-sm">
                    Kembali
                </a>

            </form>

        </div>
    </div>
@endsection
