<?php 
	include('config.php');
	HeaderEcho('Dragon Ball Super: Broly','css/index.css','imgs/logo.png');
?>
	<div class="modal" id="modal">
		<img src="imgs/goku.png">
		<div class="bar"></div>
		<i class="fa-solid fa-xmark iconMdl" onclick="Modal('#modal', '#frm1', 1)"></i>
		<div class="btnsMdl">
			<button class="btnMdl" onclick="formOpen('#frm1','#frm2')">Criar Conta</button>
			<button class="btnMdl" onclick="formOpen('#frm2','#frm1')">Entrar</button>
		</div>
		<div class="forms">
			<div class="criar" id="frm1">
				<div class="fotoPerfilInput">
					<div class="imgMostragem" id="ImgMost" style="background-image: url('imgs/perfilNoImg.png');"></div>
					<label for="InputImgEnv">Enviar Foto</label>
				</div>
				<form class="IntputsTexts" method="post" enctype="multipart/form-data">
					<input type="file" name="foto" id="InputImgEnv" accept="image/*">
					<input type="file" name="fotoSub" accept="image/*" value="imgs/perfilNoImg.png">
					<div class="InputTextIc">
						<i class="fa-solid fa-circle-user iconInput"></i>
						<input type="text" name="nickname" id="nickname" class="InputText" placeholder="Nome de usuario">		
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-user-pen iconInput"></i>
						<input type="text" name="nick" id="nick" class="InputText" placeholder="Nome Completo">		
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-key iconInput"></i>
						<input type="password" name="senha" id="senha" minlength="5" maxlength="25" class="InputText"  placeholder="Senha">
						<label class="InputLabel">Mínimo 5 caracteres</label>
						<input type="password" name="Confsenha" id="Confsenha" minlength="5" maxlength="25" class="InputText" placeholder="Confirmar senha">	
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-envelope iconInput"></i>
						<input type="email" name="email" id="email" class="InputText" placeholder="Email">
						<label class="InputLabel">Não esqueça do @</label>
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-phone iconInput"></i>
						<input type="tel" name="telefone" id="telefone" pattern="[0-9]{2}_[0-9]{4}-[0-9]{5}" class="InputText" placeholder="Telefone" minlength="13" maxlength="13">
						<label class="InputLabel">Modelo (XX_XXXX-XXXX)</label>
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-map iconInput"></i>
						<input type="text" name="endereso" id="endereso" class="InputText" placeholder="endereço">
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-calendar iconInput"></i>
						<input type="date" name="nacismento" id="nacismento" class="InputDate">
					</div>
					<input type="submit" name="UpdateUser" id="verCad" class="ocultar">
				</form>
				<button class="submitInputUser" onclick="cadVer()">Criar</button>
			</div>
			<div class="entrar" id="frm2">
				<form class="IntputsTexts" method="post" enctype="multipart/form-data">
					<div class="InputTextIc">
						<i class="fa-solid fa-envelope iconInput"></i>
						<input type="text" name="logNick" id="logNick" class="InputText" placeholder="Email ou nome de usuario">
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-key iconInput"></i>
						<input type="password" name="logSenha" id="logSenha" minlength="5" maxlength="25" class="InputText" placeholder="Senha">	
					</div>
					<input type="submit" name="VerLog" id="verLog" class="ocultar">
				</form>
				<button class="submitInputUser" onclick="LogVer()">Entrar</button>
			</div>
		</div>
	</div>
	<button onclick="subir()" class="irTop" id="irTop"></button>
	<div class="sistem" id="sistem">
		<header class="topo">
			<div class="head">
				<i class="fa-solid fa-bars icon" onclick="iconMod(this, '#menu', 0)"></i>
				<div class="login">
					<button class="btn" onclick="Modal('#modal', '#frm1', 0)">Criar Conta</button>
					<button class="btn ent" onclick="Modal('#modal', '#frm2', 0)">Entrar</button>
				</div>
			</div>
			<div class="menu ocultar" id="menu">
				<a href="https://www.facebook.com/murilo.gimenez.7543" class="menuA"><i class="fa-brands fa-facebook linkA"></i>FACEBOOK</a>
				<a href="https://twitter.com/v43410730" class="menuA"><i class="fa-brands fa-twitter linkA"></i>TWITTER</a>
				<a href="https://www.youtube.com/channel/UC5j326FDOeG70i3KixHsTSw" class="menuA"><i class="fa-brands fa-youtube linkA"></i>CANAL</a>
				<a href="https://github.com/murilouwu/estacionementoBD" class="menuA"><i class="fa-brands fa-github linkA"></i>PROJETO</a>
			</div>
		</header>
		
		<main class="meio">
			<div class="div">
				<div class="palagrafy">
					<p class="textDiv">Venha ver o filme Dragon Ball Super Broly no Estacionamento do jacandira </p>
					<button class="btn" onclick="Modal('#modal', '#frm1', 0)">Criar Conta para Comprar vaga</button>
				</div>
				<div class="bar"></div>
			</div>
			<div class="divA">
				<div class="card">
					<div class="imgCard" style="background-image: url('imgs/goku.png');filter: drop-shadow(3px -2px 7px var(--corE)) contrast(130%);"></div>
					<p class="pCard">Goku, o Sayajin que ama lutar, um defensor da terra</p>
				</div>
				<div class="card">
					<div class="imgCard" style="background-image: url('imgs/vegeta.png');filter: drop-shadow(3px -2px 7px var(--corB)) contrast(130%);"></div>
					<p class="pCard">Vegeta, o Principe Sayajins, o Rival de Goku</p>
				</div>
				<div class="card">
					<div class="imgCard" style="background-image: url('imgs/broly.png');filter: drop-shadow(3px -2px 7px var(--corD)) contrast(130%);"></div>
					<p class="pCard">Broly, o Sayajin puro, o Lendario Sayajin</p>
				</div>
				<div class="card">
					<div class="imgCard" style="background-image: url('imgs/freeza.png');filter: drop-shadow(3px -2px 7px var(--corA)) contrast(130%);"></div>
					<p class="pCard">Freeza, um Demonio definitivamente</p>
				</div>
				<div class="card">
					<div class="imgCard" style="background-image: url('imgs/gojeta.png');filter: drop-shadow(3px -2px 7px rgb(0 255 250)) contrast(130%);"></div>
					<p class="pCard">Gojeta, uma Fusão imbatível</p>
				</div>
			</div>
			<div class="divB">
				<p class="textDivMain">Sinopse do filme<br>Apesar da Terra estar em um periodo de calmaria Goku se recusa a parar de treinar constantemente. O que ele nao imaginava era que seu novo inimigo seria Broly um poderoso super saiyajin sedento por vinganca que deseja destruir todos que encontrar pela frente</p>
			</div>
		</main>

		<footer class="pe">
			<div class="caution">
				<img class="logCaution" src="imgs/shueisha.png">
				<img class="logCaution" src="imgs/bandai.png">
				<p class="pCaution">
					<label>©BIRD STUDIO/SHUEISHA</label>
					<label>©BIRD STUDIO, Toyotarou/SHUEISHA</label>
					<label>©BIRD STUDIO/SHUEISHA, TOEI ANIMATION</label>
				</p>
			</div>
			<div class="privacy">
				<a href="https://legal.bandainamcoent.co.jp/terms/?lang=en" class="txA">Termos e Condições</a>
				<a href="https://en.dragon-ball-official.com/privacy.html" class="txA">política de Privacidade</a>
			</div>
		</footer>
	</div>
	<script type="text/javascript">
		let ess = false;
		document.addEventListener("keydown", function(event){
		    if(event.key === "Backspace"){
		    	ess = true;
		    }else{
		    	ess = false;
		    }
		});

		$("#InputImgEnv").change(function(){
			let most = "#ImgMost";
		    PreViewImg(this, most);
		});
		document.querySelector('#telefone').addEventListener('input', ()=>{
			let tel = document.querySelector('#telefone');
			let possAtl = tel.value.length-1;
			let Ver = tel.value.slice(-1)=='_' || tel.value.slice(-1)=='-' ? false:tel.value.slice(-1);
			let Ver2 = Ver==false? false:isNaN(Ver);
			if(Ver2==true){
				tel.value = tel.value.substr(0, possAtl);
			}else if(possAtl==1){
				if(!ess){
					tel.value += "_";
				}else{
					tel.value = tel.value.substr(0, possAtl);
				}
			}else if(possAtl==6){
				if(!ess){
					tel.value += "-";
				}else{
					tel.value = tel.value.substr(0, possAtl);
				}
			};
		});

		function cadVer(){
			let dados = [
				document.querySelector('#senha').value,
				document.querySelector('#Confsenha').value,
				document.querySelector('#email').value,
				document.querySelector('#telefone').value,
				document.querySelector('#nacismento').value
			];
			let verific = [
				dados[0]==dados[1] && dados[0].length>=5? true:false,
				dados[2].includes("@"),
				dados[3].length == 13? true:false,
				VerData(dados[4],0)
			];
			let pass = verific.includes(false);
			if(pass){
				let mens = [
					verific[0]? '':'-As senhas nos inputs tem que ser iguais e com mais de 5 caracteres\n',
					verific[1]? '':'-Você esqueceu do @\n',
					verific[2]? '':'-Número de telefone invalido não segue o modelo\n',
					verific[3]? '':'-'+VerData(dados[4],1)
				];
				let menFinal = mens[0]+mens[1]+mens[2]+mens[3];
				alert(menFinal);
			}else{
				let btn = document.querySelector("#verCad");
				btn.click();
			}
		}

		function LogVer(){
			let btn = document.querySelector("#verLog");
			btn.click();
		}
	</script>
<?php
	footEcho();

	if(isset($_POST['UpdateUser'])){
		$dados = array(
			$_FILES['foto'],//0
			$_POST['nickname'],//1 nome de usuario
			$_POST['nick'],//2 nome completo
			$_POST['senha'],//3
			$_POST['email'],//4
			$_POST['telefone'],//5
			$_POST['endereso'],//6
			$_POST['nacismento']//7
		);
		//$_SESSION['user'] = CadUser($dados[1], $dados[2], $dados[4], $dados[7], $dados[6], $dados[3], $dados[5], $link);
	}
	if(isset($_POST['VerLog'])){
		$dados = array(
			$_POST['logNick'],//0
			$_POST['logSenha']//1
		);
		//$_SESSION['user'] = Login($dados[0], $dados[1]);
	}
?>
