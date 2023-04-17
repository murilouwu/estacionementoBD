//ocultar lista de div
function mostrar(ocu, chave){

	//loop de ocultamento
	for (var i=0; i<ocu.length; i++){
		
		//enquanto i for menor que a chave
		if (i<chave){
			//oculta
			ocultar(ocu[i], 0);	
		}else{
			//mostra
			ocultar(ocu[i], 1);
		};

	};
};

//ocultar one div
function ocultar(obj, es){
	
	//pegar a div
	let div = document.querySelector(obj);
	
	//verificar se quer se ocultado
	if(es==1){
		//mostrar
		div.style.display = 'flex';
	}else{
		//ocultar
		div.style.display = 'none';
	};
};

function iconMod(btn, id, fun){
	let div = document.querySelector(id);
	if(fun==0){
		div.style.display = 'flex';
	}else{
		div.style.display = 'none';
	}
	var funMod = fun==0? 1:0;
	let onclick = "iconMod(this, '"+id+"', "+funMod+")";
	btn.setAttribute("onclick", onclick);
	btn.className = fun==0? "fa-solid fa-xmark icon":"fa-solid fa-bars icon";
}

function subir(){
	document.querySelector('#sistem').scrollTo(0, 0);
}

function Modal(modal, form, fun){
	let divs = [
		document.querySelector(modal),
		document.querySelector(form)
	];
	let blocks = [
		document.querySelector('#sistem'),
		document.querySelector('#irTop')
	];
	if(fun==1){
		let frml = form == '#frm1'? '#frm2':'#frm1';
		let div = document.querySelector(frml);
		div.style.display = 'none';
		divs[0].style.display = 'none';
		divs[1].style.display = 'none';
		blocks[0].style.overflowY = 'overlay';
		blocks[1].style.display = 'flex';
	}else{
		divs[0].style.display = 'flex';
		divs[1].style.display = 'flex';
		blocks[0].style.overflowY = 'hidden';
		blocks[0].scrollTo(0, 0);
		blocks[1].style.display = 'none';
	}
}

function formOpen(id, id2){
	let frms = [
		document.querySelector(id),
		document.querySelector(id2)
	];
	frms[0].style.display = 'flex';
	frms[1].style.display = 'none';
}

function PreViewImg(input, imgPreview){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(imgPreview).attr('style', "background-image: url('"+e.target.result+"');");
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function VerData(dt, fun){
	//variaveis gerais
		//idade
		let idadeMini = 5;
		let idadeMin = 17;
		let idadeMax = 65;
		let morto = 100;
	//função zero verifica data de nascimento humano
	if(fun==0 || fun==1){
		//tempo atual
		const DateNow = Date.now();
		const dateNow = new Date(DateNow);
		const today = dateNow.toLocaleDateString();
		let [day, month, year] = today.split('/');
		let dateNowAtl = "'"+year+"-"+month+"-"+day+"'";

		//verificando data
		const calc   = new Date(dateNowAtl) - new Date(dt);
		const idade = Math.trunc(calc / (1000 * 60 * 60 * 24 * 30 * 12));

		if(fun==0){
			let result = idade<idadeMax && idade>idadeMin? true:false;
			return result;
		}else{
			let pMens =[
				'Data invalida, Obviamente você não pode ter nascido no futuro',
				'Data invalida, com '+idade+' anos, Você não conseguiria acessar esse site',
				'Data invalida, com '+idade+' anos, Acho dificil ser Real',
				'Data invalida, com '+idade+' anos, Um morto não estária aqui!',
			];
			let result = idade<0?pMens[0]:(idade<idadeMini?pMens[1]:(idade<idadeMax?'':(idade<morto?pMens[2]:pMens[3])));
			return result;
		}
	}
}
function red(page){
	window.location = page;
}

function MenuLeft(fun){
	let pos = [
		['#frm2','#frm3','#frm1', '#MenuLeft'],
		['#frm1','#frm3','#frm2', '#MenuLeft'],
		['#frm1','#frm2','#frm3', '#MenuLeft']
	];
	mostrar(pos[fun], 2);
}

function AbrirEstacion(cd, obj){
	let div = [
		document.querySelector(obj[0]),//input
		document.querySelector(obj[1])//submit
	];
	div[0].value = cd;
	div[1].click();
}

function addCard(bt, fun, div, lat){
	let esp = document.querySelector(div);
	if(fun == 0){
		esp.outerHTML = `
			<div class="linhay">
				<div id="mal`+lat+`" style="display: none;"></div>
				<i class="fa-solid fa-square-plus icon" onclick="addCard(this, 1,'#mal`+lat+`',[`+lat+`, 0])"></i>
			</div>
			<div id="mal" style="display: none;"></div>
		`;
		bt.setAttribute("onclick", "addCard(this,0,'#mal',"+(lat+1)+")"); 
	}else{
		esp.outerHTML = `
			<div class="cardx onclock" onclick="editVaga(`+lat[0]+`, `+lat[1]+`)">
				Criar
			</div>
			<div id="mal`+lat[0]+`" style="display: none;"></div>
		`;
		bt.setAttribute("onclick", "addCard(this, 1,'#mal"+lat[0]+"',["+lat[0]+", "+(lat[1]+1)+"])");
	}
}

function editVaga(y, x){
	MenuLeft(1);
	let divs = [
		document.querySelector('#frm2X'),
		document.querySelector('#frm2Y')
	];
	divs[0].value = x;
	divs[1].value = y;
}

function editVaga2(cd){
	let formInput = document.querySelector('#inputB');
	let formClick = document.querySelector('#submitB');
	formInput.value = cd;
	formClick.click();
}

function AddDate(icon, divs, at){
	let limit = 5;
	let sps = [
		document.querySelector(divs[0]),
		document.querySelector(divs[1])
	];
	sps[0].outerHTML = `
		<div class="InputTextIc">
			<i class="fa-solid fa-calendar iconInput"></i>
			<input type="date" name="date`+at+`" class="InputText">
			<input type="number" name="PrecoBase`+at+`" class="InputText" placeholder="Preço Base desse dia em R$" min="0" step="0.01">
			<label class="InputLabel">Data disponivel</label>
		</div>
	`;
	at += 1;
	if(at<limit){
		sps[1].innerHTML += `
			<div class="InputTextIc" id="BasedatePlus">
				<i class="fa-solid fa-calendar iconInput"></i>
				<input type="date" name="date`+at+`" class="InputText">
				<input type="number" name="PrecoBase`+at+`" class="InputText" placeholder="Preço Base desse dia em R$" min="0" step="0.01">
				<label class="InputLabel">Data disponivel</label>
				<i class="fa-solid fa-square-plus iconInput" onclick="AddDate(this, ['#BasedatePlus','#inputsFrmDateplus'], `+at+`)"></i>
			</div>
		`; 
		icon.outerHTML = "";
	}else{
		alert(limit+' dias tá bom já!!!');
	}
}