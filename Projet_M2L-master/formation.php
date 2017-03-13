<?php
ob_start();
require_once 'include/navbar.php';
?>
<body class="connect">
<div class="container">

    <aside class="aside1">
        <h1 class ="title text-center">Vos Formations</h1>
 	<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
          <th>Titre</th>
          <th>Date</th>
          <th>Duree</th>
          <th>Etat</th>

      </tr>
    </thead>
    <tbody>
   	<?php
      $formationEmploye = Formationuser($_SESSION['id']);
			foreach($formationEmploye as $uneFormation)
			{
          $uneFormation->date=date("d/m/y");
        echo "<form action='pdf.php' name='resa' role='form'  method='post' accept-charset='utf-8'>";
				echo "<tr>";
				echo "<td>$uneFormation->titre </td>";
				echo "<td class='date'>$uneFormation->date</td>";
				echo "<td class='duree'>$uneFormation->duree</td>";
        echo "<td>$uneFormation->etat</td>";
        echo "<td><button  class='btn btn-success name='id' type='submit'> <span class='glyphicon glyphicon-print'></span> PDF</button><td>";
    /*    echo "<td><input  class='btn btn-success btn btn-success' type='submit' name='submit' value='Modifier'/></div><td>";*/
        echo "</tr>";
        echo "<input type='hidden' name='choix' value='$uneFormation->idFormation'/>";
        echo "</form>";
			}
      ob_end_flush();       
?>
    </tbody>
  </table>
  </div>
</div>