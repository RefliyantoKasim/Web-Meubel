@extends('layouts.app')

@section('title', 'Detail Order')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Order</h1>
                <div class="section-header-button">
                    <a href="{{ route('order.index') }}" class="btn btn-sm btn-success btn-icon">Kembali</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></div>
                    <div class="breadcrumb-item">Detail Order</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Detail Order #{{ $order->no_order }}</h2>
                <p class="section-lead">Informasi detail dari order ini.</p>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nomor Order</th>
                                        <td>{{ $order->no_order }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pelanggan</th>
                                        <td>{{ $order->nama_costumer }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Order</th>
                                        <td>{{ $order->tanggal_order }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Harga</th>
                                        <td>Rp {{ number_format($order->total_harga, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span
                                                class="badge
                                                @if ($order->status == 'pending') badge-warning
                                                @elseif($order->status == 'processing') badge-info
                                                @elseif($order->status == 'completed') badge-success
                                                @elseif($order->status == 'canceled') badge-danger @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>

                                <div class="mt-4">
                                    <a href="{{ route('order.index') }}" class="btn btn-secondary">Kembali</a>
                                    <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning">Edit Order</a>
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus order ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
