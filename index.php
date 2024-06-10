<?php 
$title =' Accueil, Garage V. Parrot entretien mécanique, carosserie et vente voiture d\'occasion ';

require 'header.php';
require 'nav-apropos.php';
require 'connexion.php';
 ?>
<!--header-->
<!--bandeau nav-->
     
     <main class="container">  
                 <article id="article1" class="container">
                    <a href="repmecanique.php"><img src="images/mecanique.png"></a>
                    
                    <p>Découvrez notre <em> expertise en entretien mécanique</em>
                        <ul>
                            <li>Révision voiture</li>
                            <li>Vidange-Climatisation-Pneus</li>
                            <li>Freinage-Amortisseurs-Courroies</li>
                        </ul>
                    <em>Entretiens mécaniques... </em>
                        <a href="repmecanique.php">en savoir plus</a>
                    </p>
                </article>
                <article id="article2" class="container">
                    <a href="repcarrosserie.php"><img src="images/img-carrosserie.png"></a>
                    
                    <p><em>Elle fait appel à différentes techniques (remplacement, débosselage,
                    redressage,
                    peinture, mastic, etc.)pour réparer les trous, rayures ou bosses sur
                    votre carrosserie.</em>
                    <ul>
                        <li>Le remplacement de la pièce</li>
                        <li>Le redressage - Le débosselage </li>
                    </ul>
                    <em>Réparation carrosserie... </em>
                    <a href="repcarrosserie.php">en savoir plus</a>
                    </p>
                </article>
     </main>


     <aside class="container aside">
            <div id="occaz" class="container rounded">
                <a href="liste-voiture-occasion.php">
                    <em>Notre expertise à votre service.<br>
                    decouvrez nos voitures<br>d'occasion ...
                   </em>
                </a>
            </div>

            <div class="container">
                 <h5 class="text-center"><em>Temoignages et avis clients</em></h5>
                        <?php 

                            $req = "SELECT * FROM public.temoignages ORDER BY date_avis ASC LIMIT 3";
                            $tdr = $conn -> query($req);
                            $resultat = $tdr -> fetchAll();

                            foreach($resultat as $key => $value) {
                        ?>
                <div class="temoignage1">
                    <p>Commentaire posté par : <em class="em"><?php echo $value['nom']; ?> </em> Note attribuée : <b> <em class="em"><?php echo $value['note']; ?></em></b></p>
                    <p><?php echo (empty($value['commentaires'])) ? "<em>Aucun message</em>" : $value['commentaires']; ?></p>
                </div>
                <?php
                    }
                ?>
				<h6 class="text-center"><a href="avis.php" class="text-center ancre">Je donne mon avis</a></h6>
                </div>
        </aside>



        <!--footer-->
        <?php
        require 'footer.php';
        
        ?>