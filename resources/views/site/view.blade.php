@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
<style type="text/css">
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

	fieldset, label { margin: 0; padding: 0; }

	/****** Style Star Rating Widget *****/

	.rating { 
	  border: none;
	  display: inline-block;
	  
	}

	.rating > input { display: none;} 
	.rating > label:before { 
	  margin: 5px;
	  font-size: 1.25em;
	  font-family: FontAwesome;
	  display: inline-block;
	  content: "\f005";
	}

	.rating > .half:before { 
	  content: "\f089";
	  position: absolute;
	}

	.rating > label { 
	  color: #ddd; 
	 float: right; 
	}

	/***** CSS Magic to Highlight Stars on Hover *****/

	.rating > input:checked ~ label, /* show gold star when clicked */
	.rating:not(:checked) > label:hover, /* hover current star */
	.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

	.rating > input:checked + label:hover, /* hover current star when changing rating */
	.rating > input:checked ~ label:hover,
	.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
	.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
@endsection

@section('content')

<div class="row justify-content-center pt-3">
    <div class="col-md-12" style="overflow-y: auto; height: 90vh">
    	<div class="backButton">
    		<button class="btn btn-dark mb-2" onclick="history.back()"><i class="fas fa-arrow-circle-left"></i> Voltar</button>
    	</div>
        <div class="card mb-4">
            <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
            	<div style="display: flex; justify-content: space-between; align-items: center;">
            		<div>
                		<span>{{escreverLocalidade($post->cidade)}} {!! escreverEstrelas($post->avaliacao) !!}</span>                
            		</div>
            		@if(Auth::user())
	            		@if((Auth::user()->type == 2) || (Auth::user()->id == $post->owner->id))
		            		<div>
		            			<a href="{{route('postDestroy', $post->id)}}">
		            				<button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
		            			</a>
		            		</div>
	            		@endif
	            	@endif
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
                <h5>{{$post->descricao}}</h5>
                <div class="p-2" style="background-color: #D3D3D3;">
                	<div style="display: flex; align-items: flex-start;">
                		<div style="padding-right: 10px;">
                			<img style="width: 150px;" src="{{asset('img/semfoto.png')}}">
                		</div>
                		<div style="padding-top: 4px;">
                			<h4><a style="text-decoration: none; color: #0f0f0f" href="{{route('userView', $post->owner->id)}}"><b>{{$post->owner->name}}</b></a></h4>
                			<h4>Postado em: {{date('d/m/y h:m', strtotime($post->created_at))}} </h4>
                		</div>
                		
                	</div>
                </div>
                <hr>
                <div class="row">               		
					<div class="btn-group mr-2" role="group" aria-label="First group">
						<a href="{{route('reactionQueroIr', ['idPost' => $post->id, 'interest' => 1])}}">
							<button type="button" class="btn btn-primary">Quero ir ({{$post->quero_ir_count}})</button>
						</a>
						<a href="{{route('reactionJaFui', ['idPost' => $post->id, 'interest' => 2])}}">
							<button type="button" class="btn btn-success">Já fui ({{$post->ja_fui_count}})</button>
						</a>
						<a href="{{route('reactionNaoIriaNovamente', ['idPost' => $post->id, 'interest' => 3])}}">
							<button type="button" class="btn btn-danger">Não voltaria ({{$post->nao_iria_novamente_count}})</button>
						</a>
						<!-- <button type="button" class="btn btn-warning"><i class="far fa-star"></i></button> -->
					</div>
				</div>
