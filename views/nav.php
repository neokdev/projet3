<?php
require_once '../controler/backend/Session.php';
$session = Session::getInstance();
if ($session->auth) {
    ob_start(); ?>
    <nav class="navbar navbar-expand navbar-dark bg-secondary fixed-top">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a type="button" class="nav-link btn btn-dark" href="index.php?action=logout">Se déconnecter</a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link btn btn-secondary" href="index.php?p=admin">Acceder à l'interface d'administration</a>
                </li>
            </ul>
        </div>
    </nav>
<?php $nav = ob_get_clean(); 
} else {
    ob_start(); ?>
    <nav class="navbar navbar-expand navbar-dark bg-secondary fixed-top">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a type="button" class="nav-link btn btn-secondary" href="index.php?p=login">Se connecter</a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php $nav = ob_get_clean(); 
}
?>