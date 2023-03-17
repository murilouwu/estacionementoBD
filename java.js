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
