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
	if(fun==1){
		let frml = form == '#frm1'? '#frm2':'#frm1';
		let div = document.querySelector(frml);
		div.style.display = 'none';
		divs[0].style.display = 'none';
		divs[1].style.display = 'none';
	}else{
		divs[0].style.display = 'flex';
		divs[1].style.display = 'flex';
	}
}