<?php
	/*
	Template Name: brancoP.A.
	*/
	get_header();
	
	
	$texto="";
	$resposta="";
	if(isset($_POST['texto'])){
		$texto=$_POST['texto'];
		$texto = str_replace (" " , "" , $texto );	
		if($texto=="" ){}
		elseif(
			strpos($texto,"++") === FALSE	&&
			strpos($texto,"--") === FALSE	&&
			strpos($texto,"//") === FALSE	&&
			strpos($texto,"..") === FALSE
		) {
			$arrayDoTexto=explode("," , $texto);
			$array=array();
			foreach($arrayDoTexto as $elemento){
				if($elemento==""){$elemento=0;}
				$elemento = eval("return ($elemento);");
				array_push ($array , $elemento);
			}
			
			if(count($array)==1){
				$resposta = "Não é uma progressão aritmética";
			}
			elseif(count($array)==2){
				$resposta = $array[1] - $array[0];
				if(strpos($resposta, "-")===FALSE){
						$resposta="+".$resposta;
						$contagem=	count($array)-1;
						while($contagem < 23){
							$contas = $array[$contagem] . $resposta;
							$sequencia = eval("return ($contas);");
							array_push ($array , $sequencia);
							$contagem++;
							}
						$texto = implode(" , " , $array);	
					}
					$resposta = "Regra: <br>".$resposta;
			}
			else{
				$formula = $array[1] - $array[0];
				if($array[1] + $formula == $array[2]){
					$resposta = $formula;
					if(strpos($resposta, "-")===FALSE){
						$resposta="+".$resposta;
						$contagem=	count($array)-1;
						while($contagem < 23){
							$contas = $array[$contagem] . $resposta;
							$sequencia = eval("return ($contas);");
							array_push ($array , $sequencia);
							$contagem++;
						}
						$texto = implode(" , " , $array);	
					$resposta = "Regra: <br>".$resposta;
					}
				}
				else{
					$resposta = "Não é uma progressão aritmética";
				}
			}	
		}
	}
	$resposta=$texto."<br>".$resposta;
 ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<form action='' method='POST' id="formPA">
			<input type='text' name="texto" placeholder="n , n , n , ... , ... ," id="tel">
			
		<form>
		<p><?php echo $resposta;?></p>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<script>
	var inputEl = document.getElementById('tel');
	var goodKey = '0123456789+ -,/';
	var key = null;

	var checkInputTel = function() {
	  var start = this.selectionStart,
		end = this.selectionEnd;

	  var filtered = this.value.split('').filter(filterInput);
	  this.value = filtered.join("");

	  /* Prevents moving the pointer for a bad character */
	  var move = (filterInput(String.fromCharCode(key)) || (key == 0 || key == 8)) ? 0 : 1;
	  this.setSelectionRange(start - move, end - move);
	}

	var filterInput = function(val) {
	  return (goodKey.indexOf(val) > -1);
	}

	/* This function save the character typed */
	var res = function(e) {
	  key = (typeof e.which == "number") ? e.which : e.keyCode;
	}

	inputEl.addEventListener('input', checkInputTel);
	inputEl.addEventListener('keypress', res);
</script>

<?php get_footer();?>
