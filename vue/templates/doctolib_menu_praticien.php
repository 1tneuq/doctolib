<!-- début menu praticien -->
<?php  ?>
<nav class="navbar navbar-expand-lg bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="router.php?action=accueilDoctolib">LACOMBE - PIN | praticien | <?php echo($_SESSION['login']); ?> |</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">praticien</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="router.php?action=readDisponibilites">Liste de mes disponibilités</a></li>
                    <li><a class="dropdown-item" href="router.php?action=createDisponibilites&target=readNewDisponibilites">Ajout de nouvelles disponibilités</a></li>
                    <hr>
                    <li><a class="dropdown-item" href="router.php?action=readRdvPatient">Liste des rendez-vous avec le nom des patients</a></li>
                    <li><a class="dropdown-item" href="router.php?action=readPatients">Liste de mes patients (sans doublon)</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="router.php?action=deleteCompte">Supprimer mon compte</a></li>
                    <li><a class="dropdown-item" href="">Proposez une amélioration du code MVC</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="router.php?action=deconnexion">Déconnexion</a></li>
                </ul>
            </li>

            </ul>
        </div>
    </div>
</nav>

<!-- fin menu praticien -->
