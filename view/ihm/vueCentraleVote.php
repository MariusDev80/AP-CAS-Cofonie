<?php

include_once("autoload.php");

class vueCentraleVote{


    public function __construct(){}

    public function choisirVote(conteneurTexte $lesTextes){
        
        echo "<form method=\"post\" action=index.php?vue=vote&action=visualiserVote>
                <label for=\"text-select\">Choisir un texte :</label>
                <select name=\"texte\" id=\"text-select\">
                    <option value=1 selected>--Choisir un Texte--</option>";
        foreach ($lesTextes->__get('lesTextes') as $unTexte){
            $id = $unTexte->__get("idTexte");
            echo "<option value=\"$id\">$id- Titre texte $id</option>";
        }
        echo   "</select>
                <input type=\"submit\" value=\"Valider\">
              </form>";
    }

    public function visualiserVote(metierTexte $unTexte, conteneurVote $lesVotes,$numTexte){

        echo '<ul class="textes">';
		$lesArticles = $unTexte->__get('lesArticles')->__get('lesArticles');
		echo '<li>';
		$unTexte->afficheTexte();
		echo '<ul class="articles">';
		foreach($lesArticles as $unArticle){
			echo'<li>';
			$unArticle->afficheArticle();
			$cptAm = 0;
			foreach ($lesVotes->__get("lesVotes") as $unVote){
				if ($unVote->__get("idTexte") == $numTexte && $unVote->__get("lArticle") == $unArticle->__get("codeSeqArticle")){
					$lesAmendements = $unArticle->__get('lesAmendements')->__get('lesAmendements');
					if ($unVote->__get("amendement")==true){
						$unVote->afficheVote();
						echo'<ul class="amendements">';
						echo '<li>';
						$lesAmendements[$cptAm]->afficheAmendement();
						echo '</li>';
						echo '</ul>';
					}
					else{
						$unVote->afficheVote();
					}
				}
			}
			echo '</li>';
		}
		echo '</ul>';
		echo '</li>';
		echo'</ul>';
    }
}

?>