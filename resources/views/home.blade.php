<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<title>Formulario</title>
	<style>
		.redText{
			color: red;
		}
		.btnPurple{background-color: purple;color: white;}
	</style>
</head>
<body>
	<div class="container">
		<header>
			
		</header>
		<main>
			<br>
			<form action="" style="" id="clientForm" method="POST">
				<div class="row">

					<div class="row mb-5">
						<div class="d-flex bd-highlight mb-3">
						  <div class="me-auto p-2 bd-highlight"><h3>Cliente</h3></div>
						  <div class="p-2 bd-highlight"></div>
						  <div class="p-2 bd-highlight"><button class="btn btnPurple">Guardar</button></div>
						</div>
					</div>
					<div class="col-12">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<div class="col-6">
										<label for="selectTipo" class="form-label">Tipo</label>
										<select name="" id="selectTipo" class="form-select">
											<option value="dni">DNI</option>
											<option value="ruc">RUC</option>
											<option value="ce">CE</option>
											<option value="pas">PASAPORTE</option>
										</select>
									</div>
									<div class="col-6">
										<label for="valorDocumento" class="form-label"><span class="redText">*Número de Documento</span></label>
										<input type="text" class="form-control" id="valorDocumento">
									</div>
								</div>
							</div>
							<div class="col-6">
								<label for="valorDocumento" class="form-label"><span>&nbsp;</span></label><br>
								<button type="button" class="btn btnPurple" onclick="BuscarenSunat()">Buscar en SUNAT</button>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<br>
								<label for="valorNombre" class="form-label"><span class="redText">*Nombres y Apellidos</span></label>
								<input type="text" class="form-control" id="valorNombre">
							</div>
							<div class="col-6">
								<br>
								<label for="valorAlias" class="form-label"><span class="redText">*Mostrar nombre como (Alias)</span></label>
								<input type="text" class="form-control" id="valorAlias">
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<br>
								<label for="valorDireccion" class="form-label"><span class="redText">*Dirección</span></label>
								<input type="text" class="form-control" id="valorDireccion">
							</div>
							<div class="col-6">
								<br>
								<label for="valorUbigeo" class="form-label">Ubigeo(Distrito)</label>
								<input type="text" class="form-control" id="valorUbigeo">
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<br>
								<label for="valorEmail" class="form-label">Email</label>
								<input type="text" class="form-control" id="valorEmail">
							</div>
							<div class="col-6">
								<div class="row">
									<div class="col-6">
										<br>
										<label for="valorDocumento" class="form-label">Teléfono Móvil</label>
										<input type="text" class="form-control" id="valorDocumento">
									</div>
									<div class="col-6">
										<br>
										<label for="valorDocumento" class="form-label">Teléfono Fijo</label>
										<input type="text" class="form-control" id="valorDocumento">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</main>
		<footer>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
			<script>
				const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
				var isValid = true;
				var tipoDoc;
				var valorDoc;
				var route = "{{ url('datos') }}";

				function EnviarConsulta(){

						var dataSend = {tipoDoc:tipoDoc, valorDoc:valorDoc};
						 fetch(route, {
						         method: 'post',
						         body: JSON.stringify(dataSend),
						         headers: {
						             'Content-Type': 'application/json',
						             "X-CSRF-Token": csrfToken
						         }
						     })
						     .then(response => response.json())
						     .then(data => {
						     	//console.log(data);
						     	if (!data.error) {
						     		Swal.fire(
						     		  'Bien Hecho!',
						     		  'Los datos se llenaron automaticamente!',
						     		  'success'
						     		);
						     		var inputNombre = document.getElementById("valorNombre");
						     		var valorDireccion = document.getElementById("valorDireccion");
						     		var valorUbigeo = document.getElementById("valorUbigeo");
						     		inputNombre.value = data.razon;
						     		valorDireccion.value = data.direccion;
						     		valorUbigeo.value = data.distrito;

						     	}else{
						     		Swal.fire(
						     		  'Error!',
						     		  'No se encontraron datos para este documento',
						     		  'error'
						     		)
						     	}
						     });
				}

				function BuscarenSunat(){

					isValid = true;
					tipoDoc = document.getElementById("selectTipo").value;
					valorDoc = document.getElementById("valorDocumento").value;
					if (tipoDoc == "dni" &&  valorDoc.length != 8) {
						isValid = false;
					}else if(tipoDoc == "ce" && valorDoc.length != 12){
						isValid = false;
					}
					else if(tipoDoc == "ruc" && valorDoc.length != 11){
						isValid = false;
					}else if(tipoDoc == "pas" && valorDoc.length != 12){
						isValid = false;
					}
					else{
					}

					if (isValid) {
						EnviarConsulta();
						
					}else{
						Swal.fire(
						  'Error!',
						  'Ingresa los datos correctamente',
						  'error'
						)
					}
				}
			</script>
		</footer>
	</div>

	
</body>
</html>