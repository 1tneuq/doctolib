<!-- ----- début vueInfos -->
<?php

require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>
<body>
  <div class="container bg-white">
    <?php
    include $root . '/doctolib/vue/templates/doctolib_menu_administrateur.php';
    include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
    ?>

    <h2>Liste des spécialités</h2>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Label</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results[0] as $specialite) {
          printf("<tr><td>%d</td><td>%s</td></tr>", $specialite['id'], $specialite['label']);
        }
        ?>
      </tbody>
    </table>

    <h2>Liste des praticiens</h2>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Adresse</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results[1] as $praticien) {
          printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $praticien['id'], $praticien['nom'], $praticien['prenom'], $praticien['adresse']);
        }
        ?>
      </tbody>
    </table>

    <h2>Liste des patients</h2>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Adresse</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results[2] as $patient) {
          printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $patient['id'], $patient['nom'], $patient['prenom'], $patient['adresse']);
        }
        ?>
      </tbody>
    </table>

    <h2>Liste des administrateurs</h2>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Adresse</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results[3] as $administrateur) {
          printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $administrateur['id'], $administrateur['nom'], $administrateur['prenom'], $administrateur['adresse']);
        }
        ?>
      </tbody>
    </table>

    <h2>Liste de tous les rendez-vous</h2>
    <table class="table table-striped table-bordered">
    <thead>
    <tr>
    <th scope="col">Patient</th>
    <th scope="col">Praticien</th>
    <th scope="col">Date du rendez-vous</th>
    </tr>
    </thead>
    <tbody>
    <?php
         foreach ($results[4] as $rendezvous) {
           printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $rendezvous['patient_id'], $rendezvous['praticien_id'], $rendezvous['rdv_date']);
         }
         ?>
    </tbody>
    </table>
  </div>

  <?php
  include $root . '/doctolib/vue/templates/doctolib_footer.html';
  ?>
  <!-- ----- fin vueInfos.php -->
