<?php
//On démarre la session //
session_start();
require 'config/connexion.php';


//Racine du projet//
$document_root ="Garage-V-Parrot";

if(!isset($_SESSION['user_data'])) {
  $page = 'login';
}
else{
  $userConnecte = $_SESSION['user_data'];
  $page = 'dashboard';
}
$pages = (isset($_GET['pages'])) ? $_GET['pages'] : "login";

switch($pages) {
  /* Tableau de bord */
  case 'dashboard':
  default:
    require 'pages/tableau-de-bord.php';
    break;
  /*connexion*/
    case 'login';
    require 'pages/login.php';
    break;  
  /* Déconnexion */
  case 'deconnexion';
    require 'pages/deconnexion.php';
    break;
  /* Liste des annonces */
  case 'liste-annonces':
    require 'pages/liste-annonces.php';
    break;
  /* horaire ouverture*/
  case 'horaire-ouverture':
    require 'pages/horaireouverture.php';
     break;
  /* Prise de rendez-vous */
    case 'rendez-vous':
      require 'pages/rendez-vous.php';
      break;
 /* horaires */
    case 'horaire':
      require 'pages/horaire.php';
      break;
 /* horaires */
 case 'ajout-annonce':
  require 'pages/ajout-annonce.php';
  break;
/* Avis et témoignages */
case 'avis':
require 'pages/avis.php';
break;
}
