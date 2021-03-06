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
            processing: true,
            serverSide: true,
            ajax: "{{ route('welcome') }}",
            columns: [{
                data: 'data_barang',
                name: 'data_barang'
            }, ],
        });
    });
</script>
@endsection