<?
	function saber_dia($nombredia) { $dias = array('','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'); $fecha = $dias[date('N', strtotime($nombredia))]; return $fecha; }
	$anio = $_GET['anio']; $mes = $_GET['mes']; $dia = $_GET['dia'];
	$int_m = $_GET['int_m'];
	$horas_exeptuadas = array('13:30', '11:30');

	include('setting.php');
?>
<style>
  <? $count = 0; for ($x = 0; $x < 60; $x = $x + $int_m) { $count++; } ?>
  .horas-cols .col-horas {
    width: <? echo 100/$count; ?>%;
    *width: <? echo 100/$count; ?>%;
    text-align:center;
    display: inline-block;
    margin:0px;
    margin-top:5px;
    float:left;
 /*   margin:5px;*/
}
</style>  

<div class="row">
     <div class="col-md-12 text-center ">
          <? echo saber_dia($anio.$mes.$dia).' '.$dia ?> 
     </div>
</div>
<div class="row horas-cols" style="margin-top:10px;">
<?
				$ampm = 'AM';
//				$m = 0;
//				$h_ini = $_GET['h_ini']; 
//				echo "<br />inicio ".$horario_calendario[saber_dia($anio.$mes.$dia)]['i']."<br />";
				list($h_ini, $m_ini) = explode(":", $horario_calendario[saber_dia($anio.$mes.$dia)]['i']);
				list($h_fin, $m_fin) = explode(":", $horario_calendario[saber_dia($anio.$mes.$dia)]['f']);

				while(str_pad($h_ini, 2, "0", STR_PAD_LEFT).str_pad($m_ini, 2, "0", STR_PAD_LEFT) <= str_pad($h_fin, 2, "0", STR_PAD_LEFT).str_pad($m_fin, 2, "0", STR_PAD_LEFT)) 
				{
					if($h_ini >= 12){ $ampm = 'PM'; }
					$h_ini = str_pad($h_ini, 2, "0", STR_PAD_LEFT);
					$m_ini = str_pad($m_ini, 2, "0", STR_PAD_LEFT);
					$hora_imp = $h_ini.":".$m_ini." ".$ampm;
					if(in_array($h_ini.":".$m_ini, $horas_exeptuadas)) { $style = 'cursor: not-allowed; background: #eee !important;'; $onclick = ''; }
					else{ $style = 'cursor:pointer'; $onclick = "onclick=\"recibeid('datos.php','anio=".$anio."&mes=".$mes."&dia=".$dia."&hora=".$hora_imp."', '', 'div_dia')\";"; }

					?>
                    	<li class="col-horas" style=" <? echo $style ?>" <? echo $onclick ?> ><? echo $hora_imp ?></li>
                    	<? 
					$m_ini = $m_ini + $int_m;
					if($m_ini == 60){ $h_ini++; $m_ini = 0; }
				} 
				?>
</div>