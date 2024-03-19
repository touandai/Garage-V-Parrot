<?php 
$title ='Nos horaires, Garage V. Parrot entretien mécanique';
include 'header.php'; 
include 'nav-apropos.php';
include 'connexion.php';

?>   
      <br>
      <h2 class="text-center">Nos horaires</h2>
      <main id="propos" class="container">
        <section id="horaires" class="container">
          <?php
          
          ?>
          <table class="table table-striped caption-top">
                <thead>
                  <tr>
                    <th scope="col">Jour</th>
                    <th scope="col">Matin</th>
                    <th scope="col">Apres-midi</th>
                  </tr>
                </thead>

                <tbody>
                     <?php
                        $req = "SELECT * FROM public.horairesgarages ORDER BY id ASC" ;
                        $tdr = $conn -> query($req);
                        $resultat = $tdr -> fetchAll();
                        foreach($resultat as $key => $value) {
                     ?>

                  <tr>
                     <td scope="row"><?php echo $value['jour'];?></td>
                     <td>
                    <?php 
                     if($value['statut_am'] == 1 ){
                        echo $value['heure_debut_am'].' à ' .$value['heure_de_fin_am'];
                     }
                     else {
                        echo "Fermé";
                     } 
                     ?>
                     </td>
                     <td>
                   <?php 
                     if($value['statut_pm'] == 1 ){
                        echo $value['heure_debut_pm'].' à ' .$value['heure_de_fin_pm'];
                     }
                     else {
                        echo "Fermé";
                     } 
                     ?>
                  </td>                   
      
                  </tr>
                  <?php
                      }
                     ?>  
               </tbody>
            </table>
        </section>
   </main>


<!--footer-->
<?php include 'footer.php'; ?>