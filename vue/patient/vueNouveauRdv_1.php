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
            <h4 class="card-title text-center text-white">Sélection d'un praticien</h4>
          </div>
          <div class="card-body bg-primary d-flex align-items-center justify-content-center">

          <?php
          $listePraticiens = $results;

          $tab = array();

          foreach ($listePraticiens as $praticien) {
              $nomPrenom = $praticien['nom'] . ' ' . $praticien['prenom'];
              $tab[$nomPrenom] = $praticien['id'];
          }

          echo "<form class='mt-3' method='get' action='router.php'>";
          echo "<input type='hidden' name='action' value='createRdv2'>";
          echo "<input type='hidden' name='target' value='" . $target . "'>";
          echo "<div class='form-group'>";
          echo "<select class='form-control' name='id_praticien'>";
          foreach ($tab as $nomPrenom => $id) {
              echo "<option value='" . $id . "'>" . $nomPrenom . "</option>";
          }
          echo "</select>";
          echo "</div>";
          form_input_submit("Choisir");
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
