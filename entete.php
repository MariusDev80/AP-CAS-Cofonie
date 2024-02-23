<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
	<link rel="stylesheet" href="view/design/styles.css">
	<title>Document</title>
</head>

<body>
	<div class="entete">
		<div class="connexion">
			<!-- Button to trigger the modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				Se connecter
			</button>

			<!-- The Modal -->
			<div class="modal" id="myModal">
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Connexion</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal Body -->
						<div class="modal-body">
							<!-- Form with action attribute -->
							<form action="tool/accesBD.php" method="post">
								<!-- Input field for username -->
								<div class="mb-3">
									<label for="username" class="form-label">Nom d'utilisateur</label>
									<input type="text" class="form-control" id="username" name="username"
										placeholder="Entrez votre nom d'utilisateur" required>
								</div>


								<!-- Input field for password -->
								<div class="mb-3">
									<label for="password" class="form-label">Mot de passe</label>
									<input type="password" class="form-control" id="password" name="password"
										placeholder="Entrez votre mot de passe" required>
								</div>


								<!-- Modal Footer -->
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Connexion</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>



		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<h1>
			<font face="helvetica">Cas Cofonies</font>
		</h1>
	</div>
	<div class="sidebar">