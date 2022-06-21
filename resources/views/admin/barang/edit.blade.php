@extends('admin.dashboard')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset ('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('barang.update',$barang->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control col-4" value="{{$barang->nama_barang}}" name="nama" required maxlength="50">
            </div>
            <div class="form-group">
                <label>Barcode ( S/N )</label>
                <input type="text" class="form-control col-5" value="{{$barang->barcode}}" name="barcode" maxlength="50">
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label>Satuan</label>
                    <select class="form-control" name="satuan" required>
                        <option value="">.: Pilih :.</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Unit">Unit</option>
                    </select>
                </div>
                <div class="form-group col-4">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori" id="kategori" required>
                        <option value="">.: Pilih :.</option>
                        @foreach ($kategori as $k)
                        <option value="{{$k->id}}" {{$k->id == $barang->id_kategori ? 'selected' : ''}}>{{$k->nama_kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label>Supplier</label>
                    <select class="form-control" name="supplier" id="supplier" required>
                        <option value="">.: Pilih :.</option>
                        @foreach ($supplier as $s)
                        <option value="{{$s->id}}" {{$s->id == $barang->id_supplier ? 'selected' : ''}}>{{$s->nama_supplier}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <textarea class="form-control" name="keterangan" required>{{$barang->keterangan}}</textarea>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="exampleInputEmail1">Harga Beli</label>
                    <input type="text" class="form-control rupiah" name="hargabeli" value="{{number_format($barang->harga_beli)}}" required maxlength="15">
                </div>
                <div class="form-group col-4">
                    <label for="exampleInputEmail1">Harga Jual</label>
                    <input type="text" class="form-control rupiah" name="hargajual" value="{{number_format($barang->harga_jual)}}" required maxlength="15">
                </div>
            </div>
            <label for="exampleInputEmail1">Gambar</label>
            <div class="form-group">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($image as $i)
                        <tr>
                            <td><img src="{{Storage::url('public/gambar_barang/').$i->gambar}}" style="width:150px; height:75px;"></td>
                            <td><a class="btn btn-danger passingHAPUS" data-toggle="modal" data-target="#modal-hapus" data-id="{{$i->id}}" data-kt="{{$i->gambar}}"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <div class="input-group control-group increment">
                    <input type="file" name="gambar[]" class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="button"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="clone d-none">
                    <div class="control-group input-group" style="margin-top:10px">
                        <input type="file" name="gambar[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="{{route('barang.index')}}" class="btn btn-default" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
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
                <form action="{{route('gambar.hapus')}}" method="POST">
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
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })
    $(document).ready(function() {
        $(".btn-success").click(function() {
            var html = $(".clone").html();
            $(".increment").after(html);
        });
        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });
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