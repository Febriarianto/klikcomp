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
        <h3 class="card-title">{{$judul}}</h3>
    </div>
    <div class="card-body">
        <form action="{{route('pembelian.tambah')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label>Id Barang</label>
                        <input type="text" class="form-control" placeholder="Tulis Nama Barang" name="id" id="id_barang" required maxlength="50" onkeyup="cari_barang()">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" placeholder="Tulis Nama Barang" id="nama" name="nama" required autofocus>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" placeholder="Tulis Nama Barang" name="jumlah" required maxlength="50">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" placeholder="Tulis Nama Barang" name="harga" required maxlength="50">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-info ml-3 mt-4">+</button>
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
                            <td>{{$p['harga']}}</td>
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
            <div class="card-body">
                <div class="form-group">
                    <label>Supplier</label>
                    <select class="form-control" name="supplier" id="supplier" required>
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
                    <input type="text" class="form-control" placeholder="Tulis Nama Barang" name="nama" value="{{$total}}">
                </div>
                <button class="btn btn-success float-right" type="submit"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
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
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
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
    // $(document).ready(function() {
    //     $('#nama').keyup(function() {
    //         var query = $(this).val();
    //         if (query != '') {
    //             var _token = $('input[name="_token"]').val();
    //             $.ajax({
    //                 url: "{{route('pembelian.fetch')}}",
    //                 method: "POST",
    //                 data: {
    //                     query: query,
    //                     _token: _token
    //                 },
    //                 success: function(data) {
    //                     $('.baranglist').html(data);
    //                     console.log(data);
    //                 }
    //             });
    //         }
    //     });
    //     $(document).on('click', 'li', function() {
    //         $('#nama').val($(this).text());
    //         $('.baranglist').fadeOut();
    //     });
    // });

    function cari_barang() {
        var kd = $('#id_barang').val();
        $.get('barang/' + kd + '/edit', function(data) {
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
</script>
@endsection