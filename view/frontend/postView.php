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
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($post['title']) ?>
        <em>le <?php echo $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?php echo nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<div class="container">

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch()) {
?>
    <p><strong><?php echo htmlspecialchars($comment['author']) ?></strong>
     le <?php echo $comment['comment_date_fr'] ?></p>
    <p><?php echo nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
?>
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

require 'template.php'; ?>