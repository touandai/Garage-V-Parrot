<?php 
//demarrage session
session_start();
$title ='Avis client';
require 'header2.php';
require 'connexion.php';

//var_dump($_SESSION['erreur']);die;//

$confirm ='Votre avis est bien enregistré !';

$environnement = "dev";
switch($environnement) {
   case 'dev': ini_set("display_errors", true); break;
   case 'prod' : ini_set("display_errors", false); break;
}

//echo "<pre>";//
//var_dump($_SESSION['erreur']);die;//

if(array_key_exists('valider',$_POST))  {
   //var_dump(date('Y-m-d h:m:s'));die;//
       $erreur = [];
       if(isset($_POST["nom"]) && empty($_POST["nom"])){
         $erreur['test_champ_nom']="Votre nom est obligatoire";
       }
       if(isset($_POST["note"]) && empty($_POST["note"])){
         $erreur['test_champ_note']="Veuillez choisir une note";
       }

      if(!empty($erreur)){
      
        $_SESSION['erreur']=$erreur;
        header("Location:?erreur=1");
        exit();
      }
	  
        function validationdonnees($donnees){
                $donnees = trim($donnees);
                $donnees = stripslashes($donnees);
                $donnees = htmlspecialchars($donnees);
                return $donnees;
         }
			
			$nom =validationdonnees($_POST['nom']);
			$note =validationdonnees($_POST['note']);
			$message =validationdonnees($_POST['message']);
			
      // echo "Tous les champs sont bien remplis";die;//

       $reqInsert = "INSERT INTO public.temoignages (nom, commentaires, note, date_avis, statut)
       values (:nom, :message, :note, :date, :statut)";

       $tbr = $conn -> prepare($reqInsert);
       $save = $tbr -> execute ([
	   
       ":nom"=>$_POST['nom'],
	     ":note"=> (!empty($_POST['note'])) ? $_POST['note'] : 0,
       ":message"=>$_POST['message'],
       ":date"=>date('Y-m-d h:m:s'),
       ":statut"=> "En attente de validation",
      ]);
     


      if($save){
        unset($_SESSION['erreur']);
         header("Location:?save=1");
         exit();
         //header("location:index.php")//
   
         }else { 
         header("Location:?save=0");
         }
}

require 'nav-apropos.php';
 ?>
 <br>
 <h2 class="text-center">Temoignage et Avis</h2>
     
<main id="page-avis" class="container">

                    <form id="avis" class="form" method="POST" action="">
                    <fieldset>
                             <legend><em>Laissez-nous votre avis</legend>
                              
                                  <p class="red">Les champs précédés d'asterix sont obligatoires *</p>   
                                  <div class="input-row">
                                     <label class="form-label" for="nom">Nom : *</label>
                                     <input class="form-control form-control-sm" type="text" name="nom" id="nom" placeholder="Dupont">
                                    
                                    <?php
                                      if(isset($_SESSION['erreur']) && isset($_SESSION['erreur']['test_champ_nom']) ){
                                        echo '<span><font color="red">'.$_SESSION['erreur']['test_champ_nom'].'</font></span>';
                                      }
                                      ?>
                                     
                                  </div>
                                  <br/>
                                  <div class="input-row">
                                     <label class="form-label" for="note">Notes : *</label>
                                     <input type="number" name="note" id="note" min="0" max="10">
                                     <?php
                                      if(isset($_SESSION['erreur']) && isset($_SESSION['erreur']['test_champ_note']) ){
                                       echo '<span><font color="red">'.$_SESSION['erreur']['test_champ_note'].'</font></span>';
                                     }
                                     ?>
                                    </div>
                                  <div class="input-row">
                                     <label class="form-label" for="message">Commentaire:  </label>
                                     <textarea class="form-control" name="message" id="message" placeholder=" Donner votre avis..."></textarea>
                                    </div>
                                  <br>
                                     <button class="btn btn-primary" type="submit" name="valider" id="button">Laisser votre avis</button>
                                  </em>
                                  <?php
                                      if(isset($_GET['save']) && ($_GET['save'] == 1) ){
                                        header("location:confirmation.php");
                                      }
                                      ?>
                    </fieldset>
                    </form>
      
</main>

<!--footer-->
<?php require 'footer.php'; ?>
 
