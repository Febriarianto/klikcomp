@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4">
                                @php if ($barang->gambar == "") {
                                $text = "null.png";
                                } else {
                                $text = $barang->gambar;
                                } @endphp
                                <img id="main-image" src="{{ Storage::url('public/gambar_barang/').$text}}" width="350" height="250" />
                            </div>
                            <div class="thumbnail text-center">
                                @foreach ($data_img as $g)
                                <img onclick="change_image(this)" src="{{Storage::url('public/gambar_barang/').$g->gambar}}" width="70">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ URL::previous() }}"><i class="fas fa-arrow-left"></i></a>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"></span>
                                <h5 class="text-uppercase">{{$barang->nama_barang}}</h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price">Rp. {{number_format($barang->harga_jual)}}</span>
                                    <div class="ml-2"> <small class="dis-price"></small> <span></span> </div>
                                </div>
                            </div>
                            <p class="about">{{$barang->keterangan}}</p>
                            <div class="sizes mt-5">
                                <h6 class="text-uppercase"></h6> <label class="radio"></label>
                            </div>
                            <!-- <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function change_image(image) {
        var container = document.getElementById("main-image");
        container.src = image.src;
    }
    document.addEventListener("DOMContentLoaded", function(event) {});
</script>
@endsection