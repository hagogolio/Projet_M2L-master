<?php
ob_start();
require_once 'include/navbar.php';
?>
<!-- PAGE ADMIN -->
<body class="connect">
<div class="container">

    <aside class="aside1">
        <h1 class ="title text-center">Validation des demandes</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Nom du demandeur</th>
                    <th>Etat</th>
                    <th>Crédit</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php

                $formationEmploye = formationpasvalidee();
                //echo var_export( $formationEmploye);

                foreach($formationEmploye as $uneFormation)
                {

                    echo "<form action='admin.php' name='resa' role='form'  method='post' accept-charset='utf-8'>";
                    echo "<tr>";
                    echo "<td>$uneFormation->titre </td>";
                    echo "<td>$uneFormation->nom</td>";
                    echo "<td>$uneFormation->etat</td>";
                    echo "<td>$uneFormation->credit</td>";
                    
                    echo "<td><button class='btn btn-danger' type='submit' name='submit_c'><span class='glyphicon glyphicon-remove'></span> Refuser</button><td>";
                    echo "<td><input class='btn btn-success' type='submit' name='submit_v' value='valider'/><td>";
       
                    echo "</tr>";
                    echo "<input type='hidden' name='choix1' value='$uneFormation->idFormation'/>";
                    echo "<input type='hidden' name='choix2' value='$uneFormation->idEmploye'/>";
                    echo "</form>";
                }
                ?>
                </tbody>
            </table>
        </div>
</div>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if(isset($_POST['submit_v'])){
    $formationEmploye = validerformation($_POST['choix2'], $_POST['choix1'],$uneFormation->credit);
    $_SESSION['flash']['success'] = "Formation Validée!";
    header('Location:reservation.php');
     }
      if(isset($_POST['submit_c'])){
           $formationEmploye = refuserformation($_POST['choix2'], $_POST['choix1'],$uneFormation->credit);
             $_SESSION['flash']['danger'] = "Formation Refusée!";
    header('Location:reservation.php');
     }
}
      ob_end_flush();       
?>
