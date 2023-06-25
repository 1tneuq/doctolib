<!DOCTYPE html>
<?php
require ($root . '/doctolib/public/lo07_biblio_formulaire_bt.php');
require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

  <body>
    <div class="container bg-white">
      <?php
      include $root . '/doctolib/vue/templates/doctolib_menu_praticien.php';
      include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
      ?>

      <div class="container-fluid d-flex align-items-center">
        <div id='inscription' class="card bg-primary col-4 mx-auto">
          <div class="card-header">
            <h4 class="card-title text-center text-white">Ajouter une disponibilité</h4>
          </div>
          <div class="card-body bg-primary d-flex align-items-center justify-content-center text-white">

            <?php

            form_begin("mt-3", "get", "router.php");
            echo("<input type='hidden' name='action' value=".$target.">");
            form_input_text("Rendez-vous ", "date", 30, "", "date");
            form_input_text("Nombre ", "nbRdv", 30, "", "text");
            form_input_submit("Ajouter");
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
