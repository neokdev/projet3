<?php
/**
 * Frontend List Post View
 * PHP version 7.1.9
 * 
 * @category View
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
$title = 'Mon blog';

ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch()) {
?>
<div class="news card">
    <div class="card-header">
        <h5>
            <?php echo htmlspecialchars($data['title']) ?>
            <em>le <?php echo $data['creation_date_fr'] ?></em>
        </h5>
    </div>
    <div class="card-body">    
        <p class="card-text">
            <?php echo nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a class="card-link" href="index.php?action=post&amp;id=<?php echo $data['id'] ?>
            ">Commentaires</a></em>
        </p>
    </div>
</div>
<?php
}

$posts->closeCursor();
$content = ob_get_clean();

require 'view/template.php'; ?>