<?php
require_once'include/header.php';
?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand">Crédits Formation : <?php echo $_SESSION['credit']?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="formation.php">Vos formations</a></li>
                <li><a href="reservation.php">Réserver Formations</a></li>
                <?php if($_SESSION['type']==1)echo"<li class='dropdown'>
        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Administration
        <ul class='dropdown-menu'>
          <li><a href='admin.php'>Demande Formations</a></li>
          <li><a href='useradmin.php'>Gestion Utilisateurs</a></li>
          <li><a href='formadmin.php'>Gestion Formation</a></li>
        </ul>
      </li>     ";?> 
    
                <li><a href="destroy.php">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
<?php if(isset($_SESSION['flash'])): ?>
<?php foreach ($_SESSION['flash'] as $type => $message): ?>
    <div class="alert alert-<?= $type; ?>">
        <?= $message; ?>
    </div>
<?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
</Div>