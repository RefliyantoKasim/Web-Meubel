@extends('layouts.app')

@section('title', 'Edit Order')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Order</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('order.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label>No Order</label>
                                        <input type="text" name="no_order" class="form-control"
                                            value="{{ $order->no_order }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Customer</label>
                                        <input type="text" name="nama_costumer" class="form-control"
                                            value="{{ $order->nama_costumer }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Order</label>
                                        <input type="date" name="tanggal_order" class="form-control"
                                            value="{{ $order->tanggal_order }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Total Harga</label>
                                        <input type="number" name="total_harga" class="form-control"
                                            value="{{ $order->total_harga }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="processing"
                                                {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>
                                                Canceled</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('order.index') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
