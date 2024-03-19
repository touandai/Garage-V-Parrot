<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>Inscription</title>
  <link rel="stylesheet"href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    
<header>
    <div class="logo">
        <img src="images/logo.png"/>
    </div>

    <div class="clear"></div>
</header>

<?php 
require '../connexion.php';

    if(array_key_exists('valider',$_POST)){
        
            if(isset($_POST['nom']) && empty($_POST['nom'])){
            header("location:?nom=1");
            exit();
            }

           if(isset($_POST['email']) && empty($_POST['email'])){
           header("location:?email=1");
           exit();
           }

           if(isset($_POST['password']) && empty($_POST['password'])){
           header("location:?password=1");
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
		   


		   $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


           $verifEmail = 'SELECT * FROM  public.users WHERE email = :email';
           $pdoStatement = $conn -> prepare($verifEmail);
           $pdoStatement -> bindValue(':email', $email);
           $result =  $pdoStatement -> execute ();
           
           if($result == true){
            header("location:?existe=1");
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
			header("location:confirmation.php");die;
            


    } 
    
?>

<h1 class="text-center">Inscription Espace Admin </h1>


<main class="container page-connexion">
            <form class="form" method="POST" action="">

        <div class="inscription">

            <form action="" method="POST">
                <fieldset>
                       <legend>Inscription des employés</legend>
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
                                if(isset($_GET['email']) && ($_GET['email']==1)){
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
                                echo '<strong> Vous devez enregistrer un mot de pass provisoire </strong>';
                                }
                                ?>
                             </div>
                             
                                 <button type="submit" name="valider" id="valider" class="btn btn-primary">Valider</button> 
                             <br><br>
                </fieldset> 

            </form>

        </div>

    </main>
    


    <script>
    let Valider =document.getElementById('valider');
    Valider.addEventListener('click', function (e){
        alert('vous êtes sur le point d\'enregistré un nouvel employé! ')
    })
    </script>
<?php
include 'commun/footer.php';
?>
    
