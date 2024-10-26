<?
	$anio = $_GET['anio'];
	$mes = $_GET['mes'];
	$dia = $_GET['dia'];
	$hora = $_GET['hora'];
?>

<div class="row text-center">
     <strong>DIA <? echo $dia ?> - <? echo $hora ?></strong> <a href='?anio=<? echo $anio ?>&mes=<? echo $mes ?>' style="color:#F00">[x]</a>
</div>



<div class="calendar-year text-center"></div>

<div class="row" style="margin-top:10px;">
     <form name="formu" method="post">
		<input type="hidden" name="anio" value="<? echo $anio?>"  />
		<input type="hidden" name="mes" value="<? echo $mes?>"  />
		<input type="hidden" name="dia" value="<? echo $dia?>"  />
		<input type="hidden" name="hora" value="<? echo $hora?>"  />

          <div class="form-group col-md-6">
               <input type="text" name="apellido" class="form-control" placeholder="Apellido">
          </div>
          <div class="form-group col-md-6">
               <input type="text" name="nombre" class="form-control" placeholder="Nombre">
          </div>
          <div class="form-group col-md-6">
               <input type="text" name="dni" class="form-control" placeholder="DNI">
          </div>
          <div class="form-group col-md-6">
               <input type="email" name="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group col-md-6">
               <input  type="text" name="cel" class="form-control" placeholder="Celular">
          </div>
          <div class="form-group col-md-12">
			<input onclick="recibeid('confirma.php', 'anio='+formu.anio.value+'&mes='+formu.mes.value+'&dia='+formu.dia.value+'&hora='+formu.hora.value+'&apellido='+formu.apellido.value+'&nombre='+formu.nombre.value+'&dni='+formu.dni.value+'&email='+formu.email.value+'&cel='+formu.cel.value, '', 'div_dia')" class="btn btn-success" value="CONFIRMAR TURNO" />
          </div>

	</form>
</div>
