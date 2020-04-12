let comprobar = Array("F", "F", "F","F");
//Nombre correo password titulacion
console.log(comprobar);
window.addEventListener("load", function () {
	let Nombre = document.getElementById('Nombre');
	let correo = document.getElementById("correo");
	let password = document.getElementById("password");
	let titulacion = document.getElementById("titulacion");

	password.addEventListener("blur",comprobar_password);
	Nombre.addEventListener("blur", comprobar_nombre);
	titulacion.addEventListener("blur",comprobar_titulacion);
	correo.addEventListener("blur", comprobar_correo);


	let boton = document.getElementById('boton');
	boton.addEventListener("click", comprobar_boton_form);

});

//Titulo
function comprobar_titulacion() {
	if (document.getElementById('titulacion').value == 'Seleccione si posee algun titulo...') {
		document.getElementById("Titulacion").innerHTML = "RELLENA EL CAMPO";
		comprobar[3] = "F";
	} else {
		document.getElementById("Titulacion").innerHTML = "&#10004";
		comprobar[3] = "V";
		llamarAjax('', gParTitulacion(), '', 'F_Error', 'post', 0);
	}
}

function gParTitulacion() {
	return "titulacion=" + document.getElementById('titulacion').value;
}

//password
function comprobar_password() {
	if (document.getElementById('password').value == '') {
		document.getElementById("Password").innerHTML = "RELLENA EL CAMPO";
		comprobar[2] = "F";
	} else {
		document.getElementById("Password").innerHTML = "&#10004";
		comprobar[2] = "V";
		llamarAjax('', gParPassword(), '', 'F_Error', 'post', 0);
	}
}
function gParPassword() {
	return "password=" + document.getElementById('password').value;
}
//alta
function comprobar_boton_form() {
	let correcto = true;
	console.log(comprobar);
	for (i = 0; i < comprobar.length; i++) {
		if (comprobar[i] == "F") correcto = false;
	}
	if (correcto) llamarAjax('alta_voluntarios.php', gParAlta(), 'cBAlta', 'F_Error', 'post', 0);
	else alert("comprueba los datos");
}

function gParAlta() {
	return "Nombre=" + document.getElementById('Nombre').value +
		"&correo=" + document.getElementById('correo').value +
		"&titulacion="+ document.getElementById('titulacion').value +
		"&password=" + document.getElementById('password').value;
}

function cBAlta(resultado) {
	let datos = JSON.parse(resultado);
	
	if (datos.alta == true) {	

		for (let i = 0; i < comprobar.length; i++) {
			comprobar[i] = "F";
		}
		window.location.replace("usuario_correcto_admin.php");
	} else {
		p.style.color = "red";
		p.innerHTML = "ERRORE";

	}
}

//comprobar correo
function comprobar_correo() {
	if (document.getElementById('correo').value == '') {
		document.getElementById("Correo").innerHTML = "RELLENA EL CAMPO";

	} else if (validarEmail(document.getElementById('correo').value) == false) {
		document.getElementById("Correo").innerHTML = "correo incorrecto";

	} else {
		llamarAjax('comprobar_correo.php', gParCorreo(), 'cBCorreo', 'F_Error', 'post', 0);
	}
}

function validarEmail(correo) {
	var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(correo) ? true : false;

}


function gParCorreo() {
	return "correo=" + document.getElementById('correo').value;
}

function cBCorreo(resultado) {
	let datos = JSON.parse(resultado);

	let p = document.getElementById("Correo");
	p.innerHTML = datos.encontrado;

	if (datos.encontrado == true) {
		p.style.color = "red";
		p.innerHTML = "CORREO REPETIDO";
		comprobar[1] = "F";
	} else {
		p.style.color = "green";
		p.innerHTML = "&#10004";
		comprobar[1] = "V";

	}
}



//comprobar nombre
function comprobar_nombre() {
	if (document.getElementById('Nombre').value == '') {
		document.getElementById("nombre").innerHTML = "RELLENA EL CAMPO";
		comprobar[0] = "F";
	} else if (!isNaN(document.getElementById('Nombre').value)) {
		document.getElementById("nombre").innerHTML = "Solo letras y espacios";
		comprobar[0] = "F";
	} else {
		document.getElementById("nombre").innerHTML = "  &#10004";
		comprobar[0] = "V";
		llamarAjax('', gParNOMBRE(), '', 'F_Error', 'post', 0);
	}
}

function gParNOMBRE() {
	return "Nombre=" + document.getElementById('Nombre').value;
}





