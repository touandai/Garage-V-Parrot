<?php
$titre = "Rendez-vous réparation";

require 'header.php';

require 'entete.php';

require 'menu.php';
?>

<h1>Rendez-vous réparations</h1> 

<main class="container">

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Civilité</th>
            <th>Immatriculation</th>
            <th>Nom</th>
            <th>Telephone</th>
            <th>Type prestation</th>
            <th>Creneaux</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead>

    <?php 

        $req = "SELECT * FROM public.rendez_vous";
        $tdr = $conn -> query($req);
        $resultat = $tdr -> fetchAll();

        foreach($resultat as $key => $value) {
    ?>
    <tbody>
        <tr>
            <td><?php echo $value['civilite']; ?></td>
            <td><?php echo $value['immatriculation']; ?></td>
            <td><?php echo $value['nom']; ?></td>
            <td><?php echo $value['telephone']; ?></td>
            <td><?php echo $value['prestation']; ?></td>
            <td><?php echo $value['creneaux']; ?></td>
            <td><?php echo $value['statut']; ?></td>

            <td>
            <form method="POST" action="">
                <input type="text" value="<?php echo $value['id']; ?>" name="id" readonly>
                <button type="submit" name="envoyer">Valider</button>
            </form>
                </td>
        </tr>
    <?php
        }
    ?>
</table>
</main>

<?php
require 'commun/footer.php';
