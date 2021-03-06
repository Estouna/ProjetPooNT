<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <!-- 
        -------------------------------------------------------- BARRE DE NAVIGATION -------------------------------------------------------- 
    -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand text-primary" href="#">BLOGAPART</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/annonces">Liste des annonces</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
                    <?php if (isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/logout">D??connexion</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/login">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">

        <!-- 
            -------------------------------------------------------- MESSAGES -------------------------------------------------------- 
        -->
        <?php if (!empty($_SESSION['erreur'])) : ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php
                echo $_SESSION['erreur'];
                unset($_SESSION['erreur']);
                ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['success'])) : ?>
            <div class="alert alert-success text-center" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        <!-- 
                -------------------------------------------------------- CONTENU -------------------------------------------------------- 
        -->
        <?= $content ?>

        <!-- BOUTON LISTE ANNONCES-->
        <div class="text-center mt-5">
            <a href="/annonces" class="btn btn-primary">Voir la liste des annonces</a>
        </div>

    </div>


    <!-- 
        -------------------------------------------------------- FOOTER -------------------------------------------------------- 
    -->
    <footer class="bg-light py-4 footer mt-auto">

        <!-- TEMPS CHARGEMENT -->
        <div class="container">
            Page g??n??r??e en ms <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?>ms
        </div>

    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>