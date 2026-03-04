@extends('layouts.admin')

@section('content')
    <div x-data="{
        items: [{ id: Date.now() }],
        addItem() { this.items.push({ id: Date.now() }) },
        removeItem(index) { if (this.items.length > 1) this.items.splice(index, 1) }
    }">
        <div class="mb-3">
            <h5 class="fw-bold">Input Barang Baru</h5>
        </div>
        {{-- GLOBAL ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <template x-for="(item, index) in items" :key="item.id">
                <div class="card p-3 mb-3 border-0 shadow-sm border-start border-primary border-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-primary">Barang #<span x-text="index + 1"></span></span>
                        <button type="button" @click="removeItem(index)" class="btn-close" style="font-size: 0.7rem;"
                            x-show="items.length > 1"></button>
                    </div>
                    <input type="text" :name="`items[${index}][nama]`" class="form-control mb-2"
                        placeholder="Nama Produk" required>
                    <div class="row g-2 mb-2">
                        <div class="col-4">
                            <label class="small text-muted">Modal</label>
                            <input type="number" :name="`items[${index}][harga_modal]`"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="col-4">
                            <label class="small text-muted">Hrg Toko</label>
                            <input type="number" :name="`items[${index}][harga_dalam]`"
                                class="form-control form-control-sm" required>
                        </div>
                        <div class="col-4">
                            <label class="small text-muted">Hrg Luaran</label>
                            <input type="number" :name="`items[${index}][harga_luar]`" class="form-control form-control-sm"
                                required>
                        </div>
                    </div>
                    <input type="file" :name="`items[${index}][foto]`" class="form-control form-control-sm">
                </div>
            </template>

            <div class="mt-4">

                {{-- Tambah Baris --}}
                <button type="button" @click="addItem()" class="btn btn-outline-primary btn-sm w-100 mb-3">
                    + Tambah Baris Input
                </button>

                {{-- Simpan & Kembali sejajar --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-fill fw-bold shadow-sm">
                        SIMPAN SEMUA DATA
                    </button>

                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary flex-fill">
                        Kembali
                    </a>
                </div>

            </div>
        </form>
    </div>
@endsection
