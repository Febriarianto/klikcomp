<html>
<head>
<title>Faktur Pembayaran</title>
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
<center>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
<span style='font-size:12pt'><b>KLIK COMP</b></span></br>
Jl. Doktor Soepomo Buaran Mekar Sari – Tangerang</br>
Telp : +62 851-5777-4302 
</td>
<td style='vertical-align:top' width='30%' align='left'>
<b><span style='font-size:12pt'>FAKTUR PENJUALAN</span></b></br>
No Trans. : {{$data_transaksi->no_penjualan}}</br>
Tanggal :{{$data_transaksi->created_at}}</br>
</td>
</table>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
Nama Pelanggan : {{$data_transaksi->nama_pelanggan}}</br>
Alamat : {{$data_transaksi->alamat}}
</td>
<td style='vertical-align:top' width='30%' align='left'>
No Telp : -
</td>
</table>
<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
 
<tr align='center'>
<td width='5%'>No</td>
<td>Nama Barang</td>
<td width='13%'>Harga</td>
<td width='4%'>Qty</td>
<td width='13%'>Total Harga</td>
@php $n = 1 ;$total = 0; @endphp
@foreach ($data_item as $i)
<tr>
    <td>{{$n++}}</td>
    <td>{{$i->nama_barang}}</td>
    <td>{{number_format($i->harga_jual)}}</td>
    <td>{{$i->jumlah}}</td>
    @php $total += $i->harga_jual*$i->jumlah @endphp
    <td style='text-align:right'>Rp. {{number_format($i->harga_jual*$i->jumlah)}}</td>
</tr>
    @endforeach
 
<tr>
<td colspan = '4'><div style='text-align:right'>Diskon : </div></td>
<td style='text-align:right'>Rp. {{number_format($i->diskon)}}</td>
</tr>
<tr>
<td colspan = '4'><div style='text-align:right'>Total Transaksi : </div></td>
<td style='text-align:right'>Rp. {{number_format($total-$i->diskon)}}</td>
</tr>
<tr>
<td colspan = '4'><div style='text-align:right'>Uang Bayar : </div></td>
<td style='text-align:right'>Rp. {{number_format($data_transaksi->uang_bayar)}}</td>
</tr>
<tr>
<td colspan = '4'><div style='text-align:right'>Kembalian : </div></td><td style='text-align:right'>{{number_format($data_transaksi->kembalian)}}</td>
</tr>
</table>
 
<table style='width:650; font-size:7pt;' cellspacing='2'>
<tr>
<td align='center'>Diterima Oleh,</br></br></br><u>(............)</u></td>
<td align='center'>Pelanggan,</br></br></br><u>(...........)</u></td>
</tr>
</table>
</center>
<script src="{{ asset ('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset ('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $(document).ready(function(){
        window.print();
    })
</script>
</body>
</html>