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
<h6>Derniers billets du blog :</h6>

<?php
while ($data = $posts->fetch()) {
?>
<div id="pagination">
    <div class="news card">
        <div class="card-header">
            <h5>
                <?php echo htmlspecialchars($data['title']) ?>
                <em>le <?php echo $data['creation_date_fr'] ?></em>
            </h5>
        </div>
        <div class="card-body" id="card-body" style="max-height: 300px">
            <div>
                <?php echo $data['content'] ?>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <h6><em><a class="card-link" href="index.php?action=post&amp;id=<?php echo $data['id'] ?>">Voir le billet</a></em></h6>
                </div>
                <div class="align-items-end">
                    <h6><?php 
                    if (getCommentEnum($data['id']) > 0) {
                        echo '<span class="badge badge-pill badge-info">' . getCommentEnum($data['id']) . '</span> 
                        <a href="index.php?action=post&amp;id=' . $data['id'] . '">commentaire'; 
                        if (getCommentEnum($data['id']) != 1) {
                            echo "s</a>";
                        } else {
                            echo "</a>";
                        }
                    } else {
                        echo 'aucun commentaire';
                    } ?>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

$posts->closeCursor();
$content = ob_get_clean();

require '../views/nav.php';
require '../views/template.php'; ?>