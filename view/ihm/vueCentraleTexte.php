<?php
include_once('autoload.php');
	class vueCentraleTexte
	{
		public function __construct()
		{

		}

		public function visualiserTextes($lesTextes,$art)
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
					if ($unArticle->__get('lesAmendements') != NULL){
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

		public function ajouterTextes()
		{
			echo "<BR>je suis dans l'ajout d'un texte";
		}
}
?>