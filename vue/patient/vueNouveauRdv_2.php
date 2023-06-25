<!DOCTYPE html>
<?php
require ($root . '/doctolib/public/lo07_biblio_formulaire_bt.php');
require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

  <body>
    <div class="container bg-white">
      <?php
      include $root . '/doctolib/vue/templates/doctolib_menu_patient.php';
      include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
      ?>

      <div class="container-fluid d-flex align-items-center">
        <div id='inscription' class="card bg-primary col-4 mx-auto">
          <div class="card-header">
            <h4 class="card-title text-center text-white">Sélection d'un créneau</h4>
          </div>
          <div class="card-body bg-primary d-flex align-items-center justify-content-center">

          <?php
          $praticien_id = $_GET['id_praticien'];

          echo "<form class='mt-3' method='get' action='router.php'>";
          echo "<input type='hidden' name='action' value='" . $_GET['target'] . "'>";
          echo "<input type='hidden' name='id_praticien' value='" . $praticien_id . "'>";
          echo "<div class='form-group'>";
          echo "<select class='form-control' name='rdv_date'>";
          foreach ($results as $horaire) {
              echo "<option value='" . $horaire . "'>" . $horaire . "</option>";
          }
          echo "</select>";
          echo "</div>";
          form_input_submit("Valider");
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
