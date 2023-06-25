
<!-- ----- début vueListeDisponibilites -->
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
            <th scope = "col">date</th>
            <th scope = "col">heure</th>
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($results as $element) {
             printf("<tr><td>%s</td><td>%s</td></tr>", $element['date'], $element['heure']);
            }
            ?>
        </tbody>
      </table>
    </div>

  <?php include $root . '/doctolib/vue/templates/doctolib_footer.html'; ?>

  <!-- ----- fin vueListeDisponibilites -->
