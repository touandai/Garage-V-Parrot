<?php
$titre = "Liste des annonces";

require 'header.php';

require 'entete.php';

require 'menu.php';
                    
?>

<h1>Liste des annonces</h1>

<main class="container">

<section>
    <?php
        if(isset($_GET['action_suppression']) && ($_GET['action_suppression'] == 1)) {
    ?>
    <div style="padding: 20px;color: #ffffff;background: red;text-align:center;">
    L'annonce a bien été supprimée avec succès !</div>
    <?php
    }
    ?>
    <table class="table table-striped table-bordered">
        <thead>
                <tr class="text-center table-primary">
                    <th>Id</th>
                    <th>Marque</th>
                    <th>Modele</th>
                    <th>Année</th>
                    <th>Kilometre</th>
                    <th>Prix</th>
                    <th>Energie</th>
                    <th>Date mise en circulation</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
        </thead>
        <tbody>
        <?php 
            $req = "SELECT * FROM public.annonces";
            $tdr = $conn -> query($req);
            $resultat = $tdr -> fetchAll();

            foreach($resultat as $key => $value) {
        ?>
            <tr class="text-center">
                <td><?php echo $value['id'];?></td>
                <td><?php echo $value['marque']; ?></td>
                <td><?php echo $value['modele']; ?></td>
                <td><?php echo $value['annee']; ?></td>
                <td><?php echo $value['kilometre']; ?></td>
                <td><?php echo $value['prix']; ?></td>
                <td><?php echo $value['energie']; ?></td>
                <td><?php
                    setlocale(LC_TIME,'fr');
                    $datefr = strftime('%d/%m/%Y',strtotime($value['date_circulations']));
                    echo $datefr ?>
                </td>
                <td><?php echo $value['description']; ?></td>
                <td>
                    <?php 
                        if(array_key_exists('valider',$_POST))  {
                            
                            $id = $_POST['id'];
                            $reqsupp = 'DELETE FROM public.annonces WHERE id = :id';
                            $statment = $conn -> prepare($reqsupp);
                            $statment -> bindValue(':id',$id);
                            $supp =  $statment -> execute();
                            if($supp) {
                                header('location:?pages=liste-annonces&action_suppression=1');
                                exit();
                            }
                        }
                    ?>
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="<?php echo $value['id'];?>" readonly="true">

                          <button class="btn btn-sm btn-danger" type="submit" name="valider"
                          onclick="return confirm('Vous confirmez cette suppression <?php echo $value['id']; ?> ?')">supprimer</button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>

    </table>
</section>
<br>
<div class="text-center">
    <a class="lien" href="?pages=ajout-annonce">Publier une annonce </a>
</div>

</main>

<?php

require 'commun/footer.php';