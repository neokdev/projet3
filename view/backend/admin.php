<?php

$title = 'Login';

ob_start();?>
<h1>Connexion</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="jumbotron">
<h4>Connexion</h4><br/>
<form>
    <div class="form-group">
    <label for="validationDefaultUsername">Adresse e-mail</label>
        <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend2">@</span>
            </div>
            <input type="email" class="form-control" id="validationDefaultUsername" placeholder="E-mail" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>
    <div class="form-group">
      <label for="validationDefaultPassword">Mot de passe</label>
      <input type="password" class="form-control" id="validationDefaultPassword" placeholder="Mot de passe" required>
    </div>
    <button class="btn btn-secondary" type="submit">Confirmer</button>
</form>
</div>
<?php 
$content = ob_get_clean();

require 'view/template.php'; ?>