<?php
ob_start();
require_once 'include/navbar.php';
echo  var_dump($_SESSION);
?>


<body class="connect">
<div class="container">

    <aside class="aside1">
        <h1 class ="title text-center">Bienvenue dans votre espace formation! </h1>



                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h4>Votre dernière formation:</h4>
                                    <p>Fomation Office</p>
                                    <p><br/><a href="#" class="btn btn-theme">En savoir plus</a></p>
                                </div>
                                <div class="col-lg-4">

                                    <h4>Votre prochaine Formation:</h4>
                                    <p>Tous merise en 2 jours tkt ma gueule</p>
                                    <p><br/><a href="#" class="btn btn-theme">En savoir plus</a></p>
                                </div>
                                <div class="col-lg-4">

      
                                    <h4>Nouvelles Formations disponibles </h4>
                                    <p></p>
                                    <p><br/><a href="#" class="btn btn-theme">En savoir plus</a></p>
                                </div>
                            </div>
                        </div>

                        
        </div>
    </div>
    
    
            </div>
           
</body>
    <?php
      ob_end_flush();       
      ?>