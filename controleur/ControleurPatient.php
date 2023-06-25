<!-- debut ControleurPatient -->

<?php
require_once '../modele/ModelePersonne.php';

class ControleurPatient {
    //informations sur le patient connecté
    public static function readInfo() {
        $results = ModelePersonne::getMesInformations();
        include 'config.php';
        $vue = $root . '/doctolib/vue/patient/vueCompte.php';
        if (DEBUG)
         echo ("ControleurPatient : readPatient : vue = $vue");
        require ($vue);
    }

    // liste de mes rendez-vous
    public static function readRdv() {
        $results = ModelePersonne::getRendezVousPatient();
        include 'config.php';
        $vue = $root . '/doctolib/vue/patient/vueRdv.php';
        if (DEBUG)
         echo ("ControleurPatient : readRdv : vue = $vue");
        require ($vue);
    }

    // prise de rendez-vous avec un praticien partie 1
    public static function createRdv1($args) {
        $target = $args['target'];
        $results = ModelePersonne::getListePraticiens();
        include 'config.php';
        $vue = $root . '/doctolib/vue/patient/vueNouveauRdv_1.php';
        if (DEBUG)
         echo ("ControleurPatient : createRdv : vue = $vue");
        require ($vue);
    }

    // prise de rendez-vous avec un praticien partie 2
    public static function createRdv2() {
        $results = ModelePersonne::getDisponibilitesPraticien($_GET['id_praticien']);
        include 'config.php';
        $vue = $root . '/doctolib/vue/patient/vueNouveauRdv_2.php';
        if (DEBUG)
         echo ("ControleurPatient : createRdv : vue = $vue");
        require ($vue);
    }

    // affichage du nouveau rendez-vous
    public static function readNewRdv() {
        $id = ModelePersonne::insertRendezVous($_GET['id_praticien'], $_GET['rdv_date']);
        $results = ModelePersonne::getRendezVousPatientById($id);
        include 'config.php';
        $vue = $root . '/doctolib/vue/patient/vueRdv.php';
        if (DEBUG)
         echo ("ControleurPatient : readNewRdv : vue = $vue");
        require ($vue);
    }
}
