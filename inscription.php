<?php 
$title ='Inscription, Garage V. Parrot entretien mécanique'; 

include 'header2.php'; 
include 'connexion.php';

if(array_key_exists('envoyer',$_POST)) {

   if(empty($_POST)){
         
      /*
      $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$_POST['email']."'");
      if(mysqli_num_rows($select)) {
          exit('Cette adresse email est déjà utilisé');
      }
      */

         function validation_donnees($donnees){

            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }
           
            $nom = validation_donnees($_POST['nom']);
            $prenom = validation_donnees($_POST['prenom']);
            $email = validation_donnees($_POST['email']);
			$password = validation_donnees($_POST['password']);
 
			
			
        $reqInsert = "INSERT INTO public.users (nom, prenom, email, password) 
        values (:nom, :prenom, :email, :password)";
        $tbr = $conn -> prepare($reqInsert);
        $save = $tbr -> execute ([
         ":nom"=>$_POST['nom'],
         ":prenom"=>$_POST['prenom'],
         ":email"=>$_POST['email'],
         ":password"=>$_POST['password'],
        ]);
   }
}
include 'nav-apropos.php';
?>

<br>
<h2 class="text-center">Inscription </h2>

     <main class="container page-inscription">
            <form id="inscription" class="form" method="POST" action="inscription.php">  
                <fieldset>
                    <legend>Créer un compte client?</legend> 
                    <div class="input-row">
                     <label class="form-label" for="nom">Nom : *</label>
                     <input class="form-control form-control-sm" type="text" name="nom" id="nom" placeholder="Dupont">
                     <?php
                        if(isset($_POST['nom'])){
                        echo '<span><font color="red"> Votre Nom est obligatoire</font></span>';
                        }
                     ?>
                    <div class="input-row">
                     <label class="form-label" for="prenom">Prenom : *</label>
                     <input class="form-control form-control-sm" type="text" name="prenom" id="prenom" placeholder="Pierre">
                     <?php
                        if(isset($_POST['prenom'])){
                        echo '<span><font color="red"> Votre Prenom est obligatoire</font></span>';
                        }
                     ?>
        
                    <div class="input-row">
                     <label class="form-label" for="mail">Email/Nom : *</label>
                     <input class="form-control form-control-sm" type="email" name="email" id="email" placeholder="Dupont">
                     <?php
                        if(isset($_POST['email'])){
                        echo '<span><font color="red"> Votre Email est obligatoire</font></span>';
                        }
                     ?>
                    </div>
                    <div class="input-row">
                     <label class="form-label" for="password">Mot de pass: *</label>
                     <input class="form-control form-control-sm" type="password" name="password" id="password" placeholder="mot de pass">
                     <?php
                        if(isset($_POST['password'])){
                        echo '<span><font color="red"> Le Mot de pass est obligatoire</font></span>';
                     }
                     ?>
                    
                    </div>
                     <br>
                     <button class="btn btn-primary" name="envoyer" type="submit" id="envoyer">Envoyer</button>
                     <a href="compteperso.php">Accéder à la page de connexion</a> 
                </fieldset>
            </form> 
             
     </main>
     
<?php
 include 'footer.php'; 
 
?> 
