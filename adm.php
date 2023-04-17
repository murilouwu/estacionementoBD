<?php 
	session_start();
	include('config.php');
	HeaderEcho('Adm','css/Fun.css','imgs/logo.png');
	if(isset($_SESSION['user'])){
		if($_SESSION['user']->sl_adm == 0){
			move('use.php');
		}
	}else{
		move('index.php');
	}
?>
	<script type="text/javascript">
		function Modal2(modal, form, fun){
			let divs = [
				document.querySelector(modal),
				document.querySelector(form)
			];
			if(fun==1){
				divs[0].style.display = 'none';
				divs[1].style.display = 'none';
			}else{
				divs[0].style.display = 'flex';
				divs[1].style.display = 'flex';
			}
		}
	</script>
	<div class="modal" id="modal">
		<img src="imgs/goku.png">
		<div class="bar"></div>
		<i class="fa-solid fa-xmark iconMdl2" onclick="Modal2('#modal', '#frmA', 1)"></i>
		<div class="formsModal">
			<div class="criar2" id="frmA">
				<div class="fotoPerfilInput">
					<div class="imgMostragem" id="ImgMost2" style="background-image: url(<?php echo $_SESSION['user']->img?>);"></div>
					<label for="InputImgEnv2">Trocar Foto</label>
				</div>
				<form class="IntputsTexts" method="post" enctype="multipart/form-data">
					<input type="file" name="foto" id="InputImgEnv2" accept="image/*">
					<input type="file" name="fotoSub" accept="image/*" value="imgs/perfilNoImg.png">
					<div class="InputTextIc">
						<i class="fa-solid fa-user-pen iconInput"></i>
						<input type="text" name="nick" id="nick" class="InputText" placeholder="Novo Nome de usuario" value="<?php echo $_SESSION['user']->nm_name?>">		
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-key iconInput"></i>
						<input type="password" name="senha" id="senha" minlength="5" maxlength="25" class="InputText"  placeholder="Nova Senha">
						<label class="InputLabel">Mínimo 5 caracteres</label>
						<input type="password" name="Confsenha" id="Confsenha" minlength="5" maxlength="25" class="InputText" placeholder="Confirmar nova senha">	
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-phone iconInput"></i>
						<input type="tel" name="telefone" id="telefone" pattern="[0-9]{2}_[0-9]{4}-[0-9]{5}" class="InputText" placeholder="Telefone" minlength="12" maxlength="13" value="<?php echo $_SESSION['user']->nr_tel?>">
						<label class="InputLabel">Modelo (XX_XXXX-XXXXX)</label>
					</div>
					<div class="InputTextIc">
						<i class="fa-solid fa-map iconInput"></i>
						<input type="text" name="endereso" id="endereso" class="InputText" placeholder="endereço" value="<?php echo $_SESSION['user']->des_endereco?>">
					</div>
					<input type="submit" name="UpdateUser" id="verCad" class="ocultar">
				</form>
				<button class="submitInputUser" onclick="cadVer()">Atualizar</button>
			</div>
		</div>
	</div>
	<div class="sistem">
		<div class="topo">
			<div class="head">
				<i class="fa-solid fa-bars icon" onclick="iconMod(this, '#menu', 0)"></i>
				<div class="Return" onclick="red('index.php')"></div>
				<div class="login">
					<div style="background-image: url(<?php echo $_SESSION['user']->img?>);" class="Perfil" onclick="Modal2('#modal', '#frmA', 0)"></div>
				</div>
			</div>
			<div class="menu ocultar" id="menu">
				<a class="menuA" onclick="FormExeculte(0)"></i>Mudar os Precos</a>
				<a class="menuA" onclick="FormExeculte(1)"></i>Mudar os Precos estacionamento</a>
				<a class="menuA" onclick="FormExeculte(2)"></i>Deletar Estacionamento</a>
				<form method="post" class="ocultar">
					<input type="number" name="CdEsta" id="FrmFunCdEsta" value="0">
					<input type="number" name="Function" id="FrmFunFunction">
					<input type="number" name="vl" value="0" step="0.01" id="FrmFunVl">
					<input type="submit" name="EnvFatal" id="FrmFunEnvFatal">
				</form>
			</div>	
		</div>
		<div class="main">
			<?php
				$estas = EstacionTable();
				if($estas == false){
					echo '
						<div class="Plus">
							<label class="lbPlus">Criar Estacionamento</label>
							<i class="fa-solid fa-square-plus icon" onclick="MenuLeft(0)"></i>
						</div>
					';
				}else{
					$Text = '';
					for ($i=0; $i<count($estas); $i++) { 
						$bk = "background-image: url('".$estas[$i]['img']."');";
						$on = "AbrirEstacion(".$estas[$i]['cd_esta'].", ['#inputA','#submitA'])";
						$Text = $Text.'
							<div class="card" style="'.$bk.'" onclick="'.$on.'">
								<p class="CardTitle">'.$estas[$i]['nm_name'].'</p>
							</div>
						';	
					};
					echo '
						<div class="Plus" id="plus">
							<label class="lbPlus">Escolha um Estacionamento</label>
							<div class="Srcoll">
								<div class="SrcollX">
									'.$Text.'
									<i class="fa-solid fa-square-plus icon" onclick="MenuLeft(0)"></i>
								</div>
							</div>
						</div>
						<form class="ocultar" method="post">
							<input type="number" name="cd" id="inputA">
							<input type="submit" name="EnvB" id="submitA">
						</form>
					';
				}
			?>
			<div id="EstaMain" class="Estacionamento">
				<i class="fa-solid fa-xmark iconEsta" onclick="mostrar(['#EstaMain','#plus'], 1)"></i>
				<?php
					if(isset($_POST['EnvB'])){
						$cd = $_POST['cd'];
						echo '
							<script>
								mostrar([\'#plus\',\'#EstaMain\'], 1);
							</script>';
						$vags = Estavags($cd);
						if($vags == false){
							echo '
								<div class="malha">
									<div class="Telao">Telao</div>
									<div id="mal" style="display: none;"></div>
									<i class="fa-solid fa-square-plus icon" onclick="addCard(this,0,\'#mal\',0)"></i>
								</div>
							';
						}else{
							$vagsOr = array();
							for ($i=0; $i<count($vags); $i++) { 
								$xY = array($vags[$i]['ps_Y'],$vags[$i]['ps_X']);
								$vagsOr[$xY[0]][$xY[1]] = $vags[$i];  
							}
							echo '
								<div class="malha">
									<div class="Telao">Telao</div>
								';
							for ($i=0; $i<count($vagsOr); $i++) { 
								echo '<div class="linhay">';
								for ($i2=0; $i2<count($vagsOr[$i]); $i2++) { 
									$typeCSS = [
										'cam',
										'bus',
										'car',
										'van'
									];
									$user = SearchUserVag($vagsOr[$i][$i2]['cd_vag']);
									$style = 'style="background-image: url(\''.$user->img.'\');"';
									$EditOn = $vagsOr[$i][$i2]['ocup']==0? ' onclick="editVaga2('.$vagsOr[$i][$i2]['cd_vag'].')"':$style;
									$Text = $vagsOr[$i][$i2]['ocup']==0? 'Edit':'';
									echo '
										<div class="cardx '.$typeCSS[$vagsOr[$i][$i2]['tipo']].'"'.$EditOn.'>
											'.$Text.'
										</div>
									';
								}
								echo '
										<div id="mal'.$i.'" style="display: none;"></div>
										<i class="fa-solid fa-square-plus icon" onclick="addCard(this, 1,\'#mal'.$i.'\',['.$i.','.count($vagsOr[$i]).'])"></i>
									</div>
								';
							}
							echo '
									<div id="mal" style="display: none;"></div>
									<i class="fa-solid fa-square-plus icon" onclick="addCard(this,0,\'#mal\','.count($vagsOr).')"></i>
								</div>
							';
						};
					}
				?>
			</div>
		</div>
		<div class="left" id="MenuLeft">
			<i class="fa-solid fa-xmark iconMdl" onclick="mostrar(['#frm2','#frm3','#frm1', '#MenuLeft'], 4)"></i>
			<div class="forms">
				<form class="criar" id="frm1" method="post" enctype="multipart/form-data">
					<div class="fotoInput">
						<div class="imgMostragem" id="ImgMost" style="background-image: url('imgs/perfilNoImg.png');"></div>
						<label for="InputImgEnv" class="InputImg">Foto do Local</label>
						<input type="file" name="foto" id="InputImgEnv" accept="image/*">
					</div>
					<div class="IntputsTexts" id="inputsFrmDateplus">
						<div class="InputTextIc">
							<i class="fa-solid fa-car iconInput"></i>
							<input type="text" name="Name" class="InputText" placeholder="Nome do estacionamento">
						</div>
						<div class="InputTextIc">
							<i class="fa-solid fa-map iconInput"></i>
							<input type="text" name="endereco" class="InputText" placeholder="Endereço">
						</div>
						<div class="InputTextIc">
							<i class="fa-solid fa-percent iconInput"></i>
							<input type="number" name="PrecoA" class="InputText" placeholder="porcentagem a+ na pagamento Diário" min="0" step="0.01" max="90">
						</div>
						<div class="InputTextIc">
							<i class="fa-solid fa-percent iconInput"></i>
							<input type="number" name="PrecoB" class="InputText" placeholder="porcentagem a+ no pagamento Convênio" min="0" step="0.01" max="90">
						</div>
						<div class="InputTextIc">
							<i class="fa-solid fa-percent iconInput"></i>
							<input type="number" name="PrecoC" class="InputText" placeholder="porcentagem a+ no pagamento mensal" min="0" step="0.01" max="90">
						</div>
						<div class="InputTextIc" id="BasedatePlus">
							<i class="fa-solid fa-calendar iconInput"></i>
							<input type="date" name="date0" class="InputText">
							<input type="number" name="PrecoBase0" class="InputText" placeholder="Preço Base nessa dataR$" min="0" step="0.01">
							<p class="InputLabel">Data disponivel</p>
							<i class="fa-solid fa-square-plus iconInput" onclick="AddDate(this, ['#BasedatePlus','#inputsFrmDateplus'], 0)"></i>
						</div>
					</div>
					<input type="submit" name="EnvA" class="inputEnv" value="Criar">
				</form>
				<form class="criar" id="frm2" method="post">
					<input type="number" name="Cd" id="frm2Cd" class="ocultar" value="<?php 
						if(isset($_POST['EnvB'])){
							echo $_POST['cd'];
						}else{
							echo 0;
						}
					?>">
					<input type="number" name="X" id="frm2X" class="ocultar">
					<input type="number" name="Y" id="frm2Y" class="ocultar">
					<div class="IntputsTexts">
						<div class="InputTextIc">
							<i class="fa-solid fa-dollar-sign iconInput"></i>
							<input type="number" name="Preco" class="InputText" placeholder="Preço da vaga em R$,(Preço final = esse+preçoDaData)" min="0" step="0.01">
						</div>
						<div class="InputTextIc">
							<i class="fa-solid fa-bus-simple iconInput"></i>
							<select name="tipo" class="InputText">
								<option value="0">caminhão</option>
								<option value="1">Ônibus</option>
								<option value="2">Carro</option>
								<option value="3">Van</option>
							</select>
						</div>
					</div>
					<input type="submit" name="EnvC" class="inputEnv" value="Criar">
				</form>
				<form class="ocultar" method="post">
					<input type="number" name="Cd" class="ocultar" value="<?php 
						if(isset($_POST['EnvB'])){
							echo $_POST['cd'];
						}else{
							echo 0;
						}
					?>">
					<input type="number" name="cd" id="inputB">
					<input type="submit" name="EnvD" id="submitB">
				</form>
				<form class="criar" id="frm3" method="post">
					<?php
						if(isset($_SESSION['vaga'])){
							$tipo = array('caminhão','Ônibus','Carro','Van');
							echo '
								<input type="number" name="Cd" id="frm3Cd" class="ocultar" value="'.$_SESSION['vaga']->id_esta.'">
								<input type="number" name="CdVag" id="frm3CdVag" class="ocultar" value="'.$_SESSION['vaga']->cd_vag.'">
								<label>Vaga de '.$tipo[$_SESSION['vaga']->tipo].'</label>
								<label>Vaga linha:'.$_SESSION['vaga']->ps_Y.' coluna: '.$_SESSION['vaga']->ps_X.'</label>
								<label>Preço da vaga R$'.$_SESSION['vaga']->vl_preco.'</label>
								<div class="IntputsTexts">
									<div class="InputTextIc">
										<i class="fa-solid fa-dollar-sign iconInput"></i>
										<input type="number" name="Preco" class="InputText" placeholder="Novo Preço da vaga em R$" min="0" step="0.01">
									</div>
									<div class="InputTextIc">
										<i class="fa-solid fa-bus-simple iconInput"></i>
										<select name="tipo" class="InputText">
											<option value="0"'.($_SESSION['vaga']->tipo==0?' selected':'').'>caminhão</option>
											<option value="1"'.($_SESSION['vaga']->tipo==1?' selected':'').'>Ônibus</option>
											<option value="2"'.($_SESSION['vaga']->tipo==2?' selected':'').'>Carro</option>
											<option value="3"'.($_SESSION['vaga']->tipo==3?' selected':'').'>Van</option>
										</select>
									</div>
								</div>
							';	
						}
					?>
					<input type="submit" name="EnvE" class="inputEnv" value="Atualizar">
				</form>
			</div>
		</div>
	</div>
	<script>
		$("#InputImgEnv").change(function(){
			let most = "#ImgMost";
		    PreViewImg(this, most);
		});
		$("#InputImgEnv2").change(function(){
			let most = "#ImgMost2";
		    PreViewImg(this, most);
		});
		function cadVer(){
			let dados = [
				document.querySelector('#senha').value,
				document.querySelector('#Confsenha').value,
				document.querySelector('#telefone').value
			];
			let verific = [
				dados[0]==dados[1] && dados[0].length>=5? true:false,
				dados[3].length>11 && dados[3].length<14? true:false,
			];
			let pass = verific.includes(false);
			if(pass){
				let mens = [
					verific[0]? '':'-As senhas nos inputs tem que ser iguais e com mais de 5 caracteres\n',
					verific[1]? '':'-Número de telefone invalido não segue o modelo\n',
				];
				let menFinal = mens[0]+mens[1];
				alert(menFinal);
			}else{
				let btn = document.querySelector("#verCad");
				btn.click();
			}
		}

		function FormExeculte(fun){
			let docs = [
				document.querySelector('#FrmFunCdEsta'),
				document.querySelector('#FrmFunFunction'),
				document.querySelector('#FrmFunVl'),
				document.querySelector('#FrmFunEnvFatal')
			];
			if(fun==0){
				let vl = 0;
				let lp = true;
				while(lp==true){
					vl = prompt('(Escreva um numero)Qual é procentagem que você quer para tirar do valor para todas as vagas de todos os estacionamentos? coloque em negativo se quiser aumentar o preço');
					if(!isNaN(vl)){
						lp==false;
						break;
					}
				}
				if(vl != null && vl != ""){
					docs[1].value = fun;
					docs[2].value = vl;
					docs[3].click();
				}else if(vl === null){
				}else{
					alert('Coloque uma resposta');
				}
			}
			else if(fun==1){
				let cd = 0;
				let vl = 0;
				let lp = true;
				let text = <?php
					$estas = EstacionTable();
					$text = '';
					if($estas != false){
						for ($i=0; $i<count($estas); $i++){
							$text = $text.'\n'.$estas[$i]['cd_esta'].'- para selecionar o estacionamento: '.$estas[$i]['nm_name'];
						}
						echo '"'.$text.'"';
					}else{
						echo "''";
					}
				?>;
				if(text == ''){
					alert('Crie Estacionamentos primeiro');
				}
				else{
					while(lp==true){
						cd = prompt('digite:'+text);
						if(cd != null && !isNaN(cd) && cd != ""){
							vl = prompt('(Escreva um numero)Qual é procentagem que você quer para tirar do valor para todas as vagas desse estacionamentos? coloque em negativo se quiser aumentar o preço');
							if(vl != null && !isNaN(vl) && vl != ""){
								lp==false;
								break;
							}else if(vl == "" || isNaN(vl)){
								alert('Coloque um Numero>:(!!!');
							}else if(vl === null){
								lp == false;
								break;
							}
						}else if(cd == "" || isNaN(cd)){
							alert('Coloque um Numero!!!');
						}else if(cd === null){
							lp == false;
							break;
						}
					}
					if(vl != null && cd != null){
						docs[0].value = cd;
						docs[1].value = fun;
						docs[2].value = vl;
						docs[3].click();
					}
				}
			}
			else{
				let cd = 0;
				let lp = true;
				let text = <?php
					$estas = EstacionTable();
					$text = '';
					if($estas != false){
						for ($i=0; $i<count($estas); $i++){
							$text = $text.'\n'.$estas[$i]['cd_esta'].'- para selecionar o estacionamento: '.$estas[$i]['nm_name'];
						}
						echo '"'.$text.'"';
					}else{
						echo "''";
					}
				?>;
				if(text == ''){
					alert('Crie Estacionamentos primeiro');
				}
				else{
					while(lp==true){
						cd = prompt('digite:'+text);
						if(cd != null && !isNaN(cd) && cd != ""){
								lp == false;
								break;
						}else if(cd == "" || isNaN(cd)){
							alert('Coloque um Numero!!!');
						}else if(cd === null){
							lp == false;
							break;
						}
					}
					if(cd != null){
						docs[0].value = cd;
						docs[1].value = fun;
						docs[2].value = vl;
						docs[3].click();
					}
				}
			}
		}
	</script>
<?php 
	if(isset($_POST['EnvA'])){
		$dados = array(
			$_FILES['foto'],//0
			$_POST['Name'],//1
			$_POST['endereco']//2
		);
		$dates = array(
			$_POST['PrecoA'],
			$_POST['PrecoB'],
			$_POST['PrecoC']
		);
		$a = 0;
		$lp = true;
		while($lp==true){
			$input = array('date'.$a,'PrecoBase'.$a);
			if(isset($_POST[$input[0]])){
				$dates[($a + 3)][0] = $_POST[$input[0]];//data
				$dates[($a + 3)][1] = $_POST[$input[1]];//preço base
				$a++;
			}else{
				$lp=false;
				break;
			}
		}
		if($dados[0]['tmp_name'] != ''){
			$cd = CadEsta($dados)->cd_esta;
			CadDate($dates, $cd);
			move('adm.php');
		}
	}
	if(isset($_POST['EnvC'])){
		$dados = array(
			$_POST['Cd'],//0
			$_POST['X'],//1
			$_POST['Y'],//2
			$_POST['Preco'],//3
			$_POST['tipo']//4
		);
		CadVag($dados);
		move('adm.php');
	}
	if(isset($_POST['EnvD'])){
		$dados = array(
			$_POST['Cd'],//estacionamento
			$_POST['cd']//vaga
		);
		$_SESSION['vaga'] = SearcVag($dados[1]);
		echo '
			<script>
				AbrirEstacion('.$dados[0].', ["#inputA","#submitA"]);
			</script>
		';
	}
	if(isset($_SESSION['vaga'])){
		echo '<script>
				MenuLeft(2);
			</script>';
	}
	if(isset($_POST['EnvE'])){
		$dados = array(
			$_POST['Cd'],//0
			$_POST['CdVag'],//1
			$_POST['Preco'],//2
			$_POST['tipo']//3
		);
		unset($_SESSION['vaga']);
		AtVag($dados);
		move('adm.php');
	}
	if(isset($_POST['UpdateUser'])){
		$dados = array(
			$_FILES['foto'],//0
			$_POST['nick'],//1
			Cripto($_POST['senha']),//2
			$_POST['telefone'],//3
			$_POST['endereso'],//4
			$_SESSION['user']->cd_user//5
		);
		$_SESSION['user'] = UpUser($dados);
		move('adm.php');
	}
	if(isset($_POST['EnvFatal'])){
		$docs = array(
			$_POST['CdEsta'],
			$_POST['Function'],
			$_POST['vl']
		);
		$docs[3] = $_POST['vl']<0? 0:1;
		$docs[2] = $docs[3]==0? ($docs[2]*-1):$docs[2];
		ModifyEsta($docs);
	}
	footEcho();
?>