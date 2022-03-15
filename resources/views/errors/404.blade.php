@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
@endsection

@section('content')
<div class="row justify-content-center pt-3">
    <div class="col-md-12" style="overflow-y: auto; height: 100%">
        <div class="card mb-4">
            <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                <div style="display: flex; justify-content: space-between;">
                    <span>ERRO D:</span>                
                </div>                  
            </div>

            <div class="card-body">
                <h3><b>Erro 404:</b> nada foi encontrado.</h3>
            </div>
        </div>
    </div>
</div>
@endsection

