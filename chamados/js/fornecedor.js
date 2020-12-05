function Atualizar()
{
	$('#chamados').DataTable().destroy();
	CarregaTabela();
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
				{ "data" : "cliente_nome" },
				{
					"data": null,
					"render": function ( data, type, row ) {
						if(data.status == 'Aguardando atendimento')
							return '<button type="button" class="btn btn-primary btn-sm" onclick="Atender(' + row.id + ')">Atender</button>';
						else
							return null;
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

function Atender(id)
{
	if(confirm('Tem certeza que deseja atender o chamado?'))
	{
		$.ajax({
			url: 'http://localhost:8000/chamado/' + id,
			type: 'PUT',
			data: { 'status': 'Atendido', 'fornecedor_id': $("#hdIdFornecedor").val() },
			success: function(result) {
				alert(result);
				Atualizar();
			}
		});
	}
}