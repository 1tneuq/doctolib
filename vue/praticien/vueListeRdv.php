
<!-- ----- début vueListeRdv -->
<?php

require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

<body>
  <div class="container bg-white">
    <?php
    include $root . '/doctolib/vue/templates/doctolib_menu_praticien.php';
    include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
    ?>

      <table class = "table table-striped table-bordered">
        <thead>
          <tr>
            <th scope = "col">nom</th>
            <th scope = "col">prenom</th>
            <th scope = "col">date du rendez-vous</th>
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($results as $element) {
             printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>", $element['nom'], $element['prenom'], $element['rdv_date']);
            }
            ?>
        </tbody>
      </table>
    </div>

  <?php include $root . '/doctolib/vue/templates/doctolib_footer.html'; ?>

  <!-- ----- fin vueListeRdv -->
