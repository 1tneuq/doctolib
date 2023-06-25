<?php

class ControleurDoctolib {
    public static function accueilDoctolib(){
        include 'config.php';
        $vue = $root . '/doctolib/vue/accueilDoctolib.php';
        if (DEBUG)
            echo ("ControleurDoctolib : accueilDoctolib : vue = $vue");
        require ($vue);
    }

    public static function connexionPage(){
      include 'config.php';
      $vue = $root . '/doctolib/vue/login/vueConnexion.php';
      if (DEBUG)
          echo ("ControleurFormulaire : connexionPage : vue = $vue");
      require ($vue);
    }

    public static function inscriptionPage(){
      $results = ModelePersonne::getListeSpecialites();
      include 'config.php';
      $vue = $root . '/doctolib/vue/login/vueInscription.php';
      if (DEBUG)
          echo ("ControleurFormulaire : inscriptionPage : vue = $vue");
      require ($vue);
    }

    public static function inscription(){
      $nom = htmlspecialchars($_GET['nom']);
      $prenom = htmlspecialchars($_GET['prenom']);
      $adresse = htmlspecialchars($_GET['adresse']);
      $login = htmlspecialchars($_GET['login']);
      $mdp = htmlspecialchars($_GET['mdp']);
      $statut = htmlspecialchars($_GET['statut']);
      $specialite = htmlspecialchars($_GET['specialite']);

      // Création de l'objet ModelePersonne
      $personne = new ModelePersonne();
      $personne->setNom($nom);
      $personne->setPrenom($prenom);
      $personne->setAdresse($adresse);
      $personne->setLogin($login);
      $personne->setPassword($mdp);
      $personne->setStatutString($statut);
      $personne->setSpecialiteIdString($specialite);

      // Ajout de la personne à la base de données
      $resultat = $personne->insert();

      if ($resultat == -1) {
          $msg = "Une erreur s'est produite lors de l'ajout de la personne."; //pour tous les echos de la page on routera vers l'accueil personnalisé
      } else {
          $msg = "Inscription réussie.";
          $_SESSION['login'] = $personne->getLogin();
          $_SESSION['id'] = $personne->getId();
          $_SESSION['type'] = $personne->getStatut();
      }
      include 'config.php';
       $vue = $root . '/doctolib/vue/login/vueConfirmation.php';
       if (DEBUG)
        echo ("ControleurDoctolib : confirmation : vue = $vue");
       require ($vue);
    }

    public static function connexion(){
      // Récupération des données du formulaire de connexion
      $login = htmlspecialchars($_GET['login']);
      $mdp = htmlspecialchars($_GET['mdp']);

      // Création de l'objet ModelePersonne
      $personne = new ModelePersonne();

      // Vérification des informations de connexion
      $result = $personne->checkInfos($login, $mdp);

      if ($result) {
          $msg = "Connexion réussie.";
          $_SESSION['login'] = $personne->getLogin();
          $_SESSION['id'] = $personne->getId();
          $_SESSION['type'] = $personne->getStatut();
      } else {
          $msg = "Identifiant ou mot de passe incorrect.";
      }
      include 'config.php';
       $vue = $root . '/doctolib/vue/login/vueConfirmation.php';
       if (DEBUG)
        echo ("ControleurDoctolib : confirmation : vue = $vue");
       require ($vue);
    }

    public static function deconnexion(){
        include 'config.php';
        $vue = $root . '/doctolib/index.php';
        if (DEBUG)
            echo ("ControleurDoctolib : index : vue = $vue");
        require ($vue);
    }

    public static function deleteCompte(){
      $result = ModelePersonne::deletePersonne();

      if ($result) {
          $msg = "Suppression réussie.";
          $_SESSION['login'] = "vide";
          $_SESSION['id'] = "-1";
          $_SESSION['type'] = "-1";
      } else {
        $msg = "Echec de la suppression";
      }
      include 'config.php';
       $vue = $root . '/doctolib/vue/login/vueConfirmation.php';
       if (DEBUG)
        echo ("ControleurDoctolib : confirmation : vue = $vue");
       require ($vue);
    }
}
