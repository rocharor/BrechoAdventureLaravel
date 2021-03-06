@extends('template')
@section('content')

    <!--BREADCRUMB-->
    @include('breadCrumb')

    @include('exibeErro')

    <div class="row">
    	<div class="col-md-6">
    	    <form action="/contato/store" method="POST" name="form" id="form">
                {{ csrf_field() }}

    	        <div class="form-group">
    	        	<input class="form-control" type="text" name="nome" placeholder="Nome" required="required">
    	        </div>
    	        <div class="form-group">
    	        	<input class="form-control" type="text" name="email" placeholder="E-mail" required="required">
    	        </div>
    	        <div class="form-group">
    		        <select class="form-control" name="tipo" required="required">
    		            <option value=''>--- Escolha uma categoria ---</option>
                        @foreach($data['tipos'] as $key => $value)
                            <option value='{{ $key }}'>{{ $value }}</option>
                        @endforeach
    		            {{-- <option value='1'>Dúvidas</option>
    		            <option value='2'>Reclamações</option>
    		            <option value='3'>Sugestões</option>
    		            <option value='4'>Elogios</option> --}}
    		        </select>
    	        </div>
    	        <div class="form-group">
    	        	<textarea class="form-control" name="mensagem" rows="5" placeholder="Mensagem" required="required"></textarea><br>
    	        </div>
    			<div class="form-group">
    				<input type="submit" value="Enviar" class="btn btn-success">
    	        	<img src="/imagens/ajax-loader.gif" class="hide carregando" />
    	        </div>
    	    </form>
        </div>
    </div>


    <script type="text/javascript" src="/js/site/contato.js"></script>
@endsection
