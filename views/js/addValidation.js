function setRadioValue(inputId) //Activa o desactiva los radiobutton segun si hay una entrada en su input
{
	var contenido = document.getElementById(inputId).value;
	if (!!(contenido.trim())) {
		document.getElementById(inputId+'R').style.display = 'inline';
		document.getElementById(inputId+'R').value = contenido;				
	}else{
		document.getElementById(inputId+'R').style.display = 'none';
		document.getElementById(inputId+'R').checked = false;
	}
}//setRadioValue

function onCheckRadio(radioId){
	var contenido = document.getElementById(radioId.slice(0,1)).value;
	if (!!(contenido.trim())) {
		document.getElementById(radioId).value = contenido;				
	}else{
		document.getElementById(radioId).checked = false;
	}
}//onCheckRadio

function imageValidation() // Valida el tipo de archivo y el tamaño de la imagen 
{
	var fileInput = document.getElementById('imgFile');
	var filePath = fileInput.value;
	var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
	var fileSize = fileInput.files[0].size;

	if(!allowedExtensions.exec(filePath)){
		alert('Solo se permiten archivos JPG, JPEG y PNG');
		fileInput.value = '';
		document.getElementById('imagePreview').innerHTML = null;
		return false;
	}else if(fileSize > (1014*700))
	{
		alert('La imagen no debe ser mayor a 650 KB');
		fileInput.value = '';
		document.getElementById('imagePreview').innerHTML = null;
		return false;
	}else
	{
		//Muestra imagen previa
		if (fileInput.files && fileInput.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('imagePreview').src = e.target.result;

			};
			reader.readAsDataURL(fileInput.files[0]);
		}
	}
}//imageValidation

function imageValidationEdit() // Valida el tipo de archivo y el tamaño de la imagen 
{
	var fileInput = document.getElementById('imgFile');
	var filePath = fileInput.value;
	var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
	var fileSize = fileInput.files[0].size;

	if(!allowedExtensions.exec(filePath)){
		alert('Solo se permiten archivos JPG, JPEG y PNG');
		fileInput.value = '';
		document.getElementById('imagePreview').innerHTML = null;
		return false;
	}else if(fileSize > (1014*700))
	{
		alert('La imagen no debe ser mayor a 650 KB');
		fileInput.value = '';
		document.getElementById('imagePreview').innerHTML = null;
		return false;
	}else
	{
		//Muestra imagen previa
		if (fileInput.files && fileInput.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('checkImage').checked = false;
				document.getElementById('imagePreview').style.display = 'block';	
				document.getElementById('imagePreview').src = e.target.result;

			};
			reader.readAsDataURL(fileInput.files[0]);
		}
	}
}//imageValidation

function eraseImage(id){
	var check = document.getElementById('checkImage');
	var fileInput = document.getElementById('imgFile');
	var img = document.getElementById('imagePreview');
	if(check.checked == false)
	{
		img.src = '../app/loadImage.php?id='+id;
		img.style.display = 'block';				
	}else
	{
		document.getElementById('imagePreview').style.display = 'none';
		fileInput.value = '';
		alert('Si seleccionas la casilla la pregunta quedará sin imagen')		
	}
}


function beforeSubmit() // valida que las respuestas tengan un formato correcto antes de enviar el formulario
{
	var validacion;
	var opcA = document.getElementById('a').value;
	var opcB = document.getElementById('b').value;
	var opcC = document.getElementById('c').value;
	var opcD = document.getElementById('d').value;

	if(opcA.trim() != "" && opcB.trim() != "") //evaluar si hay al menos dos respuestas llenas, en caso de que haya mas de dos (3-4) entra a algun if por default
	{
		validacion = true;
	}else if(opcA.trim() != "" && opcC.trim() != ""){
		validacion = true;
	}else if(opcA.trim() != "" && opcD.trim() != ""){
		validacion = true;
	}else if(opcB.trim() != "" && opcC.trim() != ""){
		validacion = true;
	}else if(opcB.trim() != "" && opcD.trim() != ""){
		validacion = true;
	}else if (opcC.trim() != "" && opcD.trim() != ""){
		validacion = true;
	}else{
		alert('debe llenar al menos dos opciones');
		validacion = false;
	}

	if(validacion) //si hay mas de una respuesta
	{
		if(	(opcA.trim() != opcB.trim()) && 
		(opcA.trim() != opcC.trim()) && 
		(opcA.trim() != opcD.trim()) && 
		(opcB.trim() != opcC.trim()) && 
		(opcB.trim() != opcD.trim()) && 
		(opcC.trim() != opcD.trim())  ) //evalua que no haya dos respuestas iguales cuando se envias 3-4 respuestas
		{
			validacion = true;
		}
		else // si se envian dos respuestas
		{
			//Hay que evaluar cuando solo hay dos respuestas, que sean diferentes y que las otras dos esten vacias
			if( (opcA.trim() != opcB.trim()) && 
				!(opcC.trim()) && !(opcD.trim()) ) //si a!=b y c-d vacias
			{
				validacion = true;
			}else if( (opcA.trim() != opcC.trim()) &&
					  !(opcB.trim()) && !(opcD.trim()) ) //si A!=C y B-d vacias
			{
				validacion = true;
			}else if( (opcA.trim() != opcD.trim()) &&
					  !(opcB.trim()) && !(opcC.trim()) ) //si A!=D y B-C vacias
			{
				validacion = true;
			}else if( (opcB.trim() != opcC.trim()) &&
					  !(opcA.trim()) && !(opcD.trim()) )//si B!=C y A-D vacias
			{
				validacion = true;
			}else if( (opcB.trim() != opcD.trim()) &&
					  !(opcA.trim()) && !(opcC.trim()) )//si B!=D y A-C vacias
			{
				validacion = true;
			}else if( (opcC.trim() != opcD.trim()) &&
					  !(opcA.trim()) && !(opcB.trim()) )//si C!=D y A-B vacias
			{
				validacion = true;
			}else{
				alert('No puede tener dos respuestas iguales');
				validacion = false;
			}

		}
	} //fin if si hay mas de una respuesta
	
	return validacion;
}//beforeSubmit