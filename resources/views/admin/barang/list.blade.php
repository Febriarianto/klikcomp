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
        <span><button class="float-right btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah Data</button></span>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>satuan</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $s)
                <tr>
                    <td>{{$s->nama_barang}}</td>
                    <td>{{$s->satuan}}</td>
                    <td>Rp. {{ number_format($s->hargabeli)}}</td>
                    <td>Rp. {{ number_format($s->hargajual)}}</td>
                    <td>{{$s->nama_kategori}}</td>
                    <td>{{$s->stock}}</td>
                    <td><button class="btn btn-success passingEDIT" data-toggle="modal" data-target="#modal-edit" data-id="{{$s->id}}" id="edit"><i class="fas fa-pencil-alt"></i></button>
                        <button class="btn btn-danger passingHAPUS" data-toggle="modal" data-target="#modal-hapus" data-id="{{$s->id}}" data-kt="{{$s->nama_barang}}"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah {{$judul}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('barang.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control col-4" placeholder="Tulis Nama Barang" name="nama" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label>Barcode ( S/N )</label>
                        <input type="text" class="form-control col-5" placeholder="Isi Barcode / S.N" name="barcode" maxlength="50">
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
                            <select class="form-control" name="kategori" required>
                                <option value="">.: Pilih :.</option>
                                @foreach ($kategori as $k)
                                <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Supplier</label>
                            <select class="form-control" name="supplier" required>
                                <option value="">.: Pilih :.</option>
                                @foreach ($supplier as $s)
                                <option value="{{$s->id}}">{{$s->nama_supplier}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea class="form-control" name="keterangan" placeholder="" required></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputEmail1">Harga Beli</label>
                            <input type="text" class="form-control rupiah" name="hargabeli" required maxlength="15">
                        </div>
                        <div class="form-group col-4">
                            <label for="exampleInputEmail1">Harga Jual</label>
                            <input type="text" class="form-control rupiah" name="hargajual" required maxlength="15">
                        </div>
                        <!-- <div class="form-group col-2">
                            <label for="exampleInputEmail1">Stock</label>
                            <input type="number" class="form-control" name="stock" required maxlength="15">
                        </div> -->
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit {{$judul}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formEdit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" class="form-control" name="id" id="idkt">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control col-4" id="nama" placeholder="Tulis Nama Barang" name="nama" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label>Barcode ( S/N )</label>
                        <input type="text" class="form-control col-5" id="barcode" placeholder="Isi Barcode / S.N" name="barcode" maxlength="50">
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label>Satuan</label>
                            <select class="form-control" name="satuan" id="satuan" required>
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
                                <option value="{{$k->id}}">{{$k->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Supplier</label>
                            <select class="form-control" name="supplier" id="supplier" required>
                                <option value="">.: Pilih :.</option>
                                @foreach ($supplier as $s)
                                <option value="{{$s->id}}">{{$s->nama_supplier}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea class="form-control" name="keterangan" placeholder="" id="keterangan" required></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputEmail1">Harga Beli</label>
                            <input type="text" class="form-control rupiah" name="hargabeli" id="hargabeli" required maxlength="15">
                        </div>
                        <div class="form-group col-4">
                            <label for="exampleInputEmail1">Harga Jual</label>
                            <input type="text" class="form-control rupiah" name="hargajual" id="hargajual" required maxlength="15">
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                <form action="{{route('barang.hapus')}}" method="POST">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
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
        $.get('barang/' + ids + '/edit', function(data) {
            $("#idkt").val(data.id);
            $("#nama").val(data.nama_barang);
            $("#barcode").val(data.barcode);
            $("#keterangan").val(data.keterangan);
            $("#hargajual").val(data.harga_jual).mask('0,000,000,000', {
                reverse: true
            });
            $("#hargabeli").val(data.harga_beli).mask('0,000,000,000', {
                reverse: true
            });
            $('#kategori').val(data.id_kategori);
            $('#supplier').val(data.id_supplier);
            $('#satuan').val(data.satuan);
            $('#modal-edit').modal('show');
        });
    });
    $(".passingHAPUS").click(function() {
        var ids = $(this).attr('data-id');
        var namads = $(this).attr('data-kt');
        $("#id-del").val(ids);
        $("#nama-del").text(namads);
        $('#modal-hapus').modal('show');
    });
    $('.rupiah').mask('0,000,000,000', {
        reverse: true
    });
</script>
@endsection