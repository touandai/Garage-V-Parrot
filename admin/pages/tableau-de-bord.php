<?php
$titre = "Tableau de bord";


require 'header.php';
require 'entete.php';

require 'menu.php';


?>


<h1>Tableau de bord</h1>


<main class="container">
    <h2>Liste des Utilisateurs</h2>

    <table border=2>
        <caption>Comptes Admin</caption>
        <thead>
            <tr class="text-center">
                <th>Role Utilisateur</th>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        
        <tbody>

        <?php
        $reqselect = "SELECT * FROM public.users";

        $pdostatement = $conn -> query ($reqselect);
        
        foreach($pdostatement as $key => $value){
        ?>
            <tr>
                <td><?php echo $value['roles_id']; ?></td>
                <td><?php echo $value['nom']; ?></td>
                <td><?php echo $value['email']; ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>

    </table>
</main>

<?php

require 'footer.php';

?>