<?php
/**
 * Frontend Post View
 * PHP version 7.1.9
 * 
 * @category View
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
$title = htmlspecialchars($post['title']);

ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p><a href="index.php?p=home">Retour à la liste des billets</a></p>

<div class="news card">
    <div class="card-header">
        <h5>
            <?php echo htmlspecialchars($post['title']) ?>
            <em>le <?php echo $post['creation_date_fr'] ?></em>
        </h5>
    </div>
    <div class="card-body">
        <p>
            <?php echo nl2br(htmlspecialchars($post['content'])) ?>
        </p>
    </div>
</div>

<br /><h4>Commentaires</h4>

<?php
while ($comment = $comments->fetch()) {
?>
<div class="comment card">
    <div class="card-header">
    <p><strong><?php echo htmlspecialchars($comment['author']) ?></strong>
     le <?php echo $comment['comment_date_fr'] ?></p>
    </div>
    <div class="card-body">
    <p class="card-text"><?php echo nl2br(htmlspecialchars($comment['comment'])) ?></p>
    </div>
</div>
<?php
}
?>
<div class="jumbotron">
<h4>Ajouter un commentaire</h4>
<form action="index.php?action=addComment&amp;
id=<?php echo $post['id'] ?>" method="post">
    <div class="form-group">
        <label for="author">Auteur</label><br />
        <input type="text" class="form-control" id="author" name="author" />
    </div>
    <div class="form-group">
        <label for="comment">Commentaire</label><br />
        <textarea class="form-control" rows="5" 
        id="comment" name="comment"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
        Soumettre la requête</button>
    </div>
</form>
</div>
<?php 
$content = ob_get_clean();

require '../views/nav.php';
require '../views/template.php'; ?>