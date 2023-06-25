<!-- début router -->

<?php
require ('../controleur/ControleurDoctolib.php');
require ('../controleur/ControleurAdministrateur.php');
require ('../controleur/ControleurPatient.php');
require ('../controleur/ControleurPraticien.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

$action = $param['action'];

unset($param['action']);

$args = $param;

// --- Liste des méthodes autorisées
switch ($action) {
  case "inscription" :
  case "inscriptionPage" :
  case "connexion" :
  case "connexionPage" :
  case "deconnexion":
  case "deleteCompte" :
    ControleurDoctolib::$action();
    break;

  case "readSpecialites" :
  case "readOneSpecialite" :
  case "getOneSpecialite" :
  case "createSpecialite" :
  case "readNewSpecialite" :
  case "readPraticiens" :
  case "readNbPraticiensParPatient" :
  case "readAll" :
    ControleurAdministrateur::$action($args);
    break;

  case "readInfo" :
  case "readRdv" :
  case "createRdv1" :
  case "createRdv2" :
  case "readNewRdv" :
    ControleurPatient::$action($args);
    break;

  case "readDisponibilites" :
  case "createDisponibilites" :
  case "readNewDisponibilites" :
  case "readRdvPatient" :
  case "readPatients" :
    ControleurPraticien::$action($args);
    break;

 // Tache par défaut
 default:
  $action = "accueilDoctolib";
  ControleurDoctolib::$action();
}
?>

<!-- fin router -->
