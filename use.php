<?php 
	session_start();
	include('config.php');
	HeaderEcho('User','css/Fun.css','imgs/logo.png');
	if(isset($_SESSION['user'])){
		if($_SESSION['user']->sl_adm == 1){
			move('adm.php');
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
				<a href="https://www.facebook.com/murilo.gimenez.7543" class="menuA"><i class="fa-brands fa-facebook linkA"></i>FACEBOOK</a>
				<a href="https://twitter.com/v43410730" class="menuA"><i class="fa-brands fa-twitter linkA"></i>TWITTER</a>
				<a href="https://www.youtube.com/channel/UC5j326FDOeG70i3KixHsTSw" class="menuA"><i class="fa-brands fa-youtube linkA"></i>CANAL</a>
				<a href="https://github.com/murilouwu/estacionementoBD" class="menuA"><i class="fa-brands fa-github linkA"></i>PROJETO</a>
			</div>	
		</div>
		<div class="main">
			<?php
				$estas = EstacionTable();
				if($estas == false){
					echo '
						<div class="Plus">
							<label class="lbPlus">Nao Ha Estacionamentos Disponiveis</label>
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
									<div class="Telao">Telao(Sem Vagas no momento)</div>
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
									$style = '';
									if($user != false){
										$style = 'style="background-image: url(\''.$user->img.'\');"';
									}
									$EditOn = $vagsOr[$i][$i2]['ocup']==0? ' onclick="editVaga2('.$vagsOr[$i][$i2]['cd_vag'].')"':$style;
									$Text = $vagsOr[$i][$i2]['ocup']==0? 'Ocup':'';
									$tipo = $vagsOr[$i][$i2]['ocup']==0? $typeCSS[$vagsOr[$i][$i2]['tipo']]:'user';
									echo '
										<div class="cardx '.$tipo.'"'.$EditOn.'>
											'.$Text.'
										</div>
									';
								}
								echo '
									</div>
								';
							}
							echo '
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
				</form>
				<form class="criar" id="frm2" method="post">
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
							$datas = datasEsta($_SESSION['vaga']->id_esta);
							$textCheck = '';
							for($i=0; $i<count($datas); $i++){
								$textCheck = $textCheck.'
									<div class="check"><input type="checkbox" value="'.$datas[$i]['cd_data'].'" id="frmcheck'.$datas[$i]['cd_data'].'" name="check'.$i.'">'.$datas[$i]['dt_disp'].'</div>
								';
							}
							$textValuePrice = 'let pcForDate = [';
							for($i=0; $i<count($datas); $i++){
								$virg= $i==0? '':',';
								$textValuePrice = $textValuePrice.$virg.'
								['.$datas[$i]['cd_data'].','.$datas[$i]['vl_dia'].','.$datas[$i]['vl_con'].','.$datas[$i]['vl_men'].']';
							}
							$textValuePrice = $textValuePrice.'];';
							echo '
								<input type="number" name="CdUser" class="ocultar" value="'.$_SESSION['user']->cd_user.'">
								<input type="number" name="Cd" id="frm3Cd" class="ocultar" value="'.$_SESSION['vaga']->id_esta.'">
								<input type="number" name="CdVag" id="frm3CdVag" class="ocultar" value="'.$_SESSION['vaga']->cd_vag.'">
								<input type="number" name="precoFinal" id="frm3precoFinal" class="ocultar" value="'.$_SESSION['vaga']->vl_preco.'" step="0.01">
								<label>Vaga de '.$tipo[$_SESSION['vaga']->tipo].'</label>
								<label id="precofrmPag">Preço da vaga R$'.$_SESSION['vaga']->vl_preco.'</label>
								<label>Data Que verá o filme:</label>
								<div class="InputTextIc" id="DatasFrmPag">
									<i class="fa-solid fa-bus-simple iconInput"></i>
									<div class="checklist">
										'.$textCheck.'
									</div>
								</div>
								<label>Pagamento:</label>
								<div class="InputTextIc">
									<i class="fa-solid fa-bus-simple iconInput"></i>
									<select name="tipo" class="InputText" id="selectPag">
										<option value="0">pagar para ficar o dia inteiro(Diária)</option>
										<option value="1">Pagar Convenio(1h a mais que o tempo do filme)</option>
										<option value="2">pagar para ficar o Mês(Mensal)</option>
									</select>
								</div>
								<script>
									let precoBase = '.$_SESSION['vaga']->vl_preco.';
									'.$textValuePrice.'
									$("#selectPag").change(()=>{
										let vlFinal = 0;
										let selDiv = document.querySelector("#selectPag");
										let select = parseFloat(selDiv.value);
										for(let i=0; i<pcForDate.length; i++){
											let name = "#frmcheck"+pcForDate[i][0];
											let check = document.querySelector(name);
											if(check.checked){
												vlFinal += pcForDate[i][(select+1)];
											};
										}
										let res = (Math.round((precoBase + vlFinal)*100)/100);
										let label = document.querySelector("#precofrmPag");
										let input = document.querySelector("#frm3precoFinal");
										label.innerHTML = "Preço da vaga R$"+res;
										input.value = res;
									});
								</script>
							';	
						}
					?>
					<input type="submit" name="EnvE" class="inputEnv" value="Pagar">
				</form>
			</div>
		</div>
	</div>
	<script>
		$("#InputImgEnv2").change(()=>{
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
	</script>
<?php
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
			$_POST['CdUser'],//0
			$_POST['Cd'],//1
			$_POST['CdVag'],//2
			$_POST['precoFinal'],//3
			$_POST['tipo'],//4
		);
		$dates = array();
		$a = 0;
		$b = 0;
		while($b<QtDtasEsta($dados[1])->qt){
			$input = 'check'.$b;
			if(isset($_POST[$input])){
				$dates[$b] = $_POST[$input];
				$b++;
			}
			$a++;
		}
		ComprarUser($dados, $dates);
		unset($_SESSION['vaga']);
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
	footEcho();
?>