<?php

require_once 'db.php';
include 'connexion.php';
//afficher formation
function afficherformation(){
    $db = new DBConnection();
    $sth=$db->prepare("SELECT * from formation join prestataire on formation.idPrestataire=prestataire.idPrestataire ");
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//afficher formation
function Formationuser($id){
    $db = new DBConnection();
    $sth=$db->prepare("SELECT formation.idFormation,employe.idEmploye, titre, date, etat, duree,etat from employe join selectionner on employe.idEmploye = selectionner.idEmploye
		join formation on formation.idFormation = selectionner.idFormation where employe.idEmploye='$id'");
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function formationmodal(){
$db = new DBConnection();
    $sth=$db->prepare("SELECT * from formation  join prestataire on formation.idPrestataire= prestataire.idPrestataire where idFormation = :idFormation");
    $sth->execute(['idFormation' => $_GET['id']]);
    $result = $sth->execute();
    $result=$sth->fetch(PDO::FETCH_OBJ);
    return $result;
};
function pdftest($id){
$db = new DBConnection();
    $sth=$db->prepare("SELECT * from formation  join prestataire on formation.idPrestataire= prestataire.idPrestataire where idFormation = :idFormation");
    $sth->execute(['idFormation' => $id]);
    $result = $sth->execute();
    $result=$sth->fetch(PDO::FETCH_OBJ);
    return $result;
};

function afficheruser(){
$db = new DBConnection();
    $sth=$db->prepare("SELECT * from employe");
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_OBJ);
    return $result;
};

function choixformation($id, $idform,$credit){

    $db = new DBConnection();
//Soustraction du coût de la formation au crédit de l'utilisateur sélectionné
    $sth=$db->prepare("SELECT credit from formation where idFormation=:idFormation");
    $sth->execute(['idFormation' => $_POST['choix']]);
    $result = $sth->execute();
    $result = $sth->fetch();
    $result=$_SESSION['credit']-$result['credit'];
    //Décrémente le crédit de la variable session.
    $_SESSION['credit']=$result;
    $sth=$db->prepare("UPDATE employe set credit=:credit where idEmploye=:idEmploye");
    $sth->execute(['credit'=>$_SESSION['credit'],'idEmploye' =>$id]);
//Ajoute la formation dans table selectionner
    $sql2="INSERT INTO selectionner values (:idEmploye, :idFormation, 'Attente Validation')";
    $stmt = $db->prepare($sql2);
    $stmt->BindValue(':idFormation',$idform);
    $stmt->BindValue(':idEmploye', $id);
    $result = $stmt->execute();
    return $result;
    }
function modif2($titre,$duree,$credit,$id){
    $db = new DBConnection();
    $sql="UPDATE formation set titre=:titre,duree=:duree,credit=:credit where idFormation=:idFormation";
    $stmt = $db->prepare($sql);
    $stmt->BindValue(':titre',$titre);
    $stmt->BindValue(':duree', $duree);
    $stmt->BindValue(':credit', $credit);
    $stmt->BindValue(':idFormation', $id);
    $result = $stmt->execute();
    return $result;
}
//Test si l'utilisateur peut choisir cette formation (condition1:Crédit suffisant?, condition2:Si formation pas déja choisie?)
function testchoix()
{
    $resultat = false;
    //condition1
    $db = new DBConnection();
    $sth=$db->prepare("SELECT credit from formation where idFormation=:idFormation");
    $sth->execute(['idFormation' => $_POST['choix']]);
    $result = $sth->execute();
    $result = $sth->fetch();
    $result=$result['credit'];
    //condition2	
    $sth=$db->prepare("SELECT * from selectionner where idFormation = :idFormation and idEmploye = :idEmploye");
    $sth->execute(['idFormation' => $_POST['choix'],'idEmploye' => $_SESSION['id']]);
    $retour = $sth->execute();
    $retour=$sth->fetch();
        	if ($retour)
		{
             return $resultat;
		}
    if($result<$_SESSION['credit']){
    $resultat = true;}
    return $resultat;
}

function test($id)
{
$db = new DBConnection();
/*$sth=$db->prepare("SELECT credit from formation where idFormation=:idFormation");
$sth->execute(['idFormation' => $_POST['choix']]);
$result = $sth->execute();
$result = $sth->fetch();
$result=$result['credit']-$_SESSION['credit'];*/
 $sth=$db->prepare("SELECT distinct * from selectionner where idFormation = :idFormation and idEmploye = :idEmploye");
    $sth->execute(['idFormation' => $_POST['choix'],'idEmploye' => $_SESSION['id']]);
    $result = $sth->execute();
    $restult=$sth->fetch();
return $result;

}

function validerformation($id, $idform){
    $db = new DBConnection();
    $sql="UPDATE selectionner set etat='Formation Validée' where idEmploye=:idEmploye and idFormation=:idFormation";
    $stmt = $db->prepare($sql);
    $stmt->BindValue(':idFormation',$idform);
    $stmt->BindValue(':idEmploye', $id);
    $result=$stmt->execute();
    return $result;
    }   

function refuserformation($id, $idform,$credit){
    $db = new DBConnection();
    $sql="DELETE from selectionner where idEmploye=:idEmploye and idFormation=:idFormation";
    $stmt = $db->prepare($sql);
    $stmt->BindValue(':idFormation',$idform);
    $stmt->BindValue(':idEmploye', $id);
    $result=$stmt->execute();
    $result=$_SESSION['credit']+$credit;
    //Décrémente le crédit de la variable session.
    $_SESSION['credit']=$result;
    $sth=$db->prepare("UPDATE employe set credit=:credit where idEmploye=:idEmploye");
    $sth->execute(['credit'=>$_SESSION['credit'],'idEmploye' =>$id]);
    $result=$sth->execute();
    return $result;
    }



function formationpasvalidee()
{
    $db = new DBConnection();
    $sql="SELECT * from selectionner  join employe on selectionner.idEmploye = employe.idEmploye
		join formation on selectionner.idFormation = formation.idFormation where etat='Attente Validation'" ;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function recherche($cas,$critere1,$critere2)
{
    $db = new DBConnection();
    if($cas==1){
    $sth=$db->prepare("SELECT * from formation join prestataire on formation.idPrestataire=prestataire.idPrestataire where prestataire.nom='$critere1'");
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_OBJ);}
    if($cas==2){
    $sth=$db->prepare("SELECT * from formation join prestataire on formation.idPrestataire=prestataire.idPrestataire WHERE formation.titre LIKE '%$critere2%' OR formation.date LIKE '%$critere2%'
    OR formation.duree LIKE '%$critere2%'
	OR formation.credit LIKE '%$critere2%'");
    $sth->execute();
    $result= $sth->fetchAll(PDO::FETCH_OBJ);}
    return $result;
}
function modif1($id){
$db = new DBConnection();
    $sth=$db->prepare("SELECT * from formation join prestataire on formation.idPrestataire=prestataire.idPrestataire where idFormation = $id ");
     $sth->execute();
    $result=$sth->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function modifuser($id){
$db = new DBConnection();
    $sth=$db->prepare("SELECT * from employe  where idEmploye = $id");
     $sth->execute();
    $result=$sth->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function modifuser2($nom,$mdp,$credit,$id){
    $db = new DBConnection();
    $sql="UPDATE employe set nom=:nom,mdp=:mdp,credit=:credit where idEmploye=:idEmploye";
    $stmt = $db->prepare($sql);
    $stmt->BindValue(':nom',$nom);
    $stmt->BindValue(':mdp', $mdp);
    $stmt->BindValue(':credit', $credit);
    $stmt->BindValue(':idEmploye', $id);
    $result = $stmt->execute();
    return $result;
}
function presta()
{
    $db = new DBConnection();
    $sql="SELECT distinct nom from prestataire" ;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;

}
function  ajoutuser($nom,$mdp,$credit,$type)
{
    $db = new DBConnection();
    $sql="INSERT INTO employe (nom,mdp,typeEmploye,Credit) values (:nom,:mdp,:typeEmploye,:credit)";
    $stmt = $db->prepare($sql);
    $stmt->BindValue(':nom',$nom);
    $stmt->BindValue(':mdp', $mdp);
    $stmt->BindValue(':typeEmploye',$type);
    $stmt->BindValue(':credit', $credit);
    $result = $stmt->execute();
    return $result;
}