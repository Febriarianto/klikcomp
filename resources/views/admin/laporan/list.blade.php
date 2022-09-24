@extends('admin.dashboard')
@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset ('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">{{$judul}}</h5>
    </div>
    <div class="card-body">
        <form action="{{route('laporan.harian')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Laporan Harian</label>
            </div>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="date">
                <button class="btn btn-primary" type="submit">GET</button>
            </div>
        </form>
        <hr>
        <form action="{{route('laporan.periode')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Laporan per Periode</label>
            </div>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="start_date">
                <input type="date" class="form-control" name="end_date">
                <button class="btn btn-primary" type="submit">GET</button>
            </div>
        </form>
        <hr>
            <!-- <form action="" method="POST">
                <div class="form-group">
                    <label>Laporan per Pelanggan</label>
                </div>
                <div class="input-group mb-3">
                    <Select class="form-control select2">
                        <option value="">.:Pilih:.</option>
                        @foreach ($pelanggan as $p)
                        <option value="{{$p->id}}">{{$p->nama_pelanggan}}</option>
                        @endforeach
                    </Select>
                    <button class="btn btn-primary" type="submit">GET</button>
                </div>
            </form> -->
    </div>
</div>
@endsection
@section('script')
<!-- Select2 -->
<script src="{{ asset ('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function() {
        $('.select2').select2({
            placeholder: "Pilih",
            allowClear: true

        })
    })
</script>
@endsection