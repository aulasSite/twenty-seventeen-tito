<?php
	/*
	Template Name: brancoSequencia
	*/
	get_header();
	$resposta=array();
	$inicial="";
    $conta="";
	$vezes="";
	$soma="";
	$repeticoes="";
	$somaDeTudo="";
    if (isset($_POST['inicial']) and isset($_POST['conta']) and isset($_POST['vezes'])) {
      $inicial=$_POST['inicial'];
      $conta=$_POST['conta'];
	  $vezes=$_POST['vezes'];
	  if($inicial=="" or $conta=="" or $vezes==""){}
	  else{
	  
	  
		  array_push($resposta,$inicial);
		  $contas=$inicial.$conta;
		  $valor=eval("return ($contas);");
			array_push($resposta,$valor);
			for ($i = 0; $i < ($vezes-2); $i++) {		
				$contas=$valor.$conta;
				$valor=eval("return ($contas);");
				array_push($resposta,$valor);
			}
			if(isset($_POST['soma']) and isset($_POST['repeticoes'])){
				$soma=$_POST['soma'];
				$repeticoes=$_POST['repeticoes'];
				if($soma=="" or $repeticoes==""){
				}
				else{
					$somaDeTudo=$inicial;
					for ($i = 1; $i  < intval($repeticoes) ; $i++) {		
						$somaDeTudo.=$soma.$resposta[$i];
					}
					echo $somaDeTudo;
					$somaDeTudo=eval("return ($somaDeTudo);");
				}
				
			}
		}
	}
	$resposta=implode(" , ",$resposta);
 ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<form method="POST" id="formSequencia">
				<input type="number" name="inicial" value="<?php echo($inicial); ?>">
				<div id="contaForm">
					N<input type="text"name="conta" id="conta" value="<?php echo($conta); ?>">
				</div>	
				<input type="number" name="vezes" value="<?php echo($vezes); ?>">
				<input type="submit">
				<select name="soma">
					<option name="mais" value="+">+</option>
					<option name="menos" value="-">-</option>
					<option name="vezes" value="*">x</option>
					<option name="dividido" value="/">÷</option>
				</select>
				<input type="number" name="repeticoes">
			</form>
			<p><?php echo($resposta); ?></p>
		
			<p><?php echo ($somaDeTudo);?></p>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();?>
