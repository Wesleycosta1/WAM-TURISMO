@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
@endsection

@section('content')
<div class="row justify-content-center pt-3">
    <div class="col-md-12" style="overflow-y: auto; height: 100%">
        @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                <div style="display: flex; justify-content: space-between;">
                    <span>{{escreverLocalidade($post->cidade)}} {!! escreverEstrelas($post->avaliacao) !!}</span>                
                </div>                  
            </div>

            <div class="card-body">
                <a href="{{url('post/' . $post->id)}}" style="text-decoration: none; color: #0f0f0f;">
                    <h3>{{$post->titulo}}</h3>
                </a>
                <div class="owl-carousel">
                    @if(count($post->images)>0)
                        @foreach($post->images as $image)
                        <a href="{{asset('img/post/' . $image->nome)}}" target="blank">
                            <div class="item"><img src="{{asset('img/post/' . $image->nome)}}"></div>
                        </a>
                        @endforeach
                    @else
                        <div class="item">
                            <img src="{{asset('img/semfoto.png')}}">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$posts->links()}}
</div>
@endsection

@section('js')
<script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $(".owl-carousel").owlCarousel();
    });
</script>
@endsection
