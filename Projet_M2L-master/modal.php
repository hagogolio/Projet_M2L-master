<?php

require_once 'Dataccess/db.php';
require_once 'Dataccess/formation.php';
 $formationEmploye = formationmodal();

//Include database connection here
$Id = $_GET["id"]; //escape the string if you like
// Run the Query
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><center><?php echo $formationEmploye->titre?></center></h4>
</div>
<div class="modal-body">

 <p><?php echo $formationEmploye->description?><p>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
</div>