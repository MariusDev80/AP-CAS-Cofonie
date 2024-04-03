<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
	<link rel="stylesheet" href="view/design/styles.css">
	<title>Cas Cofonie</title>
</head>

<body>
	<div class="entete">
		<?php
		if (isset($_SESSION['role']) && $_SESSION['role'] !== 0) {
			echo '
			<div class="deconnexion">
				<form action="index.php?vue=deconnexion&action=deconnexion" method="post">
					<button type="submit" class="bouton">
						Se déconnecter
					</button>
				</form>
			</div>
			';
		} else {
			echo '
			<div class="connexion">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connexion">
					Se connecter
				</button>
				<div class="modal" id="connexion">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Connexion</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="index.php?vue=connexion&action=connexion&role=roleConnexion" method="post">
									<div class="mb-3">
										<label for="username" class="form-label">Nom d\'utilisateur</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="Entrez votre nom d\'utilisateur" required>
									</div>
									<div class="mb-3">
										<label for="password" class="form-label">Mot de passe</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
									</div>
									<div class="modal-footer">
									<h5>Sélectionner votre rôle</h5>
									<div class="form-group">
            							<select class="form-control" name="roleConnexion" id="roleConnexion">
            							<option value="1">Secrétaire</option>
            							<option value="2">Greffier</option>
            							<option value="3">Citoyen</option>
            							<option value="4">Monarque</option>
										<option value="10">Administrateur</option>
            							</select>
									</div>
  										
									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#signup">
									Créer un compte
										</button>
										<button type="submit" class="btn btn-primary">Connexion</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
			';
		}
		?>
		<div class="signup">
			<div class="modal" id="signup">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Créer un compte</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form action="index.php?vue=signup&action=signup" method="post">
								<div class="mb-3">
									<label for="username" class="form-label">Nom d'utilisateur</label>
									<input type="text" class="form-control" id="username" name="signupUsername"
										placeholder="Entrez votre nom d'utilisateur" required>
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Mot de passe</label>
									<input type="password" class="form-control" id="password" name="signupPassword"
										placeholder="Entrez votre mot de passe" required>
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Confirmer le mot de passe</label>
									<input type="password" class="form-control" id="password" name="confirmPassword"
										placeholder="Confirmer votre mot de passe" required>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Créer un compte</button>
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
			<font face="helvetica">Cas Cofonie</font>
		</h1>
	</div>
	<div class="sidebar">