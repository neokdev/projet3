<?php



$title = 'Connexion';

ob_start();?>
<h1>Connexion</h1>
<p><a href="index.php?p=home">Retour à la liste des billets</a></p>

<div class="jumbotron">
<h4>Connexion</h4><br/>
<form action="model/backend/login.php" method="POST">
    <div class="form-group">
        <label for="validationDefaultUsername">Nom d'utilisateur</label>
        <input type="text" name="username" class="form-control" id="validationDefaultUsername" placeholder="Nom d'utilisateur" required>
    </div>
    <div class="form-group">
    <label for="validationDefaultEmail">Adresse e-mail</label>
        <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend2">@</span>
            </div>
            <input type="email" name="email" class="form-control" id="validationDefaultEmail" placeholder="E-mail" required>
        </div>
    </div>
    <div class="form-group">
      <label for="validationDefaultPassword">Mot de passe</label>
      <input type="password" name="password" class="form-control" id="validationDefaultPassword" placeholder="Mot de passe" required>
    </div>
    <div class="form-group custom-control custom-checkbox">
        <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
        <label class="custom-control-label" for="customCheck1">Se souvenir de moi</label>
    </div>

        <button type="submit" name="submit" class="btn btn-secondary">Confirmer</button>
</form>
</div>
<?php 
$content = ob_get_clean();?>