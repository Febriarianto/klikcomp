@extends('admin.dashboard')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset ('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data {{$judul}}</h3>
        <span><a href="{{route('penjualan.transaksi')}}" class="float-right btn btn-primary">Tambah Penjualan</a></span>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Penjualan</th>
                    <th>Nama Pelanggan</th>
                    <th>Total Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td>{{$d->no_penjualan}}</td>
                    <td>{{$d->nama_pelanggan}}</td>
                    <td>{{number_format($d->total)}}</td>
                    <td><a href="{{route('penjualan.show',$d->no_penjualan)}}" class="btn btn-info" target="_blank"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('supplier.hapus')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <label>Yakin ingin Hapus ? </label>
                    <label class="font-weight-bold" id="nama-del"></label>
                    <input type="hidden" class="form-control" name="id" placeholder="Kategori" required="required" maxlength="25" id="id-del">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
                <button type="submit" class="btn btn-danger">YA</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset ('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset ('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset ('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    $(".passingEDIT").click(function() {
        var ids = $(this).attr('data-id');
        console.log(ids)
        $.get('supplier/' + ids + '/edit', function(data) {
            $("#idkt").val(data.id);
            $("#nama").val(data.nama_supplier);
            $("#alamat").val(data.alamat);
            $("#nohp").val(data.no_tlp);
            $('#modal-edit').modal('show');
        })
    });
    $(".passingHAPUS").click(function() {
        var ids = $(this).attr('data-id');
        var namads = $(this).attr('data-kt');
        $("#id-del").val(ids);
        $("#nama-del").text(namads);
        $('#modal-hapus').modal('show');
    });
</script>
@endsection