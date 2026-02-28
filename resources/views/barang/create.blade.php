@extends('layouts.admin')

@section('content')
<div x-data="{ 
    items: [{ id: Date.now() }],
    addItem() { this.items.push({ id: Date.now() }) },
    removeItem(index) { if(this.items.length > 1) this.items.splice(index, 1) }
}">
    <div class="mb-3">
        <a href="{{ route('barang.index') }}" class="text-decoration-none small text-muted">← Kembali</a>
        <h5 class="fw-bold">Input Barang Baru</h5>
    </div>

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <template x-for="(item, index) in items" :key="item.id">
            <div class="card p-3 mb-3 border-0 shadow-sm border-start border-primary border-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-primary">Barang #<span x-text="index + 1"></span></span>
                    <button type="button" @click="removeItem(index)" class="btn-close" style="font-size: 0.7rem;" x-show="items.length > 1"></button>
                </div>
                <input type="text" :name="`items[${index}][nama]`" class="form-control mb-2" placeholder="Nama Produk" required>
                <div class="row g-2 mb-2">
                    <div class="col-4">
                        <label class="small text-muted">Modal</label>
                        <input type="number" :name="`items[${index}][harga_modal]`" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-4">
                        <label class="small text-muted">Hrg Dalam</label>
                        <input type="number" :name="`items[${index}][harga_dalam]`" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-4">
                        <label class="small text-muted">Hrg Luar</label>
                        <input type="number" :name="`items[${index}][harga_luar]`" class="form-control form-control-sm" required>
                    </div>
                </div>
                <input type="file" :name="`items[${index}][foto]`" class="form-control form-control-sm">
            </div>
        </template>

        <div class="mt-4">
            <button type="button" @click="addItem()" class="btn btn-outline-primary btn-sm w-100 mb-2">
                + Tambah Baris Input
            </button>
            <button type="submit" class="btn btn-success w-100 fw-bold shadow">
                SIMPAN SEMUA DATA
            </button>
        </div>
    </form>
</div>
@endsection