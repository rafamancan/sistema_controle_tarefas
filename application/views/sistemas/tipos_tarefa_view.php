<?php 
$resultTipos = "";

foreach ($tipos as $tipo) {
	$resultTipos .= '<tr>';
		$resultTipos .= '<td class="col-md-2">'.$tipo['PKTipo'].'</td>';
		$resultTipos .= '<td class="col-md-4">'.$tipo['tipoNome'].'</td>';
		$resultTipos .= '<td class="col-md-4"><i class="fa fa-square fa-2x" style="color:#'.$tipo['tipoCor'].'"></i></td>';
		$resultTipos .= '<td class="col-md-2"><button type="button" class="btn btn-danger excluir" id="'.$tipo['PKTipo'].'">Excluir <i class="fa fa-trash"></i></button></td>';
	$resultTipos .= '</tr>';
}
?>


<div class="row">
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-1">&nbsp;</div>
</div>

<div class="row">
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-10">
		<div class="panel panel-default">
		  <div class="panel-heading">Novo tipo de Tarefa</div>
		  <div class="panel-body">
		    
		  	<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-1"><label for="tipoNome">Nome:</label></div>
				<div class="col-md-9"><input type="text" class="form-control" placeholder="Nome do tipo da tarefa" id="tipoNome"></div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-12">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-1"><label for="tipoCor">Cor:</label></div>
				<div class="col-md-9"><input type="text" class="form-control" placeholder="Cor em Hexadecimal" id="tipoCor"></div>
				<div class="col-md-1">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-12">&nbsp;</div>
			</div>

			<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-9 text-center"><button type="button" class="btn btn-primary" id="inserir">Inserir <i class="fa fa-floppy-o"></i></button></div>
				<div class="col-md-1">&nbsp;</div>
			</div>


		  </div>
		</div>
	</div>
	<div class="col-md-1">&nbsp;</div>
</div>



<div class="row">
	<div class="col-md-1">&nbsp;</div>
	<div class="col-md-10">
		<div class="panel panel-default">
		  <div class="panel-heading">Tipos de Tarefas</div>
		  <div class="panel-body">
		    
		  	<table class="table table-hover">
			  <thead>
			  	<th>#</th>
			  	<th>Tipo</th>
			  	<th>Cor</th>
			  	<th>&nbsp;</th>
			  </thead>
			  <tbody>
			  	<?php echo $resultTipos; ?>
			  </tbody>
			</table>


		  </div>
		</div>
	</div>
	<div class="col-md-1">&nbsp;</div>
</div>

<script type="text/javascript">
$(document).ready(function(){



	//color picker inicio
	$('#tipoCor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
		$(el).val(hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
	//color picker fim

	$("#inserir").click(function(){
		var nome = $("#tipoNome").val();
		var cor = $("#tipoCor").val();
		if(nome == ""){
			alert("O campo nome deve ser preenchido.");
		} else if (cor == ""){
			alert("O campo cor deve ser preenchido.");
		} else {
			$.ajax({
                url: '<?php echo base_url(); ?>sistema/insereTipo',
                type: 'POST',
                async: false,
                data: {
                    nome: nome,
                    cor: cor
                },
                success: function (data) {
                	if(data == "ok"){
                		location.reload();
                	}  else {
                		alert("Erro: "+data);
                	}
                }
            });
		}	
	});


	$(".excluir").click(function(){
		var id = $(this).attr('id');
		$.ajax({
            url: '<?php echo base_url(); ?>sistema/excluiTipo',
            type: 'POST',
            async: false,
            data: {
                id: id
            },
            success: function (data) {
            	if(data == "ok"){
            		location.reload();
            	}  else {
            		alert("Erro: "+data);
            	}
            }
        });

	});
});
</script>