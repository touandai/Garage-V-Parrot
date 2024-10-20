<?php 
$title ='Voiture d\'occasion, Garage V. Parrot entretien mécanique';

require 'header3.php';
require 'connexion.php';
?>

    <section class="container">
        <div id="section-recherche" class="container input-group">
            <form method="POST" action="recherche.php" class="d-flex">
                <div id="kilometrage">
                    <label class="form-label" for="kilometrage">Kilométrage : </label>
                    <input type="range" name="kilometrage" id="kilometrage" min="20000" max="250000" step="100"  value="200000"/>
                    <br>
                    
                    <button class="btn form-label" id="kilometre"></button>
                    <button class="btn form-label btn-secondary" id="kilometre" type="reset">Réinitialisé</button>
                </div>
                <div id="prix">
                    <label class="form-label" for="prix">Prix : </label>
                    <input type="range" name="prix" id="prix" min="0" max="20000">
                    <br>
                    <button class="btn form-label" id="price"></button>
                    <button class="btn form-label btn-secondary" id="price" type="reset">Réinitialisé</button>
                </div>
                <div id="annees">
                    <label class="form-label" for="annees">Années : *</label>
                    <input type="range" name="annees" id="annees" min="1998" max="2020">
                    <br>
                    <button class="btn form-label" id="annees"></button>
                    <button class="btn form-label btn-secondary" id="annees" type="reset">Réinitialisé</button>
                </div>
            </form>
        </div>
     </section>


     <main id="occasion" class="container">
     <?php
        $req = "SELECT marque, annee, kilometre, prix, image FROM public.annonces LIMIT 6";
        $tdr = $conn -> query($req);
        $resultat = $tdr -> fetchALL();

        foreach($resultat as $key => $value){
      ?>
        <section class="container">
                <img src="admin/upload/images/<?php echo $value['image']; ?>" alt="polo"/></a></div>
            <p class="color-p"> <?php echo $value['marque']; ?><p>
            <ul>
                <li id="annee">Année : <?php echo $value['annee']; ?></li>
                <li id="kilometre">Kilométrage :  <?php echo $value['kilometre']; ?></li>
                <hr>
                <li id="prix">Prix :  <?php echo $value['prix'].'€'; ?></li>
            </ul>
        </section>
        <?php
        }
        ?>
    </main>
    <section class="container expo">
                <a class="detail" href="voitureannonce2.php"><button class="btn btn-danger">Détail</button></a>
                <a class="detail" href="voitureannonce3.php"><button class="btn btn-danger">Détail</button></a>
                <a class="detail" href="voitureannonce4.php"><button class="btn btn-danger">Détail</button></a>
                <a class="detail" href="voitureannonce5.php"><button class="btn btn-danger">Détail</button></a>
                <a class="detail" href="voitureannonce6.php"><button class="btn btn-danger">Détail</button></a>
                <a class="detail" href="voitureannonce1.php"><button class="btn btn-danger">Détail</button></a>
    </section>

    <section class="container">
        <nav aria-label="navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item"></li>
                <a href="#" class="page-link">Précédant</a>
                </li>
                <li class="page-item"></li>
                <a href="#" class="page-link">1</a>
                </li> 
                <li class="page-item"></li>
                <a href="#" class="page-link">2</a>
                </li>  
                <li class="page-item"></li>
                <a href="#" class="page-link">3</a>
                </li> 
                <li class="page-item"></li>
                <a href="#" class="page-link">Suivant</a>
                </li>
            </ul>
        </nav>
    </section>

     <aside id="aside" class="container">
        <p id="vehicules"> En savoir plus ? <a href="contact.php">Contactez-nous,</a></p>
     </aside>

         <!--footer-->
<?php 
    require 'footer.php';
?>