    <!-- 
        -------------------------------------------------------- BARRE DE NAVIGATION -------------------------------------------------------- 
    -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand text-primary" href="/">BLOGAPART</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/annonces">Liste des annonces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories">Catégories</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>

                    <?php if (isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) : ?>
                        <div class="dropdown">
                            <button class="btn text-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Admin
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-black-50" href="/admin">Accueil</a>
                                <a class="dropdown-item text-black-50" href="/admin/categories">Gestion catégories</a>
                                <a class="dropdown-item text-black-50" href="/admin/annonces">Gestion annonces</a>
                                <a class="dropdown-item text-black-50" href="/admin/users">Gestion utilisateurs</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/users/profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/logout">Déconnexion</a>
                    </li>

                <?php else : ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/users/login">Connexion</a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </nav>