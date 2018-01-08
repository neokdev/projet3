<?php
/**
 * Error View
 * PHP version 7.1.9
 * 
 * @category View
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
$title = 'Erreur';

ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<p><a href="../index.php">Retour à l'accueil</a></p>

<div class="alert alert-danger text-center" role="alert">
    <strong>Erreur !</strong> <?php echo $errorMessage ?>
</div>

<?php
$content = ob_get_clean();

require 'view/nav.php';
require 'frontend/template.php';?>