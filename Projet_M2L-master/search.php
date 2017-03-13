<?php
ob_start();
require_once 'include/navbar.php';
$formationEmploye = recherche($_POST['cas'],$_POST['critere1'],$_POST['critere2']);

?>

<body class="connect">
<div class="container">

    <aside class="aside1">
        <h1 class ="title text-center">Choix de la Formation</h1>
 	<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Durée</th>
        <th>Coût</th>
        <th>Prestataire</th>
          <th></th>
      </tr>
    </thead>
    <tbody>
   	<?php
        

			foreach($formationEmploye as $uneFormation)
			{
                $uneFormation->date=date("d/m/y"); 
                $id=$uneFormation->idFormation;
                echo "<form action='search.php' name='resa' role='form'  method='post' accept-charset='utf-8'>";
                echo "<tr>";
				echo "<td>$uneFormation->titre </td>";
				echo "<td class='date'>$uneFormation->date</td>";
				echo "<td class='duree'>$uneFormation->duree</td>";
				echo "<td>$uneFormation->credit </td>";
				echo "<td>$uneFormation->nom</td>";
                echo "<td><a data-toggle='modal'' data-target='#editBox' href='modal.php?id=$uneFormation->idFormation' class='btn btn-m btn-info'>Détail</a><td>";
                echo "<td><input  class='btn btn-success btn btn-success' type='submit' name='submit_p' value='Choisir'/></div><td>";
                echo "</tr>";
                echo "<input type='hidden' name='choix' value='$uneFormation->idFormation'/>";
                echo "</form>";
			}
		?>
  </table>
        <div>
    <?php
         if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        if(isset($_POST['submit_p'])){ 
        $test=test($_POST['choix']);
        echo var_export( $test);
        if(testchoix())
        {

            choixformation($_SESSION['id'], $_POST['choix'],$_SESSION['credit']);
            $_SESSION['flash']['success'] = 'Demande de formation envoyée.';
            header('Location:formation.php');
        }
        
        else
        {
            $_SESSION['flash']['danger'] = 'Vous ne pouvez choisir cette formation!';
            header('Location:formation.php');
        }
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