<!-- 				@if($jaFoi)
				<div class="row mt-3">
					<label>Sua avaliação:</label>
					<div class="col-md-4" style="display: flex;">
						<div>
							<fieldset class="rating">
							    <input type="radio" id="star5" name="avaliacao" value="5" required /><label class = "full" for="star5" ></label>
							    <input type="radio" id="star4half" name="avaliacao" value="4.5" /><label class="half" for="star4half"></label>
							    <input type="radio" id="star4" name="avaliacao" value="4" /><label class = "full" for="star4"></label>
							    <input type="radio" id="star3half" name="avaliacao" value="3.5" /><label class="half" for="star3half"></label>
							    <input type="radio" id="star3" name="avaliacao" value="3" /><label class = "full" for="star3" ></label>
							    <input type="radio" id="star2half" name="avaliacao" value="2.5" /><label class="half" for="star2half"></label>
							    <input type="radio" id="star2" name="avaliacao" value="2" /><label class = "full" for="star2"></label>
							    <input type="radio" id="star1half" name="avaliacao" value="1.5" /><label class="half" for="star1half"></label>
							    <input type="radio" id="star1" name="avaliacao" value="1" /><label class = "full" for="star1"></label>
							    <input type="radio" id="starhalf" name="avaliacao" value="0.5" /><label class="half" for="starhalf"></label>
							</fieldset>
						</div>
					</div>
				</div>
				@endif -->
            </div>
        </div>
		@if(!Auth::user())
			<div class="row mb-3">
				<div class="col" style="width: 66.666%; margin: auto;">
					<fieldset class="bg-white" style="border: solid 1px #f0f0f0; padding: 15px; border-radius: 25px">
						<a href="{{route('login')}}">
							<p>Clique aqui para fazer login e interagir com o post.</p>
						</a>
					</fieldset>
				</div>
			</div>
		@else
			<div class="row mb-3">
				<div class="col" style="width: 66.666%; margin: auto;">
					<fieldset class="bg-white" style="border: solid 1px #f0f0f0; padding: 15px; border-radius: 25px">
						<form action="{{route('commentPost')}}" method="POST">
							@csrf
							<input type="hidden" value="{{$post->id}}" name="id">
							<div class="form-group">
								<input placeholder="Comentar" class="form-control" type="text" name="comentario">
							</div>
						</form>
					</fieldset>
				</div>
			</div>
		@endif

		@if($post->comments)
			<div class="row">
				<div class="col" style="width: 66.666%; margin: auto;">
					@foreach($post->comments as $comment)
						<fieldset class="bg-white" style="border: solid 4px #f0f0f0; padding: 15px; margin-bottom: 10px; border-radius: 25px;" class="mb-3">
							<div style="display:flex; justify-content: space-between;">
								<h5>{!! $post->idUser==$comment->idUser ? "<i class='fas fa-pen'></i>" : ''!!} <a style="text-decoration: none; color: #0f0f0f" href="{{route('userView', $comment->owner->id)}}">{{$comment->owner->name}}</a></h5>
								<h5>{{date('d/m/y h:m', strtotime($comment->created_at))}}
									@if(Auth::user())
										@if((Auth::user()->type == 2) || (Auth::user()->id == $comment->owner->id))
										<a href="{{route('commentDestroy', $comment->id)}}">
											<i class="far fa-trash-alt"></i>
										</a>
										@endif
									@endif
								</h5>
							</div>	
							<p>{{$comment->comentario}}</p>
								@if(Auth::user())
								<div style="display: flex; justify-content: space-around">
									<a href="{{url('like?id=' . $comment->id)}}">
										<div class="btn btn-success">
											<i class="far fa-thumbs-up"></i> <span>{{count($comment->likes)}}</span>
										</div>
									</a>
									<a href="{{url('dislike?id=' . $comment->id)}}">
										<div class="btn btn-danger">
											<i class="far fa-thumbs-down"></i> <span>{{count($comment->dislikes)}}</span>
										</div>
									</a>
								</div>
								@endif
						</fieldset>
					@endforeach
				</div>
			</div>
		@endif
    </div>
</div>

@endsection

@section('js')
<script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $(".owl-carousel").owlCarousel({
      	items:1,
      	autoHeight:true
      });
    });
</script>
@endsection
