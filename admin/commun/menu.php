<!DOCTYPE html>
<html>
<head>
  <title>Menu</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link rel="stylesheet"href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css"/>
</head>
<body>

<div class="menu">
    <a href="?include=tableau-de-bord">Tableau de bord</a>
    <!-- Les annonces : on autorise l'administrateur et les employés à voir les informations -->
    <?php if(in_array($userConnecte['roles_id'], [1, 2])) : ?>
    <a href="?include=liste-annonces">Annonces</a>
    <?php endif; ?>

    <!-- Les horaires d'ouverture : on autorise seul l'administrateur à voir les informations -->
    <?php if(in_array($userConnecte['roles_id'], [1])) : ?>
    <a href="?include=horaire-ouverture">Definir Horaires d'ouverture</a>
    <?php endif; ?>

    <!-- Les témoignages et avis : on autorise l'administrateur et les employés à voir les informations -->
    <?php if(in_array($userConnecte['roles_id'], [1, 2])) : ?>
    <a href="?include=avis">Témoignages & Avis</a>
    <?php endif; ?>

     <!-- Gestion rendez-vous : on autorise l'administrateur et les employés à voir les informations -->
     <?php if(in_array($userConnecte['roles_id'], [1, 2])) : ?>
    <a href="?include=rendez-vous">Gérer les Rendez-vous</a>
    <?php endif; ?>

</div>

</body>
</html>