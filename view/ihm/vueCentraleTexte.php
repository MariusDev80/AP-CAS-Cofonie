<?php
include_once('autoload.php');
	class vueCentraleTexte
	{
		public function __construct()
		{

		}

		public function visualiserTextes($lesTextes)
		{
			// conteneur des texte, articles et amendements
			// pour chaque texte, faire un menu en cascade avec les articles et les amendements
			echo '<ul class="textes">';
			foreach($lesTextes as $unTexte) {
				$lesArticles = $unTexte->__get('lesArticles')->__get('lesArticles');
				echo '<li>';
				$unTexte->afficheTexte();
				echo '<ul class="articles">';
				foreach($lesArticles as $unArticle){
					echo'<li>';
					$unArticle->afficheArticle();
					if ($unArticle->__get('lesAmendements')->nbAmendement() != 0){
						$lesAmendements = $unArticle->__get('lesAmendements')->__get('lesAmendements');
						echo'<ul class="amendements">';
						foreach($lesAmendements as $unAmendement){
							echo '<li>';
							$unAmendement->afficheAmendement();
							echo '</li>';
						}
						echo '</ul>';
					}
					echo '</li>';
				}
				echo '</ul>';
				echo '</li>';
			}
			echo'</ul>';
		}

		public function ajouterTextes(conteneurInstitution $lesInstitutions)
		{
			echo '<div class="saisie"><form action="index.php?vue=texte&action=saisirArticle" method="post">
			<div class="input-group flex-nowrap inputs">
			<span class="input-group-text" id="addon-wrapping">Titre Texte</span>
			<input type="text" name="titreTexte" class="form-control" placeholder="TitreTexte" aria-label="TitreTexte" aria-describedby="addon-wrapping">
		  	</div>
			<div class="input-group flex-nowrap inputs">
			<span class="input-group-text" id="addon-wrapping">Institution</span>
			<input list="institution" name="institution" class="form-control" placeholder="Institution" aria-label="Institution" aria-describedby="addon-wrapping">
			</div>
			<datalist id="institution">';
			foreach ($lesInstitutions->__get("lesInstitutions") as $uneInstitution){
				$idInstitution = $uneInstitution->__get('idInstitution');
				$libelleInstitution = $uneInstitution->__get('libelleInstitution');
				echo "<option value='".$idInstitution."'>".$libelleInstitution."</option>";
			}
			echo '</datalist>';

			echo '<div class="input-group flex-nowrap inputs">
			<span class="input-group-text" id="addon-wrapping">Nombre Articles</span>
			<input type="number" name="nbArticles" class="form-control" placeholder="Nombre Articles" aria-label="Nombre Articles" aria-describedby="addon-wrapping" min="1" max="100">
			</div>
			<div class="col-12 bouton">
    		<input type="submit" class="btn btn-primary" value="Valider"/>
			</div>';
			echo '</div>';
		}

		public function ajouterArticles($titreTexte,$nbArticles,$idTexte){
			echo '<div class="saisie">';
			echo "<h3>$titreTexte</h3>";
			echo '<form action="index.php?vue=texte&action=ajout" method="post">';
			$cpt = 1;
			while ($cpt <= $nbArticles){
				echo "
				<label for='titre$cpt'>Article $cpt</label>
				<div class='input-group flex-nowrap inputs'>
  				<span class='input-group-text' id='addon-wrapping'>Titre</span>
				<input type='text' id='titre$cpt' name='titre$cpt' class='form-control' placeholder='Titre' aria-label='Titre' aria-describedby='addon-wrapping'>
				</div>";
				echo "<div class='mb-3'>
  				<textarea class='form-control' name='article$cpt' id='textbox$cpt' rows='3'></textarea>
				</div>";
				$cpt++;
			}
			$cpt-=1;
			echo "<input type='hidden' name='idTexte' value='$idTexte'/><input type='hidden' name='cpt' value='$cpt'/>
			<div class='col-12 bouton'>
    		<input type='submit' class='btn btn-primary' value='Valider'/>
			</div>";
			echo '</form></div>';
		}

		public function validation($idTexte, conteneurTexte $lesTextes){
			echo "<div class='validate'>
				<div class='row1'>
                <h3>Voulez vous valider l'ajout du texte ?</h3>
				</div>
				<div class='row2'>
				<form action='index.php?vue=texte&action=validation' method='post'>
					<div class='buttons'>
					<input type='submit' class='btn btn-primary' value='Valider' name='choix'></input>
					<input type='submit' class='btn btn-danger' value='Annuler' name='choix'></input>
					<input type='hidden' value=$idTexte name='idTexte'/>
					</div>
				</div>";
			echo"</div></div>";
		}
}
?>