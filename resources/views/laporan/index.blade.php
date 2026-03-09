@extends('layouts.admin')

@section('content')
    <h5 class="mb-3">
        Laporan {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
    </h5>

    @auth
        @if (auth()->user()->level == 'admin')
            <div class="filter-bar mb-3">
                <div class="d-flex gap-2 overflow-auto pb-1">


                    @foreach ($dates as $d)
                        <a href="{{ route('laporan.index', ['tanggal' => $d]) }}"
                            class="btn btn-sm {{ $tanggal == $d ? 'btn-primary' : 'btn-light' }}" style="white-space:nowrap">

                            {{ \Carbon\Carbon::parse($d)->translatedFormat('d M') }}

                        </a>
                    @endforeach

                </div>

            </div>
        @endif
    @endauth

    <form method="POST" action="{{ route('laporan.update', 1) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

        @foreach ($laporans as $row)
            <div class="card mb-2" x-data="{
                preview: '{{ $row->foto ? asset('storage/' . $row->foto) : '' }}'
            }">

                <div class="card-body p-2">

                    <div class="d-flex gap-3 align-items-start">

                        {{-- FOTO --}}

                        <div>

                            <img x-show="preview" :src="preview"
                                style="width:70px;height:70px;object-fit:cover;border-radius:8px;cursor:pointer"
                                @click="
document.getElementById('previewImage').src = preview;
new bootstrap.Modal(document.getElementById('previewModal')).show();
">

                            <div x-show="!preview"
                                style="width:70px;height:70px;background:#e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px">
                                📷
                            </div>

                        </div>

                        {{-- TEXT --}}

                        <div class="flex-fill">

                            <div class="fw-semibold mb-1">
                                {{ $row->kategori->nama }}
                            </div>

                            <textarea name="laporan[{{ $row->id }}][text]" class="form-control form-control-sm" rows="2"
                                placeholder="catatan" @if (auth()->user()->level == 'admin') readonly @endif>{{ $row->text }}</textarea>

                        </div>

                        {{-- BUTTON --}}
                        @if (auth()->user()->level == 'kasir')
                            <div>

                                <label class="btn btn-sm {{ $row->foto ? 'btn-warning' : 'btn-outline-primary' }} mb-0">

                                    {{ $row->foto ? 'Update' : 'Upload' }}

                                    <input type="file" class="d-none" accept="image/*"
                                        name="laporan[{{ $row->id }}][foto]"
                                        @change="
let file = $event.target.files[0];
if(file){
preview = URL.createObjectURL(file)
}
">

                                </label>

                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach

        @if (auth()->user()->level == 'kasir')
            <button class="btn btn-primary w-100 mt-3">
                Simpan Semua </button>
        @endif

    </form>

    {{-- MODAL PREVIEW GLOBAL --}}

    <div class="modal fade" id="previewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">

                <div class="modal-body p-1 text-center">

                    <img id="previewImage" class="img-fluid rounded" style="max-height:80vh;object-fit:contain">

                </div>

            </div>
        </div>
    </div>
@endsection
