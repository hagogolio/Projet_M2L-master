<?php
ob_start();
require_once 'include/navbar.php';
$formation = modifuser($_POST['choix']);

?>

<body class="connect">
<div class="container">

    <aside class="aside1">
        <h1 class ="title text-center">Modification des données de l'utilisateur</h1>
 	<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Nom du compte</th>
        <th>mot de passe</th>
        <th>Crédit</th>
   
          <th></th>
      </tr>
    </thead>
    <tbody>
   	<?php
        

			foreach($formation as $uneFormation)
			{
              
                echo "<form action='usermodif.php' name='resa' role='form'  method='post' accept-charset='utf-8'>";
                echo "<tr>";
				echo "<td><input type='text' value='$uneFormation->nom' name='critere1'/> </td>";
                echo "<td><input type='text' value='$uneFormation->mdp' name='critere2'/> </td>";
                echo "<td><input type='text' value='$uneFormation->Credit'name='critere3'/> </td>";
                  echo "<input type='hidden' name='choix' value='$uneFormation->idEmploye'/>";
                echo "<td><input  class='btn btn-success btn btn-success' type='submit' name='submit_p' value='Modif'/></div><td>";
               
                echo "</tr>";
              
                echo "</form>";
			}
            
		?>
  </table>
        <div>
    <?php
         if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if(isset($_POST['submit_p'])){ 
       
var_dump($_POST['choix']);
          
            modifuser2($_POST['critere1'], $_POST['critere2'],$_POST['critere3'],$_POST['choix']);
           
            header('Location:useradmin.php');
    }}   

  
 
   
  
ob_end_flush();       
?>



  </div>
</div>
        </div>
</aside>
</body>
<div class="modal fade" id="editBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Heading</center></h4>
            </div>
            <div class="modal-body">
                <div class="form-data"></div> //donnée de la page modal.php
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
$( document ).ready(function() {
    $('#editBox').on('hidden.bs.modal', function () {
          $(this).removeData('bs.modal');
    });
});
</script>