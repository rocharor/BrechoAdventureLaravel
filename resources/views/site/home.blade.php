@extends('template')
@section('content')
	<link type="text/css" rel="stylesheet" href="/css/produto.css" />

	<!--BREADCRUMB-->
    @include('breadCrumb')

	@if(count($produtos) == 0)
		<div class="well" align="center"><b><i>N&atilde;o existe nenhum produto cadastrado</i></b></div>
	@else
		<div class="row" >
			<div class="col-xs-12 col-sm-10 el-produtos hide">
				<div align="center">
					<h1 align="center">Bem vindo ao Brechó Adventure</h1>
					<h3>Confira os novos produtos adicionados recentemente em nosso site.</h3>
				</div>
				@foreach($produtos as $produto)
					<div class="col-md-3 col-xs-12" align="center" style="border-bottom: solid 0px; padding: 20px 0">
						<div class="div-produtos" align="center">
							<div class="div-favorito-{{ $produto->id }}">
								@if(Auth::check() == 0)
									<a @click.prevent='setFavorite(0)'>
										<div class="img-inativo"></div>
									</a>
								@else
									<a class="produto-{{ $produto->id }}" @click.prevent='setFavorite({{ $produto->id }})'>
										@if($produto->favorito)
											<span class="img-ativo"></span>
										@else
											<span class="img-inativo"></span>
										@endif
									</a>
								@endif
							</div>

							<div class='titulo' style="height: 20px;" align="center">
								<b>{{$produto->titulo}}</b>
							</div>
							<div style="width: 200px; height: 200px;">
								<img class="img-thumbnail" src="/imagens/produtos/200x200/{{$produto->imgPrincipal}}" alt="" style="width: 100%; height: 100%;">
							</div>

							<div><b>Pre&ccedil;o: R$ {{$produto->valor}}</b></div>
							<div>
								<a href='{{ Route('visualizar-produto',$produto->slug) }}' class='btn btn-warning'><b>Ver detalhes</b></a>
								@if(Auth::check() != 0)
									<button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span></button>
								@endif
							</div>
						</div>
					</div>
				@endforeach

				<div align="center">
					<a href="{{ Route('produtos') }}" class="btn btn-primary" style="width: 50%">VER TODOS</a>
				</div>

				<!--Modal mensagem-->
				<div class="modal fade" id='modal-mensagem'>
					@include('modalMensagem')
				</div>
			</div>
			<div class="col-sm-2 hidden-xs" style="border:solid 0px;">
				<a class="twitter-timeline" data-height="800" data-theme="dark" href="https://twitter.com/Adventure__Club">Tweets by Adventure__Club</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</div>

	@endif

	<script type="text/javascript" src="/js/site/produto.js"></script>
	<script type="text/javascript" src="/js/site/mensagem.js"></script>
@endsection
