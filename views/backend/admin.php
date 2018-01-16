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
            <a class="nav-link" href="#com">Commentaires</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#admin">Compte Administrateur</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="post" role="tabpanel">
            <br/>
            <h4>
                <?php 
            if (!empty($editpost)) {
                echo "Modification du billet";
            } else {
                echo "Création d'un nouveau billet";
            }?>
            </h4>
            <form action="index.php?action=<?php if (!empty($editpost)) {echo 'editpost&id=' . $editpost['id'];} else {
                echo 'addPost';
            } ?>" method="post">
                <div class="form-group">
                    <label for="title">Titre du billet</label><br />
                    <input type="text" class="form-control" name="title" value="<?php if (!empty($editpost)) {echo $editpost['title'];} ?>" />
                </div>
                <div class="form-group">
                    <label for="post">Contenu du billet</label><br />
                    <input class="form-control" id="mce" name="postContent" value="<?php if (!empty($editpost)) {echo htmlspecialchars($editpost['content']);} ?>"></input>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-<?php if (!empty($editpost)) {echo 'success';} else {
                        echo 'primary';
                    } ?>">
                    <?php if (!empty($editpost)) 
                    {echo 'Modifier';
                    } else {
                        echo 'Publier';
                    }?> le billet</button>
                    <?php if (!empty($editpost)) {echo "<a class='btn btn-secondary' href='index.php?p=admin' role='button'>Annuler</a>";} ?>
                </div>
            </form>
            <?php if (isset($message)) {
                echo $message;
        } 
?>
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
                                    <em>le <?php echo $data['creation_date_fr'] ?></em></h5>
                            </div>
                            <div class="align-items-end">
                                <a type="button" role="button" href="index.php?action=editpostform&amp;id=<?php echo $data['id'];?>" class="btn btn-info">Editer</a>
                                <button href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Effacer</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?php echo $data['content'] ?>
                        </p>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Supprimer le billet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                            </div>
                            <div class="modal-body text-center">
                                Voulez-vous vraiment supprimer le billet "<strong>
                                <?php echo $data['title'] ?></strong>" de façon permanente ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <a type="button" href="index.php?action=deletepost&amp;id=<?php 
                                echo $data['id'] ?>" class="btn btn-danger">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
    }
            $posts->closeCursor();?>
        </div>
    </div>
    <?php
    $content = ob_get_clean();

    require '../views/nav.php';
    require '../views/template.php'; ?>
