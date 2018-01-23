<?php

$title = 'Connexion';

ob_start();?>
<h1>Connexion</h1>
<p><a href="index.php?p=home">Retour à la liste des billets</a></p>

<div class="jumbotron">
<h4>Connexion</h4><br/>
<?php if (isset($errorMessage)) {
    echo $errorMessage;
} ?>
<form action="index.php?p=login" method="POST">
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
    <button type="submit" name="submitlogin" class="btn btn-secondary">Confirmer</button>
</form>
</div>
<?php 
$content = ob_get_clean();?>