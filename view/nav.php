<?php
session_start();
ob_start(); ?>
    <nav class="navbar navbar-expand navbar-dark bg-secondary fixed-top">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?p=login">Se connecter</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php $nav = ob_get_clean(); ?>