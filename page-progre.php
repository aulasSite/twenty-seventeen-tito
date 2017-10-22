<?php
	/*
	Template Name: brancoProg
	*/
	get_header('progressoes');
	
	
	$texto="";
	$resposta="";
	$conclusao = "";
	if(isset($_POST['texto'])){
		$texto=$_POST['texto'];
		$objetivo = $_POST['objetivo'];
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
			}																		//aqui acaba a parte em comum
			$contagem = count($array);
			if($objetivo == "IDE"){										//identificador
				if($contagem > 2){
					if( $array[1] - $array[0] == $array[2] - $array[1]){
						$objetivo = "PA";
					}
					elseif($array[1] / $array[0] == $array[2] / $array[1]){
						$objetivo = "PG";
					}
					else{
						$resposta = "Não é nenhum dos dois";
					}
				}
				else{$resposta = "Preciso  de pelo menos três números!";}
			}
			if($objetivo == "PA"){	
				
				if($contagem < 2){
					$resposta = "Não é uma progressão aritmética";
				}
				else{
					$formula = $array[1] - $array[0];
					$contador = 0;
					$erro = false;
					while( $contador < $contagem){
						if($contador > 0){
							if($array[$contador] - $array[$contador - 1] == $formula){
								
							}
							else{
								$erro = true;
							}
						}
						$contador++;
					}
					if($erro === false){
						$resposta = $formula;
						if(strpos($resposta, "-")===FALSE){					//completa a resposta com + se for positiva
							$resposta="+".$resposta;
						}				
						$contagem--;
						while($contagem < 23){										//completa a sequencia até atingir 24
							$contas = $array[$contagem] . $resposta;
							$sequencia = eval("return ($contas);");
							array_push ($array , $sequencia);
							$contagem++;
						}
						$texto = implode(" , " , $array);	
						$conclusao = "Nesse caso, é uma progressão aritmética.";
					}
					else{
						$resposta = "Não é uma progressão aritmética";
					}
				}
			}								//aqui acaba a prog aritmética
			elseif($objetivo == "PG"){
				if(in_array("0" , $array)){	$resposta = "Não é uma progressão geométrica";}
				else{
					$contagem = count($array);
					if($contagem < 2){
						$resposta = "Não é uma progressão geométrica";
					}
					else{
						$formula = $array[1] / $array[0];
						$contador = 0;
						$erro = false;
						while( $contador < $contagem){
							if($contador > 0){
								if($array[$contador] / $array[$contador - 1] == $formula){
									
								}
								else{
									$erro = true;
								}
							}
							$contador++;
						}
						if($erro === false){
							$resposta = $formula;
							if(strpos($resposta, "-") > -1){					//completa a resposta com ( ) se for negativa
								$resposta="(".$resposta.")";
							}				
							$contagem--;
							while($contagem < 23){										//completa a sequencia até atingir 24
								$contas = $array[$contagem] . "*" .  $resposta;
								$sequencia = eval("return ($contas);");
								array_push ($array , $sequencia);
								$contagem++;
							}
							$texto = implode(" , " , $array);	
							$resposta = "* " . $resposta;
						}
						else{
							$resposta = "Não é uma progressão geométrica";
						}
					}
				}
			}
		$resposta=$texto."<br>".$resposta;	
		}
	}
	
 ?>	
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" class="progressoesMain" role="main" >
		<p>Descubra se sua lista é uma progresão! Preencha no formato <i>n°, n° ,n°</i>.<br>
			<?php echo $conclusao;?>
		</p>
		<form action='' method='POST' id="formProgressoes">
			<input type='text' name="texto" placeholder="n , n , n , ... , ... ," id="tel">
			<span id='spanPA'><input type="radio" name="objetivo" value="PA" > Progressão Aritmética</span>
			<span id='spanPG'><input type="radio" name="objetivo" value="PG"  id="radius-p-g"> Progressão Geométrica</span><br>
			<span id='spanIDE'><input type="radio" name="objetivo" value="IDE" checked id="radius-p-g"> Identificar(min 3 numeros)<br></span>
		</form>
		<p id="resposta"><?php echo $resposta;?></p>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<script>
	$(document).ready(function () {
		<?php
			if($resposta == ""){}
			else{
				echo '$("#resposta").animate({top:  "+=160px"}, 1000 , function(){});
				console.log("entrei no else");';
			}
		?>
	});
	$('#formProgressoes input').on('change', function() {
		if($('input[name=objetivo]:checked', '#formProgressoes').val() == "IDE"){	
			$("#favicon").attr("href","http://www.free-icons-download.net/images/math-symbols-24346.png");
			console.log("ide");
		}
		else if($('input[name=objetivo]:checked', '#formProgressoes').val() == "PA"){
			$("#favicon").attr("href","https://png.icons8.com/plus/win8/1600");
		}		
		else if($('input[name=objetivo]:checked', '#formProgressoes').val() == "PG"){
			$("#favicon").attr("href","http://downloadicons.net/sites/default/files/close21-76282.png");
		}
	});
	
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
