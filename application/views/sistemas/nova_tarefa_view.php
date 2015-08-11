<?php 
if(count($tipos)>0){
	$selectTipos = '<select class="form-control" id="selectTipos">';
	$selectTipos .= '<option value="0">Selecione...</option>';
	foreach ($tipos as $tipo) {
		$selectTipos .= '<option value="'.$tipo['PKTipo'].'">'.$tipo['tipoNome'].'</option>';
	}
	$selectTipos .= '</select>';
} else {
	$selectTipos = 'Não existe nenhum tipo cadastrado... <a href="'.base_url().'sistema/tipos">Clique aqui para cadastrar!</a>';
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
				<div class="col-md-1"><label for="selectTipos">Tipo:</label></div>
				<div class="col-md-9"><?php echo $selectTipos; ?></div>
				<div class="col-md-1">&nbsp;</div>
			</div>


		  	<div class="row">
				<div class="col-md-12">&nbsp;</div>
			</div>
		    
		  	<div class="row">
				<div class="col-md-1">&nbsp;</div>
				<div class="col-md-1"><label for="tarefaNome">Nome:</label></div>
				<div class="col-md-9"><input type="text" class="form-control" placeholder="Nome da tarefa" id="tarefaNome"></div>
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

<script type="text/javascript">
$(document).ready(function(){

	$("#inserir").click(function(){
		var nome = $("#tarefaNome").val();
		var tipo = $("#selectTipos").val();
		if(nome == ""){
			alert("O campo nome deve ser preenchido.");
		} else if (tipo == "0" || tipo == "1"){
			alert("O campo tipo deve ser selecionado.");
		} else {
			$.ajax({
                url: '<?php echo base_url(); ?>sistema/insereTarefa',
                type: 'POST',
                async: false,
                data: {
                    nome: nome,
                    tipo: tipo
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

});
</script>