@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <ul class="list-group">
                <li class="list-group-item">Kategori</li>
                <a href="#" class="list-group-item list-group-item-action">A second link item</a>
            </ul>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">test</h5>
                </div>
                <div class="card-body">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('image/4.jpg')}}" class="card-img-top" alt="..." style="height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="{{route('home.detail')}}" class="btn btn-primary">Detail</a>
                            <a href="" class="btn btn-success">Add Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection