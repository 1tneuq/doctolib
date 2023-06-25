<!-- debut ControleurAdministrateur -->

<?php
session_start();
require_once '../modele/ModelePersonne.php';

class ControleurAdministrateur {
    // liste des spécialités
    public static function readSpecialites() {
        $results = ModelePersonne::getListeSpecialites();
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/vueListeSpecialites.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : readSpecialites : vue = $vue");
        require ($vue);

    }

    // sélection d'une spécialité par son id
    public static function getOneSpecialite($args) {
        $results = ModelePersonne::getListeIdSpecialites();
        $target = $args['target'];
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/vueSpecialiteId.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : readSpecialite : vue = $vue");
        require ($vue);
    }

    // affichage de la spécialité
    public static function readOneSpecialite() {
        $results = ModelePersonne::getSpecialiteById($_GET['id']);
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/specialite_action.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : readSpecialite : vue = $vue");
        require ($vue);
    }

    // insertion d'une nouvelle spécialité
    public static function createSpecialite($args) {
        $target = $args['target'];
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/vueInsertionSpecialite.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : createSpecialite : vue = $vue");
        require ($vue);
    }

    // affichage de la nouvelle spécialité
    public static function readNewSpecialite() {
        $id = ModelePersonne::insertSpecialite($_GET['label']);
        $results = ModelePersonne::getSpecialiteById($id);
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/vueLectureSpecialite.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : readNewSpecialite : vue = $vue");
        require ($vue);
    }
    
    // liste des praticiens avec leur spécialité
    public static function readPraticiens() {
        $results = ModelePersonne::getListePraticiens();
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/vueListePraticiens.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : readPraticiens : vue = $vue");
        require ($vue);
    }

    // nombre de praticiens par patient
    public static function readNbPraticiensParPatient() {
        $results = ModelePersonne::getNbPraticiensParPatient();
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/vueNombrePraticiens.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : readNbPraticiensParPatient : vue = $vue");
        require ($vue);
    }

    //info : ensemble de tableaux avec leurs données
    public static function readAll() {
        $results = ModelePersonne::getAll();
        include 'config.php';
        $vue = $root . '/doctolib/vue/administrateur/vueInfos.php';
        if (DEBUG)
         echo ("ControleurAdministrateur : readInfo : vue = $vue");
        require ($vue);
    }
}

?>

<!-- fin ControleurAdministrateur -->
