<?php
ob_start();
require_once 'include/navbar.php';
?>
<body class="connect">
<div class="container">

    <aside class="aside1">
        <h1 class ="title text-center">Gestion  Utilisateurs</h1>
 	<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
          <th>Nom du Compte</th>
          <th>Mot de passe</th>
          <th>Crédit</th>
     

      </tr>
    </thead>
    <tbody>
   	<?php
       $modifemploye = afficheruser();
      
			foreach($modifemploye as $modif)
			{
        echo "<form action='usermodif.php' name='resa' role='form'  method='post' accept-charset='utf-8'>";
				echo "<tr>";
				echo "<td>$modif->nom </td>";
				echo "<td class='date'>$modif->mdp</td>";
				echo "<td class='duree'>$modif->Credit</td>";
                echo "<td><input  class='btn btn-success btn btn-success' type='submit' name='submit' value='Modifier'/></div><td>";
                echo "</tr>";
                echo "<input type='hidden' name='choix' value='$modif->idEmploye'/>";
                echo "</form>";
			}




     
?>

    </tbody>
  </table>
  </aside>

   <aside class="aside1">
   <h1 class ="title text-center">Créer Utilisateurs</h1>
    <form action="useradmin.php" name="ajout" role="form" method="post">
    <table class="table">
    <thead>
      <tr>
        <th>Nom du compte</th>
        <th>mot de passe</th>
        <th>Crédit</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody>
    <td><input type='text' name='critere1' required="required"/> </td>
    <td><input type='text' name='critere2' required="required"/> </td>
    <td><input type='number' name='critere3'  step="8" value="0" min="0" max="9999" required="required"/> </td>
    <td><select class="form-control" name="critere4">
  <option value="1">Administrateur</option>
  <option value="2">Utilisateur</option>
</select>
    <input type='hidden' name='choix' value='$uneFormation->idEmploye'/>
    <td><button  class='btn btn-success' name='id' type='submit'><span class='glyphicon glyphicon-user'></span> Créer</button></td>
    </table>
     <?php
         if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if(isset($_POST['id'])){ 
       
          
            ajoutuser($_POST['critere1'], $_POST['critere2'],$_POST['critere3'],$_POST['critere4']);
           
            header('Location:useradmin.php');
    }}   

ob_end_flush();       
?>
  </div>
</div>
</aside>