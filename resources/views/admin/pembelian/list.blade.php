@extends('admin.dashboard')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset ('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset ('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset ('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$judul}}</h3>
    </div>
    <div class="card-body">
        <form action="{{route('pembelian.tambah')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label>Id Barang</label>
                        <input type="text" autofocus class="form-control" tabindex="1" placeholder="Tulis Id" name="id" id="id_barang" onkeyup="cari_barang()">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" id="nama">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" tabindex="2" name="jumlah" id="jumlah" required maxlength="50">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control rupiah" tabindex="3" name="harga" required maxlength="50">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-info ml-3 mt-4" tabindex="4">+</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Barang</h3>
                <span><button class="float-right btn btn-primary" data-toggle="modal" data-target="#modal-default">Cari Barang</button></span>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (session('pembelian'))
                        @foreach (session('pembelian') as $p)
                        <tr class="cart" data-id="{{ $p['id'] }}">
                            <td>{{$p['nama']}}</td>
                            <td data-th="jumlah"><input type="number" value="{{$p['jumlah']}}" class="jumlah update-cart" min="1"></td>
                            <td>{{number_format($p['harga'])}}</td>
                            <td><button class="btn btn-danger remove-cart"><i class="fas fa-trash"></i></button></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <form action="{{route('pembelian.simpan')}}" method="POST">
                @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Supplier</label>
                    <select class="form-control select2" name="supplier" id="supplier" required>
                        <option value="">.: Pilih :.</option>
                        @foreach ($supplier as $s)
                        <option value="{{$s->id}}">{{$s->nama_supplier}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label>Total Belanja</label>
                    @php $total = 0 @endphp
                    @foreach ((array) session('pembelian') as $id => $detail)
                    @php $total += $detail['harga'] @endphp
                    @endforeach
                    <input type="text" class="form-control" name="total" value="{{number_format($total)}}">
                </div>
                <button class="btn btn-success float-right" type="submit"><i class="fas fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>satuan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $s)
                    <tr>
                        <td>{{$s->nama_barang}}</td>
                        <td>{{$s->satuan}}</td>
                        <td>{{ number_format($s->harga_jual)}}</td>
                        <td>{{$s->stock}}</td>
                        <td>
                            <button type="botton" class="btn btn-info btnSet" data-id="{{$s->id}}" data-name="{{$s->nama_barang}}">Pilih</button>
                            <!-- <form action="{{route('pembelian.tambah')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$s->id}}"><button class="btn btn-info">Pilih</button>
                            </form> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('script')
<script src="{{ asset ('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset ('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset ('js/autoNumeric.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset ('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function() {
        $('.select2').select2({
            placeholder: "Pilih",
            allowClear: true
        })
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "rowCallback": function( row, data ){
                $('.btnSet').click(function(){
                    let id = $(this).data('id');
                        nama = $(this).data('name');
                    $('#id_barang').val(id);
                    $('#nama').val(nama)
                    $('#modal-default').modal('hide');
                });
            }
        });
        new AutoNumeric ('.rupiah', 0, { decimalPlaces : 0,})
    });
    function cari_barang() {
        var kd = $('#id_barang').val();
        $.get('barang/' + kd + '/cari', function(data) {
            $('#nama').val(data.nama_barang);
        })
    };
    $(".update-cart").change(function(e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "{{route('pembelian.update')}}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                jumlah: ele.parents("tr").find(".jumlah").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });
    $(".remove-cart").click(function(e) {
        e.preventDefault();
        var ele = $(this);
        if (confirm("Ingin hapus Barang ?")) {
            $.ajax({
                url: "{{route('pembelian.hapus')}}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token()}}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            })
        }
    })
    $(document).on('keypress', 'input,select', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus().click();
        }
    });
</script>
@endsection