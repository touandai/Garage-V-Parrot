<?php
$titre = "Tableau de bord";

require 'header.php';
require 'entete.php';
require 'menu.php';

    if(array_key_exists('valider',$_POST)){
        
        if(isset($_POST['nom']) && empty($_POST['nom'])){
        header("location:?pages=dashboard&nom=1");
        exit();
        }
        if(isset($_POST['email']) && empty($_POST['email'])){
        header("location:?pages=dashboard&email=1");
        exit();
        }
        if(isset($_POST['password']) && empty($_POST['password'])){
        header("location:?pages=dashboard&password=1");
        exit();
        }
		             
		function validation_donnees($donnees){
		$donnees = htmlspecialchars($donnees);
		$donnees = stripslashes($donnees);
		$donnees = htmlspecialchars($donnees);
		return $donnees;
		}
		   
           $nom = validation_donnees($_POST['nom']);
           $email = validation_donnees($_POST['email']);
		   $password = validation_donnees ($_POST['password']);

		   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

           $verifEmail = 'SELECT * FROM  public.users WHERE email = :email';
           $pdoStatement = $conn -> prepare($verifEmail);
           $pdoStatement -> bindValue(':email', $email);
           $result =  $pdoStatement -> execute ();
           
           if($result == true){
            header("location:?pages=dashboard&existe=1");
           }
           
            $reqInsert ='INSERT INTO public.users (nom, email, password, date_creation)
            values (:nom, :email, :password, :date)';
            
            $tbr = $conn -> prepare ($reqInsert);
            $tbr -> execute([
			
            ":nom" => ($_POST['nom']),
            ":email" => ($_POST['email']),
            ":password" => $_POST['password'],
            ":date" => date('Y-m-d h:m:s'),

            ]);
		header("location:?pages=dashboard&confirmation=1");
    }
?>

<h1>Tableau de bord</h1>


<main id="dashboard" class="container">
   <section>
        <h2>Liste des Utilisateurs</h2>
            <table border=2>
                <caption>Comptes Utilisateurs Administrateurs</caption>
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
    </section>

    <?php
        if ($_SESSION['user_data']['roles_id']==1){
    ?>

    <section>
        <h2> Inscrire un Membre </h2>
         <?php if (isset($_GET['confirmation']) && ($_GET['confirmation']==1)){
         ?>
          <div style="padding: 20px;color: #ffffff;background: green;text-align:center;">
           Nouveau membre ajouté avec succès! </div>
        <?php
        }
        ?>
        <form class="form" action="" method="POST">
                <fieldset>
                       <legend> Inscription </legend>
                             <div class="mb-3">
                                <label class="form-label" for="nom">Nom * :</label>
                                <input class="form-control" type="text" name="nom">
                                <?php
                                if(isset($_GET['nom']) && ($_GET['nom']==1)){
                                echo '<strong> Veuillez saisir un nom </strong>';
                                }
                                ?>
                             </div>

                             <div class="mb-3">
                                <label class="form-label" for="email">Email *</label>
                                <input class="form-control" type="email" name="email">
                                <?php
                                if(isset($_GET['email']) && empty($_GET['email']==1)){
                                echo '<strong> Veuillez enregistrer un email </strong>';
                                }else if (isset($_GET['existe']) && ($_GET['existe']==1)){
                                    echo '<strong> Un compte existe déjà avec cet email, identifiez-vous ! </strong>';
                                    }
                                    ?>
                             </div>

                             <div class="mb-3">
                                <label class="form-label" for="password">Mot de pass *</label>
                                <input class="form-control" type="password" name="password">
                                <?php
                                if(isset($_GET['password']) && ($_GET['password']==1)){
                                echo '<strong> Vous devez enregistrer un mot de passe provisoire </strong>';
                                }
                                ?>
                             </div>
                             
                                 <button type="submit" name="valider" id="valider" class="btn btn-primary">Valider</button> 
                             <br><br>
                </fieldset>

            </form>

        </div>
    </section>
    <?php
    }
    ?>
</main>

<?php
require 'footer.php';

?>