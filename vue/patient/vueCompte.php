
<!-- ----- début vueCompte -->
<?php

require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

<body>
  <div class="container bg-white">
    <?php
    include $root . '/doctolib/vue/templates/doctolib_menu_patient.php';
    include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
    ?>

    <table class = "table table-striped table-bordered">
    <thead>
      <tr>
        <th scope = "col">id</th>
        <th scope = "col">nom</th>
        <th scope = "col">prenom</th>
        <th scope = "col">adresse</th>
        <th scope = "col">login</th>
        <th scope = "col">mot de passe</th>
        <th scope = "col">statut</th>
        <th scope = "col">specialite</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($results as $element) {
         printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td>%d</td></tr>", $element->getId(),
           $element->getNom(), $element->getPrenom(), $element->getAdresse(),$element->getLogin(),$element->getPassword(),$element->getStatut(),$element->getSpecialiteId());
        }
        ?>
    </tbody>
    </table>
  </div>

  <?php include $root . '/doctolib/vue/templates/doctolib_footer.html'; ?>

  <!-- ----- fin vueCompte -->
