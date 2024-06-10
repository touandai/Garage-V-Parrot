<?php
$titre = "Publier des annonces";
if(!in_array($userConnecte['roles_id'], [1,2])){
    echo "Vous n'êtes ni admin ni un employé";die;
    }
require 'header.php';

require 'entete.php';

require 'menu.php';


if(array_key_exists('envoyer', $_POST)) {
		 
    $ImagesVoitures = explode('/', $_FILES['image']['type']);
    $extensionImage = end($ImagesVoitures);
    $nouveauNomImage = sha1(md5(time())) . "." . $extensionImage;

    if(isset($_POST['marque']) && empty($_POST['marque'])){
        header("location:?pages=ajout-annonce&marque=1");
        exit();
    }
    if(isset($_POST['modele']) && empty($_POST['modele'])){
        header("location:?pages=ajout-annonce&modele=1");
        exit();
    }
    if(isset($_POST['annee']) && empty($_POST['annee'])){
        header("location:?pages=ajout-annonce&annee=1");
        exit();
    }
    if(isset($_POST['kilometre']) && empty($_POST['kilometre'])){
        header("location:?pages=ajout-annonce&kilometre=1");
        exit();
    }
    if(isset($_POST['prix']) && empty($_POST['prix'])){
        header("location:?pages=ajout-annonce&prix=1");
        exit();
    }
    if(isset($_POST['energie']) && empty($_POST['energie'])){
        header("location:?pages=ajout-annonce&energie=1");
        exit();
    }
    if(isset($_POST['date_circulation']) && empty($_POST['date_circulation'])){
        header("location:?pages=ajout-annonce&date_circulation=1");
        exit();
    }
        if(false === move_uploaded_file($_FILES['image']['tmp_name'], "upload/images/" . $nouveauNomImage)) {
        header('location:?pages=ajout-annonce&image=1');
        exit();

    }
        if(isset($_POST['description']) && empty($_POST['description'])){
        header("location:?pages=ajout-annonce&description=1");
        exit();
    }

    function validation_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
        }
    
        $marque = validation_donnees($_POST['marque']);
        $modele = validation_donnees($_POST['modele']);
        $annee = validation_donnees($_POST['annee']);
        $kilometre = validation_donnees($_POST['kilometre']);
        $prix = validation_donnees($_POST['prix']);
        $energie = validation_donnees($_POST['energie']);
        $date_circulation = validation_donnees($_POST['date_circulation']);
        $description = validation_donnees($_POST['description']);
		$image = $_FILES['image']['name'];
        
                $InsertAnnonce ='INSERT INTO public.annonces(marque, modele, annee, kilometre, prix, energie, description, date_circulations, date_publication, image)
                values (:marque, :modele, :annee, :kilometre, :prix, :energie, :description, :date_circulation, :date, :image)';
                
                $reqInsertion = $conn -> prepare ($InsertAnnonce);
                $save = $reqInsertion->execute([
                
                ":marque" => $marque,
                ":modele" => $modele,
                ":annee" => $annee,
                ":kilometre" =>$kilometre,
                ":prix" => $prix,
                ":energie" => $energie,
                ":date_circulation" => $date_circulation,
                ":description" => $description,
                ":date" =>date('Y-m-d h:m:s'),
                ":image" => $nouveauNomImage,

                ]);
                if($save){
                    header('location:?pages=ajout-annonce&valider=1');
                }
}


?>
<h1>Formulaire d'ajout des annonces </h1>

<main class="container">
    <?php
    if(isset($_GET['valider']) && ($_GET['valider'] == 1)) {
    ?>
    <div style="padding: 20px;color: #ffffff;background: green;text-align:center;">Enregistré avec succès !</div>
    <?php
    }
    ?>
    <section class="container">

        <form method="POST" action="" enctype="multipart/form-data">
            <fieldset>
                 <legend>Enregistrer une annonce</legend>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label"><b> Marque : *</b></label>
                            <select class="form-control" name="marque">
                                            <option value="">--Indiquer votre civilité--</option>
                                            <option value="Peugeot">Peugeot</option>
                                            <option value="Renault">Renault</option>
                                            <option value="Fiat">Fiat</option>
                                            <option value="Wolswaghen">Wolswaghen</option>
                            </select>
                            <?php
                            if(isset($_GET['marque']) ==1 ){
                            echo "<strong> Veuillez selectionner la marque!</strong>";
                            }
                            ?>
                        </div>
                        <div class="col">
                                <label class="form-label"><b>Modele : *</b></label>
                                <input class="form-control" type="text" name="modele" maxlength="15">
                            </div>
                            <?php if(isset($_GET['modele']) ==1){
                            echo "<strong> Veuillez indiquer le modele!</strong>";
                            }
                            ?>
                    </div>

                    <div class="row mb-3">
                            <div class="col">
                                <label class="form-label"><b>Annee : *</b></label>
                                <select class="form-control" name="annee">
                                            <option value="">--Selectionner--</option>
                                           <?php for ($i=2000; $i<= 2024; $i++){
                                           ?>
                                            <option value="<?php echo $i ?>"><?php echo $i?></option>
                                            <?php
                                           }
                                           ?>
                               </select>
                            <?php if(isset($_GET['annee']) ==1){
                            echo "<strong> Veuillez indiquer l'année !</strong>";
                            }
                            ?>
                            </div>
                            <div class="col">
                                <label class="form-label"><b> Kilometre : *</b></label>
                                <input class="form-control" type="number" name="kilometre" maxlength="15">
                            <?php if(isset($_GET['kilometre']) ==1){
                                echo "<strong> Ce champ est obligatoire!</strong>";
                                }
                                ?>
                            </div>
                    <div class="row mb-3">
                            <div class="col">
                                <label class="form-label"><b>Prix : *</b></label>
                                <input class="form-control" type="text" name="prix" maxlength="15"> 
                                <?php if(isset($_GET['prix']) ==1){
                                echo "<strong>Ce champ est obligatoire!</strong>";
                                }
                                ?>
                            </div>
                            <div class="col">
                                <label class="form-label"><b> Energie : *</b></label>
                                <select class="form-control" name="energie">
                                            <option value="">--Selectionner--</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="Essence">Essence</option>
                               </select>
                            <?php if(isset($_GET['energie']) ==1){
                                echo "<strong>Ce champ est obligatoire!</strong>";
                                }
                                ?>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <div class="col">
                                <label class="form-label"><b>Date de circulation : *</b></label>
                                <input class="form-control" type="date" name="date_circulation" max=2023-12-31>
                                <?php if(isset($_GET['date_circulation']) ==1){
                                echo "<strong>Ce champ est obligatoire!</strong>";
                                }
                                ?>
                            </div>

                            <div class="col">
                                <label class="form-label"><b> Image : *</b></label>
                                <input class="form-control" type="file" maxlength="30" name="image">
                                <?php if(isset($_GET['image']) == 1){
                                echo "<strong> Choisir une photo!</strong>";
                                }
                                ?>
                            </div>
                    </div>
									
					<div>
                        <label class="form-label"><b> Description : *</b></label>
                        <textarea class="form-control" name="description"></textarea>
                        <?php if(isset($_GET['description']) ==1){
                        echo "<strong> Ce champ est obligatoire!</strong>";
                        }
                        ?>
					</div>
                    <div class="text-center p-3">
                        <button class="btn btn-primary" name="envoyer" id="envoyer" type="submit">Envoyer</button>
                    </div>
                    <br>
            </fieldset>
        </form>
    </section>
</main>

<?php
require 'commun/footer.php';