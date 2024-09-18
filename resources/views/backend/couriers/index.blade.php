@extends('layouts.appAdmin')

@section('title', 'Couriers List')

@section('page-title', 'Daftar Kurir')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.couriers.sync') }}" class="btn btn-info">Sync with API</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kurir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($couriers as $index => $courier)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $courier->name }}</td>
                            <td>
                                @if ($courier->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.couriers.update', $courier->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_active" value="{{ $courier->is_active ? 0 : 1 }}">
                                    <button type="submit" class="btn btn-warning">
                                        {{ $courier->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
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
