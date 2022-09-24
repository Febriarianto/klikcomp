@extends('admin.dashboard')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">{{$judul}}</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Transaksi Berhasil >>> </label>
            <a href="{{route('penjualan.show',$id)}}" target="_blanK" class="btn btn-info"><i class="fas fa-print"></i> Print</a>
            <a href="{{route('penjualan.index')}}" class="float-right btn btn-success">Kembali</a>
        </div>
    </div>
</div>
@endsection