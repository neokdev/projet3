<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <title><?php
        /**
         * Template
         * PHP version 7.1.9
         * 
         * @category View
         * @package  Projet3
         * @author   Neok <neokdev@gmail.com>
         * @license  http://www.php.net/license/3_01.txt PHP License 3.01
         * @see      http://www.projet3.nekbot.com/
         */
        echo $title ?></title>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=endqmbue15j12xgih2qzex7i6ho4fgun9nloyc01k7g5xkqg"></script>
        <script> tinymce.init({
            selector: '#mce',
            plugins: "a11ychecker, advcode, linkchecker, media mediaembed, powerpaste, tinymcespellchecker",
   toolbar: "a11ycheck, code",
            height : 600,
            content_css : 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css',
            language_url: "public/js/tinymce/langs/fr_FR.js"
        }); </script>
        <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" 
        integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" 
        crossorigin="anonymous">
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <?php echo $nav ?>
        <div class="container">
            <?php if (isset($message)) {
                echo $message;}?>
            <?php echo $content;?>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
            crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
            crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" 
            integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" 
            crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
            <script src="public/js/app.js"></script>
        </div>
    </body>
</html>