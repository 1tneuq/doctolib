<!-- début administrateur_action -->

<?php
require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

<body>
  <div class="container bg-white">
    <?php
    include $root . '/doctolib/vue/templates/doctolib_menu_administrateur.php';
    include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
    ?>

    <?php
      if($results==NULL) {
          echo ("La spécialité a été supprimée.");
      } elseif ($results=="impossible") {
          echo ("Problème de suppression de la spécialité.");
      } else {
          echo ("<table class = 'table table-striped table-bordered'>
                  <thead>
                    <tr>
                      <th scope = 'col'>id</th>
                      <th scope = 'col'>label</th>
                    </tr>
                  </thead>
                <tbody>");

          foreach ($results as $element) {
                printf("<tr><td>%d</td><td>%s</td></tr>", $element['id'], $element['label']);
            }

          echo ("</tbody>
            </table>");
      }
    ?>

  </div>

<?php include $root . '/doctolib/vue/templates/doctolib_footer.html'; ?>

<!-- fin administrateur_action -->
