<?php
include_once('autoload.php');
class metierArticle {

    private conteneurAmendement $lesAmendements;
    private conteneurArticle $lesArticlesDeReference;
    private conteneurVote $lesVotes; // a modifier plus tard avec le systeme de vote

    # ajouter un moyen de connaitre le Texte de loi qui contient cet article
    public function __construct(private int $idTexte,private int $codeSeqArticle,private string $titreArticle, private string $texteArticle)
    {
        $this->lesAmendements = new conteneurAmendement();
    }

    public function __get($attribut){
        switch($attribut) {
            case 'idTexte' : return $this->idTexte;break;
            case 'codeSeqArticle' : return $this->codeSeqArticle;break;
            case 'titreArticle' : return $this->titreArticle; break;
            case 'texteArticle' : return $this->texteArticle;break;
            case 'lesAmendements': return $this->lesAmendements;break;
            case 'lesArticlesDeReference': return $this->lesArticlesDeReference;break;
        }
    }

    public function __set($attribut,$valeur){
        switch($attribut) {
            case 'idArticle' : $this->codeSeqArticle = $valeur;break;
            case 'texteArticle' : $this->texteArticle = $valeur;break;
        }
    }

    public function afficheArticle(){
        $id = $this->idTexte.'.'.$this->codeSeqArticle;
        $titre = $this->titreArticle;
        $texte = $this->texteArticle;

        echo "<h3>$id | $titre</h3>";

        if (isset($this->lesArticlesDeReference)){
            $listeId = '';
            $refs = $this->lesArticlesDeReference->__get('lesArticles');
            foreach($refs as $unArtRef){
                $listeId .= $unArtRef->__get('idTexte');
                $listeId .= '.';
                $listeId .= $unArtRef->__get('codeSeqArticle');
                if ($this->lesArticlesDeReference->nbArticle() > 1 and $unArtRef != $refs[$this->lesArticlesDeReference->nbArticle()-1]){
                    $listeId .= ' | ';
                }
            }
            echo "Article(s) de réference : $listeId<br>";
        }

        echo "<br><p>$texte</p>";
    }

    public function ajouterAmendement(metierAmendement $amendement){
        $this->lesAmendements->ajouterObjAmendement($amendement);
    }

    public function ajouterReference(metierArticle $article){
        if (isset($lesArticlesDeReference)){
            $this->lesArticlesDeReference->ajouterObjArticle($article);
        }
        else {
            $this->lesArticlesDeReference = new conteneurArticle();
            $this->lesArticlesDeReference->ajouterObjArticle($article);
        }
        
    }

}

?>