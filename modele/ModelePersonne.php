<!-- ----- debut ModelePersonne -->

<?php

require_once 'Modele.php';

class ModelePersonne {
  const ADMINISTRATEUR = 0;
  const PRATICIEN = 1;
  const PATIENT = 2;

 private $id, $nom, $prenom, $adresse, $login, $password, $statut, $specialite_id;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id=NULL, $nom=NULL, $prenom=NULL, $adresse=NULL, $login=NULL, $password=NULL, $statut=NULL, $specialite_id=NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->nom = $nom;
   $this->prenom = $prenom;
   $this->adresse = $adresse;
   $this->login = $login;
   $this->password = $password;
   $this->statut = $statut;
   $this->specialite_id = $specialite_id;
  }
 }

 public function setId($id) {
  $this->id = $id;
 }

 public function setNom($nom) {
  $this->nom = $nom;
 }

 public function setPrenom($prenom) {
  $this->prenom = $prenom;
 }

 public function setAdresse($adresse) {
  $this->adresse = $adresse;
 }

 public function setLogin($login) {
  $this->login = $login;
 }

 public function setPassword($password) {
  $this->password = $password;
 }

 public function setStatut($statut){
  $this->statut = $statut;
}

  public function setStatutString($statut){
    switch ($statut) {
        case "Administrateur":
            $this->statut = self::ADMINISTRATEUR;
            break;
        case "Praticien":
            $this->statut = self::PRATICIEN;
            break;
        case "Patient":
            $this->statut = self::PATIENT;
            break;

        default:
            break;
    }
  }

 public function setSpecialiteId($specialite_id) {
  $this->specialite_id = $specialite_id;
 }

 public function setSpecialiteIdString($specialite) {
   $listeSpecialites = $this->getListeSpecialites();
       foreach ($listeSpecialites as $specialiteData) {
           if ($specialiteData['label'] === $specialite) {
               $this->specialite_id = $specialiteData['id'];
               break;
           }
       }
 }

 public function getId() {
  return $this->id;
 }

 public function getNom() {
  return $this->nom;
 }

 public function getPrenom() {
  return $this->prenom;
 }

 public function getAdresse() {
  return $this->adresse;
 }

 public function getLogin() {
  return $this->login;
 }

 public function getPassword() {
  return $this->password;
 }

 public function getStatut() {
  return $this->statut;
 }

 public function getSpecialiteId() {
  return $this->specialite_id;
 }

 public function checkInfos($login, $mdp) {
  try {
      $database = Modele::getInstance();

      // Vérification des informations de connexion dans la base de données
      $query = "SELECT * FROM personne WHERE login = :login AND password = :password";
      $statement = $database->prepare($query);
      $statement->execute(['login' => $login, 'password' => $mdp]);
      // Récupération de la ligne correspondante dans le résultat de la requête
      $row = $statement->fetch(PDO::FETCH_ASSOC);

      // Vérification si les informations de connexion sont valides
      $count = $statement->rowCount();
      if ($count > 0) {
        // Initialisation des attributs de la classe avec les valeurs de la ligne récupérée
        $this->id = $row['id'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->adresse = $row['adresse'];
        $this->login = $row['login'];
        $this->password = $row['password'];
        $this->statut = $row['statut'];
        $this->specialite_id = $row['specialite_id'];
      }

      return ($count > 0);
    } catch (PDOException $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return -1;
    }
}

public function insert(){
    try {
        $database = Modele::getInstance();

        // Vérification si la personne existe déjà dans la base de données
        $query = "SELECT COUNT(*) FROM personne WHERE login = :login";
        $statement = $database->prepare($query);
        $statement->execute(['login' => $this->login]);
        $count = $statement->fetchColumn();

        if ($count > 0) {
            return -1;
        } else {
            // Trouve le nouvel ID unique
            $query = "SELECT MAX(id) FROM personne";
            $statement = $database->query($query);
            $maxId = $statement->fetchColumn();
            $newId = $maxId + 1;

            // Ajout de la personne à la base de données avec le nouvel ID
            $query = "INSERT INTO personne (id, nom, prenom, adresse, login, password, statut, specialite_id)
                      VALUES (:id, :nom, :prenom, :adresse, :login, :password, :statut, :specialite_id)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $newId,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'adresse' => $this->adresse,
                'login' => $this->login,
                'password' => $this->password,
                'statut' => $this->statut,
                'specialite_id' => $this->specialite_id
            ]);

            // Initialise les attributs de la classe avec les valeurs insérées
            $this->id = $newId;

            return 0;
        }
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

public static function deletePersonne(){
    try {
        $database = Modele::getInstance();

        // Suppression du compte de l'utilisateur
        $query = "DELETE FROM personne WHERE id = :id";
        $statement = $database->prepare($query);
        $statement->execute(['id' => $_SESSION['id']]);

        // Suppression des rendez-vous associés à l'utilisateur
        $query = "DELETE FROM rendezvous WHERE patient_id = :patient_id OR praticien_id = :praticien_id";
        $statement = $database->prepare($query);
        $statement->execute(['patient_id' => $_SESSION['id'], 'praticien_id' => $_SESSION['id']]);

        // Déconnexion de l'utilisateur
        //session_destroy();

        // Retourner une valeur ou un message de succès si nécessaire
        return true;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
    }
}


/* --- méthodes administrateur --- */

//liste des spécialités
public static function getListeSpecialites() {
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des spécialités
        $query = "SELECT id, label FROM specialite"; // Spécifiez les colonnes que vous souhaitez récupérer
        $statement = $database->query($query);
        $listeSpecialites = $statement->fetchAll(PDO::FETCH_ASSOC); // Utilisez FETCH_ASSOC pour obtenir un tableau associatif

        return $listeSpecialites;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//sélection d'une spécialité par son id
public static function getSpecialiteById($id){
    try {
        $database = Modele::getInstance();

        // Récupération de la spécialité
        $query = "SELECT * FROM specialite WHERE id = :id";
        $statement = $database->prepare($query);
        $statement->execute(['id' => $id]);
        $specialite = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $specialite;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//liste des id des spécialités
public static function getListeIdSpecialites() {
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des id des spécialités
        $query = "SELECT id FROM specialite";
        $statement = $database->query($query);
        $listeIdSpecialites = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $listeIdSpecialites;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//insertion d'une spécialité
public static function insertSpecialite($label){
    try {
        $database = Modele::getInstance();

        // Trouve le nouvel ID unique
        $query = "SELECT MAX(id) FROM specialite";
        $statement = $database->query($query);
        $tuple = $statement->fetch();
        $newId = $tuple[0];
        $newId++;

        // Ajout de la spécialité à la base de données avec le nouvel ID
        $query = "INSERT INTO specialite (id, label) VALUES (:id, :label)";
        $statement = $database->prepare($query);
        $statement->execute([
            'id' => $newId,
            'label' => $label
        ]);

        return $newId;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }

}

//liste des personnes de statut praticien avec leur spécialité
public static function getListePraticiens(){
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des praticiens
        $query = "SELECT personne.id, personne.nom, personne.prenom, personne.adresse, specialite.label as specialite_label FROM personne JOIN specialite ON personne.specialite_id = specialite.id WHERE personne.statut =1";
        $statement = $database->query($query);
        $listePraticiens = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listePraticiens;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}


//nombre de praticiens par patient dans la table rendezvous(id, patient_id, praticien_id, date, praticien_id, rdv_date)
public static function getNbPraticiensParPatient() {
    try {
        $database = Modele::getInstance();

        // Récupération du nombre de praticiens par patient avec les noms et prénoms
        $query = "SELECT CONCAT(prenom, ' ', nom) AS patient, COUNT(DISTINCT praticien_id) AS nbPraticiens
                  FROM personne
                  INNER JOIN rendezvous ON personne.id = rendezvous.patient_id
                  GROUP BY patient_id";
        $statement = $database->query($query);
        $nbPraticiensParPatient = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $nbPraticiensParPatient;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//info : ensemble de tableaux avec leurs données : liste des spécialités, liste des praticiens, liste des patients, liste des administrateurs, liste de tous les rendez-vous
public static function getAll(){
    try {
        $database = Modele::getInstance();

        $Tab = array();

        // Récupération de la liste des spécialités
        $query = "SELECT * FROM specialite";
        $statement = $database->query($query);
        $listeSpecialites = $statement->fetchAll(PDO::FETCH_ASSOC);
        $Tab[0] = $listeSpecialites;

        // Récupération de la liste des praticiens
        $query = "SELECT id, nom, prenom, adresse FROM personne WHERE statut = 1";
        $statement = $database->query($query);
        $listePraticiens = $statement->fetchAll(PDO::FETCH_ASSOC);
        $Tab[1] = $listePraticiens;

        // Récupération de la liste des patients
        $query = "SELECT id, nom, prenom, adresse FROM personne WHERE statut = 0";
        $statement = $database->query($query);
        $listePatients = $statement->fetchAll(PDO::FETCH_ASSOC);
        $Tab[2] = $listePatients;

        // Récupération de la liste des administrateurs
        $query = "SELECT id, nom, prenom, adresse FROM personne WHERE statut = 2";
        $statement = $database->query($query);
        $listeAdministrateurs = $statement->fetchAll(PDO::FETCH_ASSOC);
        $Tab[3] = $listeAdministrateurs;

        // Récupération de la liste de tous les rendez-vous
        $query = "SELECT * FROM rendezvous";
        $statement = $database->query($query);
        $listeRendezVous = $statement->fetchAll(PDO::FETCH_ASSOC);
        $Tab[4] = $listeRendezVous;

        return $Tab;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

/* --- methodes praticien --- */

//liste de mes disponibilités
public static function getMesDisponibilites()
{
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des disponibilités
        $query = "SELECT id, rdv_date FROM rendezvous WHERE patient_id = 0 AND praticien_id = :praticien_id";
        $statement = $database->prepare($query);
        $statement->execute(['praticien_id' => $_SESSION['id']]);
        $listeDisponibilites = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Extraction de la date et de l'heure
        foreach ($listeDisponibilites as &$disponibilite) {
            $dateHeure = explode(' à ', $disponibilite['rdv_date']);
            $disponibilite['date'] = $dateHeure[0];
            $disponibilite['heure'] = $dateHeure[1];
            unset($disponibilite['rdv_date']);
        }

        return $listeDisponibilites;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}


//ajout de nouvelles disponibilités
public static function insertDisponibilites($date, $nbRdv){
    try {
        $database = Modele::getInstance();

        $date_complete = $date . " à 10h00";

        $Tab = array();

        // Trouve le nouvel ID unique
        $query = "SELECT MAX(id) FROM rendezvous";
        $statement = $database->query($query);
        $maxId = $statement->fetchColumn();
        $newId = $maxId + 1;

        // Ajout des disponibilités à la base de données
        $query = "INSERT INTO rendezvous (id, patient_id, praticien_id, rdv_date) VALUES (:id, 0, :praticien_id, :rdv_date)";
        $statement = $database->prepare($query);
        $statement->execute([
            'id' => $newId,
            'praticien_id' => $_SESSION['id'],
            'rdv_date' => $date_complete
        ]);

        $Tab[0]['date'] = $date;
        $Tab[0]['heure'] = "10h00";

        // Ajout des rendez-vous successifs à la base de données
        $t = 10;
        for ($i = 1; $i < $nbRdv; $i++) {
            $t++;
            $date_complete = $date . " à " . $t . "h00";
            $Tab[$i]['date'] = $date;
            $Tab[$i]['heure'] = $t . "h00";
            $newId++;
            $query = "INSERT INTO rendezvous (id, patient_id, praticien_id, rdv_date) VALUES (:id, 0, :praticien_id, :rdv_date)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $newId,
                'praticien_id' => $_SESSION['id'],
                'rdv_date' => $date_complete
            ]);
        }

        return $Tab;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//liste de mes rendez-vous avec le nom des patients
public static function getRendezVousPraticien(){
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des rendez-vous
        $query = "SELECT personne.nom, personne.prenom, rendezvous.rdv_date FROM rendezvous JOIN personne ON rendezvous.patient_id = personne.id WHERE rendezvous.praticien_id = :praticien_id";
        $statement = $database->prepare($query);
        $statement->execute(['praticien_id' => $_SESSION['id']]);
        $listeRendezVous = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listeRendezVous;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//liste de mes patients sans doublons
public static function getMesPatients(){
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des patients
        $query = "SELECT DISTINCT personne.nom, personne.prenom, personne.adresse FROM rendezvous JOIN personne ON rendezvous.patient_id = personne.id WHERE rendezvous.praticien_id = :praticien_id";
        $statement = $database->prepare($query);
        $statement->execute(['praticien_id' => $_SESSION['id']]);
        $listePatients = $statement->fetchAll(PDO::FETCH_CLASS, "ModelePersonne");

        return $listePatients;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

/* --- methodes patient --- */

// liste des disponibilités d'un praticien
public static function getDisponibilitesPraticien($praticien_id){
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des disponibilités
        $query = "SELECT rdv_date as rendez_vous FROM rendezvous WHERE patient_id = 0 AND praticien_id = :praticien_id";
        $statement = $database->prepare($query);
        $statement->execute(['praticien_id' => $praticien_id]);
        $listeDisponibilites = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $listeDisponibilites;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//informations sur le patient (visiteur)
public static function getMesInformations(){
    try {
        $database = Modele::getInstance();

        // Récupération des informations du patient
        $query = "SELECT * FROM personne WHERE id = :patient_id";
        $statement = $database->prepare($query);
        $statement->execute(['patient_id' => $_SESSION['id']]);
        $listeInformations = $statement->fetchAll(PDO::FETCH_CLASS, "ModelePersonne");

        return $listeInformations;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//liste de mes rendez-vous avec le nom des praticiens
public static function getRendezVousPatient(){
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des rendez-vous
        $query = "SELECT personne.nom as nom, personne.prenom as prenom, rendezvous.rdv_date as rdv FROM rendezvous JOIN personne ON rendezvous.praticien_id = personne.id  WHERE rendezvous.patient_id = :patient_id";
        $statement = $database->prepare($query);
        $statement->execute(['patient_id' => $_SESSION['id']]);
        $listeRendezVous = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listeRendezVous;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}
//prise de rendez-vous avec un praticien
public static function insertRendezVous($praticien_id, $rdv_date){
    try {
        $database = Modele::getInstance();

        // Trouve le nouvel ID unique
        $query = "SELECT MAX(id) FROM rendezvous";
        $statement = $database->query($query);
        $maxId = $statement->fetchColumn();
        $newId = $maxId + 1;

        // Ajout du rendez-vous à la base de données
        $query = "INSERT INTO rendezvous (id, patient_id, praticien_id, rdv_date) VALUES (:id, :patient_id, :praticien_id, :rdv_date)";
        $statement = $database->prepare($query);
        $statement->execute([
            'id' => $newId,
            'patient_id' => $_SESSION['id'],
            'praticien_id' => $praticien_id,
            'rdv_date' => $rdv_date
        ]);

        return $newId;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}

//récupération d'un rendez-vous par id
public static function getRendezVousPatientById($id){
    try {
        $database = Modele::getInstance();

        // Récupération de la liste des rendez-vous
        $query = "SELECT personne.nom as nom, personne.prenom as prenom, rendezvous.rdv_date as rdv FROM rendezvous JOIN personne ON rendezvous.praticien_id = personne.id  WHERE rendezvous.id = :id";
        $statement = $database->prepare($query);
        $statement->execute(['id' => $id]);
        $listeRendezVous = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $listeRendezVous;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
}


}
?>

<!-- ----- fin ModelePersonne -->
