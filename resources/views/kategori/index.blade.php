@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h5>Kategori Laporan</h5>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
        + Tambah
    </a>
</div>

<div class="card">
    <div class="card-body p-0">

        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>Nama</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $row->nama }}
                    </td>

                    <td>

                        <a href="{{ route('kategori.edit',$row->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('kategori.destroy',$row->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>

                        </form>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>

@endsection