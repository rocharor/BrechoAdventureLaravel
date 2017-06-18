var MensagemClass = (function() {
    
    Mensagem.prototype = {
        init: function() {
          this.actions();
        },
        actions: function() {
			var self = this;

			$('.act-aba-msgEnviadas').on('click',function(e){
				e.preventDefault();
				self.abaMsgEnviada();
			});

			$('.act-aba-msgMeusProdutos').on('click',function(e){
				e.preventDefault();
				self.abaMsgMeusProdutos();
			});

			$('.act-abre-conversa').on('click',function(e){
				e.preventDefault();
				var status = $(this).attr('data-status');
                var conversa_id = $(this).parent().next().attr('data-conversa-id');
				self.abreConversa(status,conversa_id,$(this));

			})

			$('.act-enviar-resposta').on('click',function(e){
				e.preventDefault();
				var conversa_id = $(this).parent().attr('data-conversa-id') ;
				var mensagem = $('#resposta_'+conversa_id).val();
				var tipo = $(this).attr('data-tipo');
				self.enviarResposta(conversa_id,mensagem,tipo);
			})

        },
		abaMsgEnviada: function(){
			$('.act-aba-msgEnviadas').addClass('active');
			$('.act-aba-msgMeusProdutos').removeClass('active');
			$('.aba-msgEnviadas').removeClass('hide');
			$('.aba-msgMeusProdutos').addClass('hide');
		},
		abaMsgMeusProdutos: function(){
			$('.act-aba-msgMeusProdutos').addClass('active');
			$('.act-aba-msgEnviadas').removeClass('active');
			$('.aba-msgMeusProdutos').removeClass('hide');
			$('.aba-msgEnviadas').addClass('hide');
		},
		abreConversa: function(status,conversa_id,objThis){
			if (status == 1) {
				objThis.attr('data-status',0);
				objThis.parent().next().removeClass('hide');

				$.post(
					"/minha-conta/mensagem/updateNotificacao",
					{conversa_id:conversa_id},
					function( data ) {
						buscaNotificacao();
					}
				)
			}else{
				objThis.attr('data-status',1);
				objThis.parent().next().addClass('hide');
			}
		},
		enviarResposta(conversa_id,mensagem,tipo){
			if (mensagem == '') {
				alertaPagina('Campo resposta não pode ser vazio','danger');
				return false;
			}
			$.ajax({
				url:'/minha-conta/mensagem/update',
				type:'POST',
				dataType:'json',
				data:{
					mensagem:mensagem,
					conversa_id:conversa_id
				},
				success: function(retorno){
					if(retorno){
						var data = retorno.data.date.split('.');
						var html = "<div class='conversa-esquerda'>";
						html += "<small><i>" + retorno.nome + " - " + data[0] + "</i></small>";
						html += "<p>" + retorno.mensagem + "</p></div>";
						$('.conversa_'+conversa_id).append(html);
						$('#resposta_'+conversa_id).val('');
					}else{
						alertaPagina('Erro ao enviar resposta 1','danger');
					}
				},
				error:function(retorno){
					alertaPagina('Erro ao enviar resposta 2','danger');
				}
			})
		}
    };
    return Mensagem;
})();

new MensagemClass().init();
