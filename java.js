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