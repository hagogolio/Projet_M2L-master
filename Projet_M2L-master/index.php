<?php
require_once'Dataccess/connexion.php';

?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <title>Mon application</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Connexion à mon application">
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
        <!-- ci-dessous notre fichier CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:400,700,300" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body class="connect">

    <div class="container">
                <div class="main">

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-sm-offset-1">

                            <h1>Votre Espace Formation</h1>
                            <h2>Toutes Vos Formations en un clic!</h2>

                            <form action="index.php" name="login" role="form" class="form-horizontal" method="post" accept-charset="utf-8">
                                <div class="form-group">
                                    <div class="col-md-8"><input name="username" placeholder="Identifiant" class="form-control" type="text" id="UserUsername"/></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8"><input name="password" placeholder="Mot de passe" class="form-control" type="password" id="UserPassword"/></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-0 col-md-8"><input  class="btn btn-success btn btn-success" type="submit" value="Connexion"/></div>
                                </div>

                            </form>
                            <p class="credits">Développé par <a href="http://www.monsite.com" target="_blank">Moi</a>.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    
    </body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(TestIdentifiants())
    {
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        header('Location:formation.php');
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
        header('Location:index.php');
    }}
?>
