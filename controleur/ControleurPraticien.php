<!-- debut ControleurPraticien -->

<?php
require_once '../modele/ModelePersonne.php';

class ControleurPraticien {
    // liste de mes disponibilités
    public static function readDisponibilites() {
        $results = ModelePersonne::getMesDisponibilites();
        include 'config.php';
        $vue = $root . '/doctolib/vue/praticien/vueListeDisponibilites.php';
        if (DEBUG)
         echo ("ControleurPraticien : readDisponibilites : vue = $vue");
        require ($vue);
    }

    // ajout de nouvelles disponibilités
    public static function createDisponibilites($args) {
        $target = $args['target'];
        include 'config.php';
        $vue = $root . '/doctolib/vue/praticien/vueInsertionDisponibilites.php';
        if (DEBUG)
         echo ("ControleurPraticien : createDisponibilites : vue = $vue");
        require ($vue);
    }

    // affichage des nouvelles disponibilités
    public static function readNewDisponibilites() {
        $results = ModelePersonne::insertDisponibilites($_GET['date'], $_GET['nbRdv']);
        include 'config.php';
        $vue = $root . '/doctolib/vue/praticien/vueListeDisponibilites.php';
        if (DEBUG)
         echo ("ControleurPraticien : readNewDisponibilites : vue = $vue");
        require ($vue);
    }

    // liste de mes rendez-vous avec le nom des patients
    public static function readRdvPatient() {
        $results = ModelePersonne::getRendezVousPraticien();
        include 'config.php';
        $vue = $root . '/doctolib/vue/praticien/vueListeRdv.php';
        if (DEBUG)
         echo ("ControleurPraticien : readRdv : vue = $vue");
        require ($vue);
    }

    // liste de mes patients sans doublons
    public static function readPatients() {
        $results = ModelePersonne::getMesPatients();
        include 'config.php';
        $vue = $root . '/doctolib/vue/praticien/vueListePatients.php';
        if (DEBUG)
         echo ("ControleurPraticien : readPatients : vue = $vue");
        require ($vue);
    }
}
