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

    <ul class="nav nav-tabs" id="adminTab">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#post-tab">Billets</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#com-tab">Commentaires</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#admin-tab">Administration</a>
        </li>
    </ul>

    <!-- Nav Tab Init -->
    <div class="tab-content">

        <!-- Post Tab -->
        <div id="post-tab" class="tab-pane fade show active" role="tabpanel">
            <div class="jumbotron">
                <h4>
                    <?php 
                if (!empty($setPost)) {
                    echo "Modification du billet";
                } else {
                    echo "Création d'un nouveau billet";
                }?>
                </h4>
                <form action="index.php?action=<?php if (!empty($setPost)) {echo 'setpost&id=' . $setPost['id'];} else {
                    echo 'addpost';
                } ?>" method="post">
                    <div class="form-group">
                        <label for="title">Titre du billet</label><br />
                        <input type="text" class="form-control" name="title" value="<?php if (!empty($setPost)) {echo $setPost['title'];} ?>" />
                    </div>
                    <div class="form-group">
                        <label for="post">Contenu du billet</label><br />
                        <input class="form-control" id="mce" name="postContent" value="<?php if (!empty($setPost)) {echo htmlspecialchars($setPost['content']);} ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-<?php if (!empty($setPost)) {echo 'success';} else {
                            echo 'primary';
                        } ?>">
                        <?php if (!empty($setPost)) 
                        {echo 'Modifier';
                        } else {
                            echo 'Publier';
                        }?> le billet</button>
                        <?php if (!empty($setPost)) {echo "<a class='btn btn-secondary' href='index.php?p=admin' role='button'>Annuler</a>";} ?>
                    </div>
                </form>
            </div>
            <div class="jumbotron">
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
                                    <a role="button" href="index.php?action=setpost&amp;id=<?php echo $data['id'];?>" class="btn btn-info">Editer</a>
                                    <a role="button" href="index.php?action=deletepost&amp;id=<?php echo $data['id']?>" class="btn btn-danger">Effacer</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text" id="card-body">
                                <?php echo $data['content'] ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            $posts->closeCursor();?>
            </div>
        </div>
        <!-- Comment Tab -->
        <div class="tab-pane fade" id="com-tab" role="tabpanel">
            <div class="jumbotron">
                <h4>Commentaires signalés</h4>
                <?php
                while ($reportedComment = $reportedComments->fetch()) {?>
                    <div class="comment card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><strong><?php echo htmlspecialchars($reportedComment['author'])?></strong> le
                                        <?php echo $reportedComment['comment_date_fr'] ?>
                                    </h5>
                                </div>
                                <div class="align-items-end">
                                    <a role="button" href="index.php?action=allowcomment&amp;id=<?php echo $reportedComment['id']?>" class="btn btn-success">Autoriser</a>
                                    <a role="button" href="index.php?action=deletecomment&amp;id=<?php echo $reportedComment['id']?>" class="btn btn-danger">Supprimer</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?php echo nl2br(htmlspecialchars($reportedComment['comment'])) ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>

        <!-- Admin Tab -->
        <div class="tab-pane fade" id="admin-tab" role="tabpanel">
            <div class="jumbotron">
                <h4>Modifier l'adresse email de l'utilisateur actuel</h4>
                <br/>
                <form action="index.php?p=admin" method="post">
                    <div class="form-group">
                        <label for="mail">Veuillez entrer votre nouvelle adresse email</label>
                        <input type="email" class="form-control" name="mailmail" required="true" />
                    </div>
                    <div class="form-group">
                        <label for="mailconfirm">Veuillez confirmer votre nouvelle adresse email</label>
                        <input type="email" class="form-control" name="mailconfirm" required="true" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Veuillez entrer votre mot de passe</label>
                        <input type="password" class="form-control" name="mailpass" required="true" />
                    </div>
                    <div class="form-group">
                        <button name="mail" type="submit" class="btn btn-secondary">
                        Soumettre la requête</button>
                    </div>
                </form>
            </div>
            <div class="jumbotron">
                <h4>Modifier le mot de passe de l'utilisateur actuel</h4>
                <br/>
                <form action="index.php?p=admin" method="post">
                    <div class="form-group">
                        <label for="pass">Veuillez entrer votre nouveau mot de passe</label>
                        <input type="password" class="form-control" name="passpass" required="true" />
                    </div>
                    <div class="form-group">
                        <label for="passconfirm">Veuillez confirmer votre nouveau mot de passe</label>
                        <input type="password" class="form-control" name="passconfirm" required="true" />
                    </div>
                    <div class="form-group">
                        <button name="pass" type="submit" class="btn btn-secondary">
                        Soumettre la requête</button>
                    </div>
                </form>
            </div>
            <div class="jumbotron">
                <h4>Ajouter un administrateur</h4>
                <br/>
                <form action="index.php?p=admin" method="post">
                    <div class="form-group">
                        <label for="pass">Adresse email</label>
                        <input type="email" class="form-control" name="adminmail" required="true" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Mot de passe</label>
                        <input type="password" class="form-control" name="adminpass" required="true" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Veuillez confirmer votre mot de passe</label>
                        <input type="password" class="form-control" name="adminconfirm" required="true" />
                    </div>
                    <div class="form-group">
                        <button name="user" type="submit" class="btn btn-secondary">
                        Soumettre la requête</button>
                    </div>
                </form>
            </div>
            <div class="jumbotron">
                <h4>Liste des administrateurs</h4>
                <br/>
                <?php
                while ($user = $userList->fetch()) {?>
                    <div class="card<?php if ($user['email'] == $session->email) {
                            echo " bg-secondary text-white";
                        }?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <strong><?php echo $user['email']?></strong> créé le <em><?php echo $user['creation_date']?></em>
                                </div>
                                <div class="align-items-end">
                                    <?php 
                                    if ($user['email'] != $session->email) { 
                                        $userId = $user['id'];
                                        echo "<a role=\"button\" href=\"index.php?action=deleteuser&id=$userId\" class=\"btn btn-danger\">Supprimer</a>";
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>

    </div>
    <?php
    $content = ob_get_clean();

    require '../views/nav.php';
    require '../views/template.php'; ?>
