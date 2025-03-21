@extends('layouts.app')

@section('title', 'Tambah Order')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Order</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('order.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>No Order</label>
                                        <input type="text" name="no_order" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Customer</label>
                                        <input type="text" name="nama_costumer" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Order</label>
                                        <input type="date" name="tanggal_order" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Total Harga</label>
                                        <input type="number" name="total_harga" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="pending">Pending</option>
                                            <option value="processing">Processing</option>
                                            <option value="completed">Completed</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
