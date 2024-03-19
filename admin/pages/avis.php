<?php
$titre = "Témoignages et Avis";

require 'header.php';

require 'entete.php';

require 'menu.php';


                if(array_key_exists('valider',$_POST))  {
                    
                    function validation_donnees($donnees){
                        $donnees = trim($donnees);
                        $donnees = stripslashes($donnees);
                        $donnees = htmlspecialchars($donnees);
                        return $donnees;
                        }
                                
                        $id = validation_donnees($_POST['id']);
                        $statut = validation_donnees($_POST['statut']);

                        $reqvalider = 'UPDATE public.temoignages SET statut = :statut, date_validation = :date WHERE id = :id';
                        $statement = $conn -> prepare($reqvalider);
                        $statement -> bindValue(':id',$id);
                        
                        $save = $statement -> execute([

                        ":id" => $_POST['id'],
                        ":statut" => $_POST['statut'],
                        ":date"=> date('Y-m-d h:m:s'),
                        
                        ]);

                        if($save == true){
                        header("location:?pages=avis&modifier=1");
                        }
                        else{
                        echo 'une erreur est survenue';die;
                        }

               }


?>

<h1>Témoignages et Avis</h1>

<main class="container">

    <?php
    if(isset($_GET['modifier']) && ($_GET['modifier'] == 1)) {
    ?>
    <div style="padding: 20px;color: #ffffff;background: green;text-align:center;">Le statut est mis à jour avec succès !</div>
    <?php
    }
    ?>


    <table class="table table-bordered table-sm table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Note</th>
                <th>Commentaires</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        
        <?php 
        $req = "SELECT * FROM public.temoignages ORDER BY date_avis DESC LIMIT 10";
        $tdr = $conn -> query($req);
        $resultat = $tdr -> fetchAll();
        foreach($resultat as $key => $value) {
        ?>

        <tr>
            <td><?php echo $value['nom']; ?></td>
            <td><?php echo $value['note']; ?></td>
            <td><?php echo $value['commentaires']; ?></td>
            <td>
            <?php
            setlocale(LC_TIME,'fr');
            $datefr = strftime('%d/%m/%Y',strtotime($value['date_avis']));
            echo $datefr ?>
            </td>
            <td><?php echo $value['statut']; ?></td>
            <td>
              <!--valider un avis -->
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="<?php echo $value['id']; ?>" readonly="true">
                        
                        <select name="statut">
                            <option value="">--selectionner--</option>
                            <option value="valider">Valider</option>
                        </select>
                          <button type="submit" name="valider">Valider</button>
                    </form>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</main>

<?php
require 'commun/footer.php';
   
