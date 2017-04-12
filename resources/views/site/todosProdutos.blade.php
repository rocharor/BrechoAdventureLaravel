@extends('template')
@section('content')
    <link type="text/css" rel="stylesheet" href="/css/produto.css" />

    <ol class="breadcrumb">
      <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
      <li class="active">Todos produtos</li>
    </ol>

    <div class="row" >
        <div class="col-sm-2 hidden-xs" style="border:solid 0px; padding:0">
            @include('filtroLateral')
        </div>
        <div class="col-xs-12 col-sm-10 el-produtos hide">
        	@foreach($produtos as $produto)
        		<div class="col-md-3 col-xs-12" align="center" style="border-bottom: solid 1px; padding: 20px 0">
            		<div class="div-produtos" align="center">
            			<div class="div-favorito-{{ $produto->id }}">
            				@if(Auth::check() == 0)
            					<a class="act-favorito-deslogado">
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

            			<div  class='titulo' style="height: 20px;" align="center">
            				<b>{{$produto->titulo}}</b>
            			</div>
            			<div style="width: 200px; height: 200px;">
            				<img class="img-thumbnail" src="/imagens/produtos/{{$produto->imgPrincipal}}" alt="" style="width: 100%; height: 100%;">
            			</div>

            			<div><b>Pre&ccedil;o: R$ {{$produto->valor}}</b></div>
                        <div>
                            <button class='btn btn-warning' @click.prevent="openDescription({{ $produto->id }})"><b>Ver detalhes</b></button>
                            @if(Auth::check() != 0)
                                <button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span></button>
                            @endif
                        </div>
            		</div>
        		</div>
        	@endforeach

            <!--Modal descricao-->
            <div class="modal fade" id='modal_descricao'>
            	@include('modalDescricao')
            </div>

            <!--Modal mensagem-->
            <div class="modal fade" id='modal-mensagem'>
                @include('modalMensagem')
            </div>

        </div>
    </div>

    <!--PAGINAÇÃO-->
    <nav align='center'>
      <ul class="pagination">
    	 <li>
    		 @if($pg == 1)
    			<span aria-label="Previous"><span aria-hidden="true">&laquo;</span></span>
    		 @else
    			<a href="/produto/todosProdutos/{{ $pg - 1 }}" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
    		 @endif
    	</li>

    	@for($i = 1; $i <= $numberPages; $i++)
    		@if($i == $pg)
    			<li class="active"><a>{{ $i }}</a></li>
    		@else
    			<li><a href="/produto/todosProdutos/{{ $i }}">{{ $i }}</a></li>
    		@endif
    	@endfor
    	 <li>
    		 @if($pg == $numberPages)
    			<span aria-label="Previous"><span aria-hidden="true">&raquo;</span></span>
    		 @else
    			<a href="/produto/todosProdutos/{{ $pg + 1 }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
    		 @endif
    	</li>
      </ul>
    </nav>

    <script type="text/javascript" src="/js/site/produto.js"></script>
    {{-- <script type="text/javascript" src="/js/site/mensagem.js"></script> --}}
@endsection
