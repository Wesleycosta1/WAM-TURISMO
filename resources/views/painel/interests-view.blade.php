@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center pt-3">
        <div class="col-md-8" style="overflow-y: auto; height: 100%">
            @foreach($interests as $interest)
            <div class="card">
                <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <span>{{escreverLocalidade($interest->post->cidade)}} {!! escreverEstrelas($interest->post->avaliacao) !!}</span>
                        </div>
                        <div>
                            <a href="{{route('painel.interestDestroy', $interest->id)}}" class="btn btn-danger">Excluir Interesse</a>
                        </div>
                        @if((Auth::user()->type == 2) || (Auth::user()->id == $interest->post->owner->id))
                        <div>
                            <a href="{{route('postDestroy', $interest->post->id)}}">
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                            </a>
                        </div>
                    @endif               
                    </div>
                </div>

                <div class="card-body">
                    <a href="{{url('post/' . $interest->post->id)}}" style="text-decoration: none; color: #0f0f0f;">
                        <h3>{{$interest->post->titulo}}</h3>
                    </a>
                    <div class="owl-carousel">
                        @if(count($interest->post->images)>0)
                            @foreach($interest->post->images as $image)
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
    </div>
    {{$interests->links()}}
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