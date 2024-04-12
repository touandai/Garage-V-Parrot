<?php
$titre = "Modification horaire ouverture";

if(!in_array($userConnecte['roles_id'], [1])){
echo "Vous n'êtes pas l'administrateur";die;

}
require 'header.php';

require 'entete.php';

require 'menu.php';

if(array_key_exists('id',$_GET)){
    $req = "SELECT * FROM public.horairesgarages WHERE id = :id " ;
       
    $tdr = $conn -> prepare($req);
    $tdr -> execute([':id' => $_GET['id']]);
    $resultat = $tdr -> fetch();
    
}
?>

<h1>Formulaire de modification</h1>

<?php
        if(array_key_exists('valider',$_POST))  {
            if(empty($_POST['ouverture_matin'])){
                //redirection suite à une erreur//
            }
            if(empty($_POST['ouverture_soir'])){
                //redirection suite à une erreur//
            }

            $req = "UPDATE public.horairesgarages SET statut_am = :statut_am, statut_pm = :statut_pm WHERE id = :id " ;
            $tdr = $conn -> prepare($req);
            if($tdr -> execute([
                ':id' => $_GET['id'],
                ':statut_am' => $_POST['ouverture_matin'],
                ':statut_pm' => $_POST['ouverture_soir']
            ])){
               header('location:?pages=horaire&id=1');die;
            }
        }

?>

<main class="container">
    <?php
    if(isset($_GET['id']) && ($_GET['id']==1)){
        ?>
        <div style="padding: 20px;color: #ffffff;background: green;text-align:center;">horaire mise à jour!</div>
    <?php
    }
    ?>
    <p>Jour : <?php echo $resultat['jour']; ?></p>
    <p>Matin:
        <?php 
            if ($resultat['statut_am'] ==1 ){
                echo $resultat['heure_debut_am'].'-'. $resultat['heure_de_fin_am'];
            }else {
                  echo "Fermé";
            }
        
        ?>  </p>
    <p>Soir : 
    <?php 
            if ($resultat['statut_pm'] ==1 ){
                echo $resultat['heure_debut_pm'].'-'. $resultat['heure_de_fin_pm']; 
            }else {
                  echo "Fermé";   
            }    
        ?>
                    <form id="avis" class="form" method="POST" action=""> 
                                  <div class="input-row">
                                     <label class="form-label" for="note">Ouverture Matin: *</label>
                                    
                                     <select name="ouverture_matin">
                                        <option value="">----</option>
                                        <option value="1"
                                        <?php 
                                            if ($resultat['statut_am'] ==1 ){
                                                    echo 'selected="selected"';
                                            }   
                                        ?>>Ouvert</option>
                                        <option value="0"
                                        <?php 
                                                if ($resultat['statut_am'] == 0 ){
                                                    echo 'selected="selected"';
                                                }   
                                        ?>>Fermé</option>
                                    </select>
                                  </div>
                                  <div class="input-row">
                                     <label class="form-label" for="note">Ouverture Soir: *</label>
                                     <select name="ouverture_soir">
                                        <option value="">----</option>
                                        <option value="1" 
                                        <?php 
                                                if ($resultat['statut_pm'] ==1 ){
                                                    echo 'selected="selected"';
                                                }   
                                        ?>>Ouvert</option>
                                        <option value="0"
                                        <?php 
                                                if ($resultat['statut_pm'] == 0 ){
                                                    echo 'selected="selected"';
                                                }   
                                        ?>>Fermé</option>
                                    </select>
                                  </div>
                                     <button class="btn btn-primary" type="submit" name="valider" id="button">Modifier</button>
                                  </em>
                    </form>
</main>

<?php
require 'commun/footer.php';