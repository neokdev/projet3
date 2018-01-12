<?php
require_once '../controler/backend/Session.php';
require_once '../controler/backend/users.php';
$session = Session::getInstance();
if ($session->auth) {
    ob_start(); ?>
    <nav class="navbar navbar-expand navbar-dark bg-secondary fixed-top">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=logout">Se déconnecter</a>
                </li>
                <li class="nav-item">
                    <span class="navbar-text"><?php echo "Connecté depuis l'adresse : " . $session->email; ?></span>
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
                        <a class="nav-link" href="index.php?p=login">Se connecter</a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php $nav = ob_get_clean(); 
}
?>