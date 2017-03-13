<?php
require_once 'db.php';

/**
 * Démarre une session
 * @return void
 */

function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['id'])){
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: index.php');
        exit();
    }}
/**
 * Teste si l'utilisateur a rentré les bon identifiants dans le formulaire
 * @return vrai si l'utilisateur a rentré les bons identifiants
 */
function TestIdentifiants()
{
	$resultat = false;
	 if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){

          $db = new DBConnection();
         $sth=$db->prepare("SELECT * from employe where nom = :username and mdp = :password");
         $sth->execute(['username' => $_POST['username'],'password' => $_POST['password']]);
		
        $retour = $sth->execute();
        	if ($retour)
		{
			$retour = $sth->fetch();

		}

		if (!empty($retour))
		{
            if (session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
		    $_SESSION['id'] = $retour['idEmploye'];
		    $_SESSION['nom'] = $retour['nom'];
            $_SESSION['credit']  = $retour['Credit'];
            $_SESSION['type']=$retour['typeEmploye'];
		$resultat = true;
		}
		return $resultat;
	
	}
}