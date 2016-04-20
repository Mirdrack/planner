<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>::Planner::</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Planner</h1>
		<form class="col s12" action="plan.php" method="POST">
  			<div class="row">
    			<div class="input-field col s6">
      				<input id="number" name="number" type="text" class="validate">
      				<label for="number">Número de invitados</label>
				</div>
			</div>
			<div class="row">
				<button class="btn waves-effect waves-light" type="submit" name="action">Enviar
				    <i class="material-icons right">send</i>
				</button>
			</div>
		</form>
  	</div>
</body>
</html>