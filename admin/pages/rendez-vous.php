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
            <th>Id</th>
            <th>Civilité</th>
            <th>Immatriculation</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Type prestation</th>
            <th>Statut</th>
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
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['civilite']; ?></td>
            <td><?php echo $value['immatriculation']; ?></td>
            <td><?php echo $value['nom']; ?></td>
            <td><?php echo $value['prenom']; ?></td>
            <td><?php echo $value['telephone']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['prestation']; ?></td>
            <td>
            <a href="?page=rendez-vous&action=valider&id=<?php echo $value['id']; ?>">En attente</a>
            <a href="?page=rendez-vous&action=valider&id=<?php echo $value['id']; ?>">Valider</a>
            </td>
        </tr>
    <?php
        }
    ?>
</table>
</main>

<?php
require 'commun/footer.php';
