<?php 
$resultTarefas = "";

if(count($tarefas)>0){
	foreach ($tarefas as $tarefa) {
		$resultTarefas .= '<tr style="color:#'.$tarefa['tipoCor'].'">';
			$resultTarefas .= '<td class="col-md-3"><i class="fa fa-flag fa-1x" style="color:#'.$tarefa['tipoCor'].'"></i> '.$tarefa['tipoNome'].'</td>';
			$resultTarefas .= '<td class="col-md-4">'.$tarefa['tarefaNome'].'</td>';
			$resultTarefas .= '<td class="col-md-2"><button type="button" class="btn btn-success concluir" id="'.$tarefa['PKTarefas'].'">Concluir <i class="fa fa-check"></i></button></td>';
		$resultTarefas .= '</tr>';
	}
} else {
	$resultTarefas .= '<tr>';
	$resultTarefas .= '<td class="col-md-12">Não existe nenhuma tarefa pendente... <a href="'.base_url().'sistema/nova">Clique aqui para cadastrar!</a></td>';
	$resultTarefas .= '</tr>';
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
		  <div class="panel-heading">Tarefas</div>
		  <div class="panel-body">
		    
		  	<table class="table table-hover">
			  <thead>
			  	<th>Tipo</th>
			  	<th>Tarefa</th>
			  	<th>&nbsp;</th>
			  </thead>
			  <tbody>
			  	<?php echo $resultTarefas; ?>
			  </tbody>
			</table>


		  </div>
		</div>
	</div>
	<div class="col-md-1">&nbsp;</div>
</div>

<script type="text/javascript">
$(document).ready(function(){

	$(".concluir").click(function(){
		var id = $(this).attr('id');		
		console.log(id);	
		$.ajax({
            url: '<?php echo base_url(); ?>sistema/concluiTarefa',
            type: 'POST',
            async: false,
            data: {
                id: id,
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