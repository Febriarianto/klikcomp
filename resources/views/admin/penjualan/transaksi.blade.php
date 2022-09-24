@extends('admin.dashboard')
@section('css')
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
        <div class="form-group">
            <form action="{{route('penjualan.tambah')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm">
                        <label>Kode</label>
                        <input type="text" id="id_barang" onkeyup="cari_barang()" name="id" tabindex="1" autofocus>
                    </div>
                    <div class="col-sm">
                        <label>Nama</label>
                        <input type="text" id="nama">
                    </div>
                    <div class="col-sm">
                        <label>Stock</label>
                        <input type="text" id="stock">
                    </div>
                    <div class="col-sm">
                        <label>Jumlah Beli</label>
                        <input type="text" tabindex="2" name="jumlah">
                    </div>
                    <div class="col-sm">
                        <button class="btn btn-success" tabindex="3">Tambah Barang <i class="fas fa-plus"></i> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row pl-2 pr-2">
    <div class="card col-8">
        <div class="card-header">
            Detail-Barang
            <span><button class="float-right btn btn-primary" data-toggle="modal" data-target="#modal-default">Cari Barang</button></span>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if (session('penjualan'))
                    @foreach (session('penjualan') as $p)
                    @php $total += $p['harga'] * $p['jumlah'] @endphp
                    <tr class="cart" data-id="{{ $p['id'] }}">
                        <td>{{$p['nama']}}</td>
                        <td>{{number_format($p['harga'])}}</td>
                        <td data-th="jumlah"><input type="number" value="{{$p['jumlah']}}" class="jumlah update-cart" min="1"></td>
                        <td><span class="subtotal">{{ number_format($p['jumlah'] * $p['harga'])}}</span></td>
                        <td><button class="btn btn-danger remove-cart"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card col-4">
        <div class="card-body">
            <form action="{{route('penjualan.simpan')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Pelanggan</label>
                    <select name="pelanggan" class="form-control select2" id="">
                        <option value="">.: Pilih :.</option>
                        <option value="0">Pelanggan Baru</option>
                        @foreach ($pelanggan as $p)
                        <option value="{{$p->id}}">{{$p->nama_pelanggan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Diskon</label>
                    <input type="text" class="form-control" name="diskon" id="diskon" required maxlength="50">
                </div>
                <div class="form-group">
                    <label>Total Transaksi</label>
                    <input type="hidden" class="form-control" id="total" value="{{$total}}">
                    <input type="text" class="form-control" name="total" id="totaldis">
                </div>
                <div class="form-group">
                    <label>Uang Bayar</label>
                    <input type="text" class="form-control" name="uang_bayar" id="uangbayar" required maxlength="50">
                </div>
                <div class="form-group">
                    <label>Kembalian</label>
                    <input type="text" class="form-control rupiah" name="kembalian" id="kembalian" required maxlength="50">
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" name="" id=""></textarea>
                </div>
                <button class="btn btn-success float-right" type="submit"><i class="fas fa-save"></i> Simpan</button>
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
                            <form action="{{route('penjualan.tambah')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$s->id}}"><button class="btn btn-info">Pilih</button>
                            </form>
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
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
    function cari_barang() {
        var kd = $('#id_barang').val();
        $.get('barang/' + kd + '/cari', function(data) {
            $('#nama').val(data.nama_barang);
            $('#stock').val(data.stock);
        })
    };
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
    $(".update-cart").change(function(e) {

        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "{{route('penjualan.update')}}",
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
                url: "{{route('penjualan.hapus')}}",
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
    $(document).ready(function() {
        let ub = new AutoNumeric('#uangbayar', 0, {
                decimalPlaces: '0'
            }),
            d = new AutoNumeric('#diskon', 0, {
                decimalPlaces: '0'
            }),
            k = new AutoNumeric('#kembalian', 0, {
                decimalPlaces: '0'
            }),
            td = new AutoNumeric('#totaldis', 0, {
                decimalPlaces: '0'
            }),
            t = $('#total').val();

        const getDiskon = function() {
            let diskon = parseFloat(t) - d.get();
            td.set(diskon);
        };
        const getResult = function() {
            let hasil = ub.get() - td.get();
            k.set(hasil);
        };
        $('#uangbayar').on({
            keyup: function() {
                getResult();
            }
        });
        $('#diskon').on({
            keyup: function(){
                getDiskon();
            }
        });
        getDiskon();
    });
</script>
@endsection