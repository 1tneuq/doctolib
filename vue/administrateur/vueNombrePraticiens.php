
<!-- ----- début vueSpecialiteId -->
<?php

require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

<body>
  <div class="container bg-white">
    <?php
    include $root . '/doctolib/vue/templates/doctolib_menu_administrateur.php';
    include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
    ?>

      <table class = "table table-striped table-bordered">
        <thead>
          <tr>
            <th scope = "col">nom</th>
            <th scope = "col">nombre de praticiens</th>
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($results as $element) {
             printf("<tr><td>%s</td><td>%d</td></tr>", $element['patient'], $element['nbPraticiens']);
            }
            ?>
        </tbody>
      </table>
    </div>

  <?php include $root . '/doctolib/vue/templates/doctolib_footer.html'; ?>

  <!-- ----- fin vueSpecialiteId -->
