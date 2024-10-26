<?
	if(empty($_GET['mes'])){ $mes = date('m'); $anio = date('Y'); }else{ $mes = $_GET['mes']; $anio = $_GET['anio']; } 

	
	include('setting.php');
	foreach($horario_calendario as $clave => $valor)
	{
		if(!($horario_calendario[$clave]['i']-$horario_calendario[$clave]['f']))
		{
			$dias_sem_exeptuados[] = $clave; 

		} 
	}
		

	$meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

	$mes = str_pad($mes, 2, "0", STR_PAD_LEFT); 
	if($mes == 12){ $mes_prev = $mes-1; $mes_next = '01'; $anio_prev = $anio; $anio_next = $anio+1; } 
	elseif($mes == 01){ $mes_prev = 12; $mes_next = $mes + 1;  $anio_prev = $anio-1; $anio_next = $anio; } 
	else{ $mes_prev = $mes-1; $mes_next = $mes + 1; $anio_prev = $anio; $anio_next = $anio; }
	$mes = str_pad($mes, 2, "0", STR_PAD_LEFT); $mes_next = str_pad($mes_next, 2, "0", STR_PAD_LEFT); $mes_prev = str_pad($mes_prev, 2, "0", STR_PAD_LEFT); 
	
	$inicio = date('N', strtotime($anio.'-'.$mes.'-01'));
	$cantidad = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
	$total = $inicio + $cantidad;
?>


<div class="row" >
     <div class="col-md-2 text-center" style="display: inline-block; float:left;"><button onclick="recibeid('dia.php', 'anio=<? echo $anio_prev; ?>&mes=<? echo $mes_prev; ?>', '', 'div_dia')"> << </button></div>
     <div class="col-md-8 text-center" style="display: inline-block; float:left;"><?  echo $anio." - ".$meses[($mes+0)] ?></div>
     <div class="col-md-2 text-center" style="display: inline-block; float:left;"><button onclick="recibeid('dia.php', 'anio=<? echo $anio_next; ?>&mes=<? echo $mes_next; ?>', '', 'div_dia')"> >> </button></div>
</div>

<div class="row seven-cols" style="border-bottom:#CCC 1px solid; margin-bottom:5px;">
     <div class="col-dias">Lun</div>
     <div class="col-dias">Mar</div>
     <div class="col-dias">Mié</div>
     <div class="col-dias">Jue</div>
     <div class="col-dias">Vie</div>
     <div class="col-dias">Sáb</div>
     <div class="col-dias" style="color:#F00">Dom</div>
</div>

<div class="row seven-cols" style="margin-top:10px;">
	<?  
     function saber_dia($nombredia) 
     {
          $dias = array('','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo');
          $fecha = $dias[date('N', strtotime($nombredia))];
          return $fecha;
     }

     $dia_imp = '';
     for($i = 1; $i < $total; $i++)
     { 
          if($i >= $inicio){ $dia_imp++; $style = ''; } 
          $fecha_cal = $anio.$mes.str_pad($dia_imp, 2, "0", STR_PAD_LEFT); 
          $fecha_actual = date('Ymd');
          if($dia_imp == '') { $style = 'cursor: not-allowed; background: #fff !important;'; $onclick = '';}
          elseif(in_array(saber_dia($fecha_cal), $dias_sem_exeptuados)) { $style = 'cursor: not-allowed; background: #eee !important;'; $onclick = ''; }
          elseif(in_array($fecha_cal, $dias_exeptuados)) { $style = 'cursor: not-allowed; background: #eee !important;'; $onclick = ''; }
          elseif($fecha_cal >= $fecha_actual) { $style = 'cursor:pointer'; $onclick = "onclick=\"recibeid('hora.php', 'anio=".$anio."&mes=".$mes."&dia=".$dia_imp."', '', 'div_hora')\""; }
          else{ $style = 'cursor: not-allowed; background: #eee !important;'; $onclick = '';}
          ?>
          <div class="col-dias" style="<? echo $style; ?>" <? echo $onclick; ?>>
          <?
               if($dia_imp != '') { echo $dia_imp; }
          ?>
          </div>
          <? 
     } 
     ?>
</div>
<div id='div_hora'></div>