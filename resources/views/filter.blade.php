@extends('layouts.app')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item">.: Kategori :.</li>
                @foreach ($kategori as $k)
                <a href="{{route('filter.kategori',$k->id)}}" class="list-group-item list-group-item-action">{{$k->nama_kategori}}</a>
                @endforeach
            </ul>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Daftar Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                @foreach ($barang as $b)
                                @php if ($b->gambar == "") {
                                $text = "null.png";
                                } else {
                                $text = $b->gambar;
                                } @endphp
                                <div class="card">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <img src="{{Storage::url('public/gambar_barang/').$text}}" class="card-img-top" alt="...">
                                        </div>
                                        <div class="col-8 my-3">
                                            <h5 class="card-title">{{$b->nama_barang}}</h5>
                                            <p class="card-text">{{$b->keterangan}}</p>
                                        </div>
                                        <div class="col-2 mt-4">
                                            <a href="{{route('tamu.detail', $b->id)}}" class="btn btn-primary">Detail</a>
                                            <a href="" class="btn btn-success">Add Cart</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "searching": true,
            "lengthChange": false,
            "info": false,
        });
    });
</script>
@endsection