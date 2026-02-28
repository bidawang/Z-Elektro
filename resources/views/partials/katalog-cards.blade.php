<div class="row g-3">
@foreach($barangs as $b)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card katalog-card h-100">

            {{-- IMAGE / INITIAL --}}
            <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center overflow-hidden rounded-top">
                @if($b->foto)
                    <img
                        src="{{ asset('storage/'.$b->foto) }}"
                        class="w-100 h-100"
                        style="object-fit:cover"
                        loading="lazy">
                @else
                    @php
                        $inisial = collect(explode(' ', $b->nama))
                                    ->take(2)
                                    ->map(fn($w) => strtoupper(substr($w,0,1)))
                                    ->join('');
                    @endphp
                    <div class="fw-bold text-secondary" style="font-size:2.2rem;">
                        {{ $inisial }}
                    </div>
                @endif
            </div>

            {{-- BODY --}}
            <div class="card-body p-3 d-flex flex-column">

                <div class="fw-semibold text-truncate mb-1" title="{{ $b->nama }}">
                    {{ $b->nama }}
                </div>

                <div class="text-primary fw-bold fs-6 mb-2">
                    Rp {{ number_format($b->harga_luar) }}
                </div>

                @php
                    $cicilan = $b->harga_luar / 12;
                @endphp

                <small class="text-muted mb-3">
                    Estimasi cicilan 12x Rp {{ number_format($cicilan) }}
                </small>

                <div class="mt-auto d-grid gap-2">
                    <a href="{{ route('katalog.show', $b->id) }}"
                       class="btn btn-sm btn-outline-secondary rounded-pill">
                        Cicilan & DetailProduk
                    </a>
                </div>

            </div>
        </div>
    </div>
@endforeach
</div>

@if($barangs->hasMorePages())
    <div class="next-page d-none"
         data-next="{{ $barangs->currentPage() + 1 }}">
    </div>
@endif