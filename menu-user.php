    <?php
    // Vérifier si le rôle est défini dans la session
    $role = $_SESSION['role'];

    echo '<h3>Menu Global</h3>';
    echo '<ul class="nav-links">'; // Aucune modification ici

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
        </li>
        <li>
            <a href='#'>
                News
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=publierNews&action=ajouter'>Publier une news</a></li>
                <li><a href='index.php?vue=newsPratique&action=visualiser'>Pratique</a></li>
                <li><a href='index.php?vue=newsJuridique&action=visualiser'>Juridique</a></li>
            </ul>
        </li>";
    } elseif ($role == 2) { // role 2 = greffier
        echo "
        <li>
            <a href='#'>
                News
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=newsPratique&action=visualiser'>Pratique</a></li>
                <li><a href='index.php?vue=newsJuridique&action=visualiser'>Juridique</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Texte
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=texte&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
            </ul>
        </li>";
    } elseif ($role == 3) { // role 3 = citoyen
        echo "
        <li>
            <a href='#'>
                News
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=newsPratique&action=visualiser'>Pratique</a></li>
                <li><a href='index.php?vue=newsJuridique&action=visualiser'>Juridique</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Texte
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=texte&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Amendements
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=amendement&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>";
    } elseif ($role == 4) { // role 4 = monarque
        echo "
        <li>
            <a href='#'>
                News
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=newsPratique&action=visualiser'>Pratique</a></li>
                <li><a href='index.php?vue=newsJuridique&action=visualiser'>Juridique</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Texte
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=texte&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=texte&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Institutions
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=institution&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=institution&action=visualiser'>Visualiser</a></li>
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
                <li><a href='index.php?vue=organe&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=organe&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Rôles
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=role&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=role&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>";
    } elseif ($role == 10) { // role 10 = admin
        echo "
        <li>
            <a href='#'>
                News
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=newsPratique&action=visualiser'>Pratique</a></li>
                <li><a href='index.php?vue=newsJuridique&action=visualiser'>Juridique</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Texte
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=texte&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=texte&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Votes
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=vote&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=vote&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Institutions
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=institution&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=institution&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Gérer les utilisateurs
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=afficherUtilisateurs&action=visualiser'>Voir les utilisateurs</a></li>
                <li><a href='index.php?vue=modifRole&action=ajouter'>Modifier le rôle d'un utilisateur</a></li>
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
                <li><a href='index.php?vue=organe&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=organe&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        <li>
            <a href='#'>
                Rôles
            </a>
            <ul class='sub-menu'>
                <li><a href='index.php?vue=role&action=ajouter'>Ajouter</a></li>
                <li><a href='#'>Modifier</a></li>
                <li><a href='index.php?vue=role&action=visualiser'>Visualiser</a></li>
            </ul>
        </li>
        ";
    }

    echo '</ul>';
?>

</div>
<div class="page">
