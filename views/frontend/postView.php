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
    <p><a href="index.php?p=home"><i class="fas fa-arrow-circle-left"></i> Retour à la liste des billets</a></p>
    <?php if (isset($_GET['report'])) {
    if ($_GET['report'] == 'success') {
        echo "<div class=\"alert alert-info text-center\" role=\"success\"><strong>Merci !</strong> Le commentaire à bien été signalé</div>";
    }
} ?>
    <div class="news card">
        <div class="card-header">
            <h5>
                <?php echo htmlspecialchars($post['title']) ?>
                <em>le <?php echo $post['creation_date_fr'] ?></em>
            </h5>
        </div>
        <div class="card-body">
            <p>
                <?php echo $post['content'] ?>
            </p>
        </div>
    </div>

    <?php
while ($comment = $comments->fetch()) {
    if (!isset($markerComment)) {
        echo "<br /><h4>Commentaires</h4>";
        $markerComment = true;
    }?>

        <div class="comment card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <strong><?php echo htmlspecialchars($comment['author']) ?></strong> le
                        <?php echo $comment['comment_date_fr'] ?>
                    </div>
                    <div class="align-items-end">
                        <a role="button" class="btn btn-info" data-content="<?php echo htmlspecialchars($comment['comment'])?>" data-target="#reportModal" data-title="<?php echo $comment['author']?>" data-toggle="modal" href="#" data-link="index.php?action=reportcomment&amp;post_id=<?php 
                echo $post['id'] ?>&amp;id=<?php 
                echo $comment['id'] ?>"><i class="far fa-flag"></i> Signaler</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <?php echo nl2br(htmlspecialchars($comment['comment'])) ?>
                </div>
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
                    <input type="text" class="form-control" id="author" name="author" required="true" />
                </div>
                <div class="form-group">
                    <label for="comment">Commentaire</label><br />
                    <textarea class="form-control" rows="5" id="comment" name="comment" required="true"></textarea>
                </div>
                <div class="form-group g-recaptcha" data-sitekey="6LehEEIUAAAAACQ7kovRm8iD5K35cCs1SYbuJ4xa">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">
        Soumettre la requête</button>
                </div>
            </form>
        </div>

        <!--  Report Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-type" class="modal-title">Signaler un commentaire</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-body">Voulez-vous vraiment signaler ce commentaire ?</div>
                        <div id="modal-title"></div>
                        <div id="modal-content"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a type="button" id="ok" class="btn btn-info"><i class="far fa-flag"></i> Signaler</a>
                    </div>
                </div>
            </div>
        </div>

        <?php 
$content = ob_get_clean();

require '../views/nav.php';
require '../views/template.php'; ?>
