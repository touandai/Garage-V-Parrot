<?php
$titre = "Horaire ouverture du garage";

if(!in_array($userConnecte['roles_id'], [1])){
echo "Vous n'êtes pas l'administrateur";die;
}

require 'header.php';

require 'entete.php';

require 'menu.php';
?>

<h1>Horaire ouverture du garage</h1>


<main class="container">


<table class="table table-striped">
<thead>
  <tr class="table-secondary">
    <th scope="col">Jour</th>
    <th scope="col">Matin</th>
    <th scope="col">Apres-midi</th>
    <th scope="col">Action</th>
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
    <td><a class="btn btn-sm btn-primary" href="?pages=horaire&id=<?php echo $value['id'];?>">Modifier</a></td>
  </tr>
  <?php
  }
  ?>
  
</tbody>
</table>

</main>

<?php
require 'footer.php';