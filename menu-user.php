<?php
// Vérifier si le rôle est défini dans la session

$role = $_SESSION['role'];

echo '<h3>Menu Global</h3>';
echo '<ul class="nav-links">';

if ($role == 1) { // role 1 = secrétaire
    echo "
<li>
    <a href='#'>
        Texte
    </a>
    <ul class='sub-menu'>
        <li><a href='index.php?vue=texte&action=ajouter'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
        <li><a href='index.php?vue=texte&action=visualiser'>Visualiser</a></li>
    </ul>
</li>";
} elseif ($role == 2) { // role 2 = greffier
    echo "
    <li>
    <a href='#'>
        Articles
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
    </ul>
</li>";
} elseif ($role == 3) { // role 3 = citoyen
    echo "
<li>
    <a href='#'>
        Articles
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>
<li>
    <a href='#'>
        Amendements
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>
<li>
    <a href='#'>
        Etat d'avancement
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>";
} elseif ($role == 4) { // role 4 = monarque
    echo "
<li>
    <a href='#'>
        Articles
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>
<li>
    <a href='#'>
        Amendements
    </a>
    <ul class='sub-menu'>
        <li><a href='index.php?vue=amendement&action=ajouter'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
        <li><a href='index.php?vue=amendement&action=visualiser'>Visualiser</a></li>
    </ul>
</li>
<li>
    <a href='#'>
        Institutions
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>
<li>
    <a href='#'>
        Types Institutions
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>
<li>
    <a href='#'>
        Organes
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>
<li>
    <a href='#'>
        Rôles
    </a>
    <ul class='sub-menu'>
        <li><a href='#'>Ajouter</a></li>
        <li><a href='#'>Modifier</a></li>
        <li><a href='#'>Visualiser</a></li>
    </ul>
</li>";
echo '</ul>';
}


?>
</div>
<div class="page">