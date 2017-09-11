<?php
/*
Template Name: pagina de Criptografia
*/
?>
<?php
     get_header( );
    if (isset($_POST['texto']) and isset($_POST['senha'])) {
      $resposta="";
      $acao=$_POST['option'];
      $senha=$_POST['senha'];
      $senha=intval($senha);
      $subject=$_POST['texto'];
  	  srand($senha);
      if($senha=="" or $subject==""){
        $resposta="";
      }
      else{
        $usados=array();
          function norepeat(){
            $numero=rand(100,999);
            while(in_array($numero,$GLOBALS['usados'])){
               $numero=rand(100,999);
            }
            array_push($GLOBALS['usados'],$numero);
            return $numero;
            }
          function ordutf8($u){
            $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
            $k1 = ord(substr($k, 0, 1));
            $k2 = ord(substr($k, 1, 1));
            return $k2 * 256 + $k1;
          }

        $lista=array(" ","!",'"',"#","$","%","&","'","(",
          ")","*","+",",","-",".","/","0","1",
          "2","3","4","5","6","7","8","9",":",
          ";","<","=",">","?","@","A","B","C",
          "D","E","F","G","H","I","J","K","L",
          "M","N","O","P","Q","R","S","T","U",
          "V","W","X","Y","Z","[","]","^",
          "_","`","a","b","c","d","e","f","g",
          "h","i","j","k","l","m","n","o","p",
          "q","r","s","t","u","v","w","x","y",
          "z","{","|","}","~","á","Á","à","À",
          "ã","Ã","â","Â","Ç","ç","é","É","è",
          "È","ê","Ê","õ","Õ","ô","Ô","í","Í","ì","Ì");
        $valores=array();
        $offset=0;
        foreach ($lista as $letra ) {
            $atual=ordutf8($letra );
            $valores[$atual] = norepeat();
    		// echo ($letra." = ".$atual."<br>");
        }
    		//print_r($valores);
        $resposta="";
          if ($acao=="criptografar"){
            $index=0;
            $arrayDoSubject=str_split($subject);
            //var_dump($arrayDoSubject);
    		$erro=0;
            while($index<(mb_strlen($subject)+$erro)){          //criptografar
              if(in_array ( $subject[$index] , $lista)){
                $letraAtual=$subject[$index];
                $letraAtual=ordutf8($letraAtual);
                $index++;
              }
              else{
                $letraAtual= $arrayDoSubject[$index]. $arrayDoSubject[$index+1];
                $letraAtual=ordutf8($letraAtual);
                $index=$index+2;
    			$erro=1;
              }
              $resposta.=$valores[$letraAtual];
            }
          }
          elseif($acao=="descriptografar"){
            function unichr($u) {
              return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
              }
            $array=str_split($subject,3);
            foreach ($array as $key ) {
              $ascii=array_search( $key , $valores);
              $resposta.=(unichr( $ascii ));
            }
          }
        }
      }
      ?>

      		<link href="https://fonts.googleapis.com/css?family=Cutive+Mono|VT323" rel="stylesheet">
      		<link href="https://fonts.googleapis.com/css?family=Cutive+Mono|VT323" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

      		<h1>Criptografia</h1>
          <section>
        		<form action="" method="POST">
        			<p id="senha">senha:</p>
        			<input type="password" pattern="[0-9]{1,1000}"class="quad_senha"name="senha"><br>
        			<p id="advice">Apenas números<p>
        			<p id="texto">texto:</p>
        			<textarea class="quad_texto" name="texto"></textarea><br>
        			<input class="button"type="submit"name="option"value="criptografar">
        			<input class="button"type="submit"name="option"value="descriptografar"><br>
        		</form>
            <p class="ex"><?php echo($resposta);?></p>
      	<script>
      		String.prototype.replaceAt=function(index, replacement) {
      			return this.substr(0, index) + replacement+ this.substr(index + replacement.length);
      			}
      		function randomString() {
      			var result = '';
      			for (var i = 1; i > 0; --i) result += '$%#!@&*abcdef1234567890xyz'[Math.floor(Math.random() * 26)];
      			return result;
      			}
      		var medio = $( ".ex" ).text();
      		var original = $( ".ex" ).text();
      		var q = $('.ex').text().length;	//Tamanho da frase
      		function tempo(temp,numero){
      			setTimeout(function(){
      				var medio = $( ".ex" ).text();
      				medio=medio.replaceAt(numero, randomString());
      				$( ".ex" ).text(medio);
      				}, temp);
      				}
      		function alea(vezes,indecs){
      			var n=0;
      			var tim=0;
      			while(n<vezes){
      				tempo(tim,indecs);
      				n++;
      				tim=tim+100;
      				}
      			}
      		function randomDisplay(inicial,tempos){
      			var contador=0;
      			var ent=q-inicial;
      			while(q>ent){
      				alea(tempos,ent);
      				tempos=tempos+5;
      				var timer=tempos+1;
      				timer= timer*100;
      				setTimeout(function(){
      					medio=medio.replaceAt(ent, original.charAt(ent));
      					$( ".ex" ).text(medio);
      					}, timer);
      				ent++;
      				}
      			}
      		if(q==0){
      			console.log('não tem nada');
      			$( '.ex' ).css('visibility', 'hidden');
      			}
      		else{
      			randomDisplay(5,5);
      			}
      		var alfabeto = new Array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"," " );
      		$(".quad_texto").keyup(function(){
      			var tamanho=($(".quad_texto").text().length);
      			var ultimo=tamanho-1;
      			var ultimaLetra=$(".quad_texto").text()[ultimo];
      			if(jQuery.inArray( ultimaLetra, alfabeto )==-1){
      				console.log(jQuery.inArray( ultimaLetra, alfabeto ));
      				console.log("não tem");
      				$('.quad_texto').text(function (_,txt) {
          			return txt.slice(0, -1);
      					var val = $(this).val();
            		$(this).val('');
            		$(this).val(val);
      					event.preventDefault();
      					$('.quad_texto').click();
      					});
      				}


      			})
      	</script>
      </html>
      <?php
get_footer( );
 ?>
