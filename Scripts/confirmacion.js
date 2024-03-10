function confirmacion(e) {
	if (confirm("¿Seguro que desea eliminar la cuenta?")) {
		return true;
	}else{
		e.preventDefault();
	}
}

let linkDelete = document.querySelectorAll("eliminar");
for (var i = 0; i < linkDelete.length; i++){
	linkDelete[i].addEventListener('click', confirmacion();
}