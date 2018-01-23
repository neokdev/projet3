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
$title = 'Billet simple pour l\'Alaska';

ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
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
    <div class="card-body" id="card-body" style="max-height: 200px">
        <div>
            <?php echo $data['content'] ?>
        </div>
    </div>
    <div class="card-footer">
    <em><a class="card-link" href="index.php?action=post&amp;id=<?php echo $data['id'] ?>">Voir le billet</a></em>
  </div>
</div>
<?php
}

$posts->closeCursor();
$content = ob_get_clean();

require '../views/nav.php';
require '../views/template.php'; ?>