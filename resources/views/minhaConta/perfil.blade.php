@extends('template')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
      <li class="active">Perfil</li>
    </ol>

    <link rel="stylesheet" href="/libs/jcrop/css/jquery.Jcrop.css" type="text/css" />
    <link type="text/css" rel="stylesheet" href="/css/minhaConta.css" />

    <style type="text/css">
        .jcrop-holder #preview-pane {
            display: block;
            position: absolute;
            z-index: 2000;
            top: 10px;
            right: -280px;
            padding: 6px;
            border: 1px rgba(0,0,0,.4) solid;
            background-color: white;

            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;

            -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
        }

        #preview-pane .preview-container {
            width: 250px;
            height: 170px;
            overflow: hidden;
        }
    </style>

    <h1 class="text-danger">PERFIL</h1>
    <div>
        <div align="left">
            <div class="visible-xs">
                {{-- <form action='/minha-conta/perfil/updateFoto' name='formFotoPerfil' method='POST' enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div>
                        <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem }}" alt="brechoAdventure" class="img_perfil" />
                        <img src="" alt="brechoAdventure" class="img_perfil img_nova hide" /><br>
                    </div>
                    <small><a class="alterar-foto">Alterar foto de perfil</a></small>
                    <br>
                    <button type='submit' id='btnEnviaFoto' class="btn btn-success hide">Salvar foto</button>&nbsp;&nbsp;
                    <button id='btnCancelarFoto' class="btn btn-danger hide"><span class="glyphicon glyphicon-trash"></span></button>&nbsp;&nbsp;
                    <b><small class='nm_imagem'></small></b>

                    <input type="file" class="hide" id='foto_upd' name='imagemPerfil'>
                </form> --}}
            </div>
            <div class="hidden-xs">
                <form action="/minha-conta/perfil/updateFoto" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
                     {{ csrf_field() }}
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />

                    <div class='div_imagem'>
                        <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem }}" alt="brechoAdventure" class="img_perfil" />
                        <br />
                        <small class='text-danger'>A imagem deve ter dimensções de até 600px x 400px e tamanho max de 1Mb </small>
                        <input type="file" id='select_image' name='imagemCrop'>
                        <span class='text-danger'></span>
                    </div>
                    {{--
                    <div class="div_visualizacao hide">
                        <p class='text-danger'>Selecione onde quer cortar a imagem</p>
                        <div id="visualizacao_imagem"></div>
                        <br />
                        <input type="submit" id="recortar" class='btn btn-primary' value="Recortar Imagem" />
                        <input type='button' id='btnCancelarFoto' class="btn btn-danger" value='Cancelar' />
                    </div> --}}

                    <div class="div_visualizacao hide">
                        <p class='text-danger'>Selecione onde quer cortar a imagem</p>
                        <div id="div_imagem">{{-- IMAGEM GRANDE --}}</div>
                        <div id="preview-pane">
                            <div class="preview-container">{{-- IMAGEM PREVIEW --}}</div>
                        </div>
                        <br />
                        <input type="submit" id="recortar" class='btn btn-primary' value="Recortar Imagem" />
                        <input type='button' id='btnCancelarFoto' class="btn btn-danger" value='Cancelar' />
                    </div>

                </form>
            </div>

        </div>
        <br>

        <form action='/minha-conta/perfil/update' name='formPerfil' id='formPerfil'  method="POST">
            {{ csrf_field() }}
            <table class="table table-striped">
                <tr>
                    <td><label>Nome: <span class='text-danger'>*</span></label> </td>
                    <td><input type="text" id='nome_upd' name='nome' class="form-control" style="width: 300px;" value="{{ Auth::user()->name }}" /></td>
                </tr>
                <tr>
                    <td> <label>Email: <span class='text-danger'>*</span></label> </td>
                    <td><input type="text" id='email_upd' name='email' class="form-control" style="width: 300px;" value="{{ Auth::user()->email }}" /></td>
                </tr>
                <tr>
                    <td> <label>Data de nascimeto: <span class='text-danger'>*</span></label> </td>
                    <td><input type="text" id='dt_nascimento_upd' name='dt_nascimento' class="form-control" style="width: 100px;" value="{{ Auth::user()->dt_nascimento }}" /></td>
                </tr>
                <tr>
                    <td><label>CEP: </label> </td>
                    <td><input type="text" id='cep_upd' name='cep' class="form-control" style="width: 100px;" value="{{ Auth::user()->cep }}" onblur="buscaCEP(this.value)"/></td>
                </tr>
                <tr>
                    <td><label>Endere&ccedil;o: </label> </td>
                    <td><input type="text" id='endereco_upd' name='endereco' class="form-control" style="width: 300px;" value="{{ Auth::user()->endereco }}" /></td>
                </tr>
                <tr>
                    <td><label>Numero: </label> </td>
                    <td><input type="text" id='numero_upd' name='numero' class="form-control" style="width: 100px;" value="{{ Auth::user()->numero }}" /></td>
                </tr>
                <tr>
                    <td><label>Complemento: </label> </td>
                    <td><input type="text" id='complemento_upd' name='complemento' class="form-control" style="width: 300px;" value="{{ Auth::user()->complemento }}" /></td>
                </tr>
                <tr>
                    <td><label>Bairro: </label> </td>
                    <td><input type="text" id='bairro_upd' name='bairro' class="form-control" style="width: 300px;" value="{{ Auth::user()->bairro }}" /></td>
                </tr>
                <tr>
                    <td><label>Cidade: </label> </td>
                    <td><input type="text" id='cidade_upd' name='cidade' class="form-control" style="width: 300px;" value="{{ Auth::user()->cidade }}" /></td>
                </tr>
                <tr>
                    <td><label>UF: </label> </td>
                    <td>
                        <select class="form-control" id='uf_upd' name='uf' style="width: 100px;">
                            @foreach($estados as $sigla=>$desc)
                                <option value="{{$sigla}}" @if( Auth::user()->uf == $sigla) selected @endif>{{$desc}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Telefone Fixo: <span class='text-danger'>*</span></label> </td>
                    <td><input type="text" id='tel_upd' name='telefone_fixo' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_fixo }}" /></td>
                </tr>
                <tr>
                    <td><label>Telefone Cel: <span class='text-danger'>*</span></label> </td>
                    <td><input type="text" id='cel_upd' name='telefone_cel' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_cel }}" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><button type="submit" class="btn btn-primary act-update">Salvar</button></td>
                </tr>
            </table>
        </form>
    </div>

    <script type="text/javascript" src="/libs/jcrop/js/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="/js/site/perfil.js"></script>

@endsection
