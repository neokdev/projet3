<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php
        /**
         * Template
         * PHP version 7.1.9
         * 
         * @category View
         * @package  Projet3
         * @author   Neok <neokdev@gmail.com>
         * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
         * @link     http://www.projet3.nekbot.com/
         */
        echo $title ?></title>
        <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" 
        integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" 
        crossorigin="anonymous">

        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <?php echo $content ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" 
        integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </body>
</html>