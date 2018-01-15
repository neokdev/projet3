<?php
/**
 * Backend Admin View
 * PHP version 7.1.9
 * 
 * @category View
 * @package  Projet3
 * @author   Neok <neokdev@gmail.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.01
 * @see      http://www.projet3.nekbot.com/
 */
$title = 'Administration';

ob_start(); ?>
<h1>Interface d'administration</h1>
<p><a href="index.php?p=home">Retour à la liste des billets</a></p>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#">Billets</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Commentaires</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Compte Administrateur</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="post" role="tabpanel">
        <br/><h4>Création d'un nouveau billet</h4>
        <form action="index.php?action=addPost" method="post">
            <div class="form-group">
                <label for="title">Titre</label><br />
                <input type="text" class="form-control" name="title" />
            </div>
            <div class="form-group">
                <label for="comment">Billet</label><br />
                <textarea class="form-control" id="mce"rows="5" 
                id="comment" name="comment"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                Publier le billet</button>
            </div>
        </form>
        <h4>Liste des anciens billets</h4>
    <?php
    while ($data = $posts->fetch()) {
    ?>
        <div class="news card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h5>
                        <?php echo htmlspecialchars($data['title']) ?>
                        <em>le <?php echo $data['creation_date_fr'] ?>
                    </div>
                    <div class="align-items-end">
                        <button href="#" class="btn btn-info">Editer</button>
                        <button href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Effacer</button></em>
                    </h5>
                    </div>  
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">
                <?php echo $data['content'] ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Supprimer le billet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        Voulez-vous vraiment supprimer le billet "<?php echo $data['title'] ?>"de façon permanente ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger">Supprimer</button>
      </div>
    </div>
  </div>
</div>
<?php
    }
    $posts->closeCursor();?>

<?php
$content = ob_get_clean();

require '../views/nav.php';
require '../views/template.php'; ?>