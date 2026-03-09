@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">

            <h5 class="mb-3">Edit Kategori</h5>

            <form method="POST" action="{{ route('kategori.update', $kategori->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">Nama</label>

                    <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control" required>

                </div>

                <button class="btn btn-primary btn-sm">
                    Update
                </button>

                <a href="{{ route('kategori.index') }}" class="btn btn-secondary btn-sm">
                    Kembali
                </a>

            </form>

        </div>
    </div>
@endsection
