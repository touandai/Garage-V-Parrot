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
                <th>Intitulé</th>
            </tr>
        </thead>
        
        <tbody>

        <?php
        $reqselect = "SELECT nom, email, roles_id, name FROM public.users JOIN public.roles ON users.roles_id = roles.id";

        $pdostatement = $conn -> query ($reqselect);
        
        foreach($pdostatement as $key => $value){
        ?>
            <tr class="text-center">
                <td><?php echo $value['roles_id']; ?></td>
                <td><?php echo $value['nom']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td><?php echo $value['name']; ?></td>
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