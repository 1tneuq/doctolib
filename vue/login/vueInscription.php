<!DOCTYPE html>
<?php
require ($root . '/doctolib/public/lo07_biblio_formulaire_bt.php');
require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

  <body>
    <div class="container bg-white">
      <?php
      include $root . '/doctolib/vue/templates/doctolib_menu.html';
      include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
      ?>

      <div class="container-fluid d-flex align-items-center">
        <div id='inscription' class="card bg-primary col-4 mx-auto">
          <div class="card-header">
            <h4 class="card-title text-center text-white">Formulaire d'inscription</h4>
          </div>
          <div class="card-body bg-primary d-flex align-items-center justify-content-center text-white">

            <?php
            $tabSpe = array();
            foreach ($results as $element) {
              array_push($tabSpe, $element['label']);
            }

            form_begin("mt-3", "get", "router.php");
            echo("<input type='hidden' name='action' value='inscription'>");
            form_input_text("Nom ", "nom", 30, "", "text");
            form_input_text("Prenom ", "prenom", 30, "", "text");
            form_input_text("Adresse ", "adresse", 30, "", "text");
            form_input_text("Login ", "login", 30, "", "text");
            form_input_text("Mot de passe ", "mdp", 30, "", "password");
            form_select_drop("Votre statut", "statut", "", array("Administrateur", "Praticien", "Patient"));
            form_select_drop("Votre spécialité si vous êtes praticien", "specialite", "", $tabSpe);
            form_input_submit("Inscription");
            form_end();

            ?>

          </div>
        </div>
      </div>
    </div>
  </body>

  <?php
  include $root . '/doctolib/vue/templates/doctolib_footer.html';
  ?>
