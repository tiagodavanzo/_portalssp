function ResetForm()
{
	$('#hdId').val(0);
	$('#frmChamado')[0].reset();
	$('#btnOK').text('Cadastrar');
}

function Atualizar()
{
	ResetForm();
	$('#chamados').DataTable().destroy();
	CarregaTabela();
}

function Alterar(id)
{
	$('#btnOK').text('Atualizar');
	$.ajax({
		url: 'http://localhost:8000/chamado/' + id,
		type: 'GET',
		success: function(data) {
			$('#hdId').val(data.id);
			$('#txtTitulo').val(data.titulo);
			$('#txtDescricao').val(data.descricao);
		}
	});
}

$(document).ready(function() {
    $(function() {
        CarregaTabela();
    });
});

function CarregaTabela()
{
	$.ajax({
		url: 'http://localhost:8000/chamadosCliente',
		type: 'GET',
		dataType: 'json',
		success: function(data, status, xhr)
		{
		  $('#chamados').dataTable( {
			data: data,
			columns : [
				{ "data" : "titulo" },
				{ "data" : "descricao" },
				{ "data" : "status" },
				{ "data" : "fornecedor_nome" },
				{
					"data": null,
					"render": function ( data, type, row ) {
						return '<button type="button" class="btn btn-primary btn-sm" onclick="Alterar(' + row.id + ')"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="Excluir(' + row.id + ')"><i class="fa fa-trash-o"></i></button>'
					},
					"targets": -1
				}
			],
			language: {
			  "lengthMenu": "_MENU_ registros por página",
			  "zeroRecords": "Nenhum resultado encontrado",
			  "info": "Mostrando página _PAGE_ de _PAGES_",
			  "infoEmpty": "No records available",
			  "infoFiltered": "(filtered from _MAX_ total records)",
			  "search": "Pesquisar:",
			  "paginate": {
				  "first":      "Primeiro",
				  "last":       "Último",
				  "next":       "Próximo",
				  "previous":   "Anterior"
			  }
			}
		  });
		},
		error: function(xhr, status, error)
		{
			$("#json").html("Error: " + status + " " + error);
		}
	});
}

$("#btnOK").click(function(){        
	
	acao = ($('#hdId').val() != '' && $('#hdId').val() != 0) ? 'Atualizar' : 'Cadastrar';
	if(acao == 'Cadastrar')
	{
		$.ajax({
			url: 'http://localhost:8000/chamado/',
			type: 'POST',
			data: { 'titulo': $("#txtTitulo").val() , 'descricao': $("#txtDescricao").val() , 'status': 'Aguardando atendimento', 'cliente_id': $("#hdIdCliente").val() },
			async: false,
			success: function(result) {
				alert(result);
				Atualizar();
			},
			error: function(result){
				alert(result);
			}
		});
	}
	else if(acao == 'Atualizar')
	{
		$.ajax({
			url: 'http://localhost:8000/chamado/' + $("#hdId").val(),
			type: 'PUT',
			data: { 'titulo': $("#txtTitulo").val() , 'descricao': $("#txtDescricao").val() },
			success: function(result) {
				alert(result);
				Atualizar();
			}
		});
	}
});

$("#btnCancelar").click(function(){        
	ResetForm();
});

function Excluir(id)
{
	if(confirm('Tem certeza que deseja excluir o chamado?'))
	{
		$.ajax({
			url: 'http://localhost:8000/chamado/' + id,
			type: 'DELETE',
			success: function(result) {
				alert(result);
				Atualizar();
			}
		});
	}
}