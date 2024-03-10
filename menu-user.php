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
        <div class="deconnexion">
            <form action="deconnexion.php" method="post">
                <button type="submit" class="btn btn-danger">
                    Se déconnecter
                </button>
            </form>
        </div>
        <h1>
            <font face="helvetica">Cas Cofonie</font>
        </h1>
    </div>

    <div class="sidebar">
        <?php
        // Démarrer la session
        session_start();

        // Vérifier si le rôle est défini dans la session
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];

            echo '<h3>Menu Global</h3>';
            echo '<ul class="nav-links">';

            if ($role == 1) { // role 1 = secrétaire
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
            }

            echo '</ul>';
        } else {
            // Rediriger vers la page d'accueil si le rôle n'est pas défini
            header("Location: index.php");
            exit();
        }

        ?>
    </div>
    </div>
    <!-- Pied de page -->
    <footer class="text-center text-white fixed-bottom" style="background-color: #3d3d3d;">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #4b4b4b;">
            © 2024 Copyright:
            <a class="text-white" href="#">Marius/Teddy/Leopold/Nolan</a>
        </div>
        <!-- Copyright -->
    </footer>
    <style>
        .deconnexion {
            margin-right: 80%;
            position: absolute;
        }
    </style>
</body>

</html>