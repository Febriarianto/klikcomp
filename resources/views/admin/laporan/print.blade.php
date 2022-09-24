<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset ('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <style>
        tr.group,
        tr.group:hover {
            background-color: #ddd !important;
        }

        .judul {
            text-align: center;
            margin-bottom: 50px;
        }
    </style>
    <title>{{$judul}}</title>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div class="judul">
                <h2>{{$judul}}</h2>
                <h5>Klik-Comp</h3>
                    <h6> Jl. Doktor Soepomo Buaran Mekar Sari – Tangerang</h6>
            </div>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Diskon</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{date_format($d->created_at,"Y/m/d")}}</td>
                        <td>{{$d->nama_barang}}</td>
                        <td>{{$d->jumlah}}</td>
                        <td>{{$d->diskon}}</td>
                        <td style="text-align: right;">{{number_format($d->harga_jual)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: right;">Total:</th>
                        <th style="text-align: right;"></th>
                    </tr>
                    <tr>
                        <td>Pimpinan</br></br></br><u>(......................)</u></td>
                    </tr>
                </tfoot>
            </table>
            <table style="text-align: right;">
                <tr>

                </tr>
            </table>
        </div>
    </div>
    <script src="{{ asset ('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset ('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset ('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset ('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var groupColumn = 0;
            var table = $('#example').DataTable({
                "lengthChange": false,
                "searching": false,
                "info": false,
                "paging": false,
                columnDefs: [{
                    visible: false,
                    targets: groupColumn
                }],
                order: [
                    [groupColumn, 'asc']
                ],
                // displayLength: 25,
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api
                        .column(groupColumn, {
                            page: 'current'
                        })
                        .data()
                        .each(function(group, i) {
                            if (last !== group) {
                                $(rows)
                                    .eq(i)
                                    .before('<tr class="group"><td colspan="5">' + group + '</td></tr>');

                                last = group;
                            }
                        });
                },
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(4, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(4).footer()).html('' + pageTotal + '');
                },
            });

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    table.order([groupColumn, 'desc']).draw();
                } else {
                    table.order([groupColumn, 'asc']).draw();
                }
            });
            window.print();
        });
    </script>
</body>

</html>