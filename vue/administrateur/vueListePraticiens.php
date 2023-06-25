<!-- ----- début vueListePraticiens -->
<?php

require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

<body>
  <div class="container bg-white">
    <?php
    include $root . '/doctolib/vue/templates/doctolib_menu_administrateur.php';
    include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';
    ?>

    <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">nom</th>
        <th scope="col">prenom</th>
        <th scope="col">adresse</th>
        <th scope="col">specialite</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                $element['id'],
                $element['nom'],
                $element['prenom'],
                $element['adresse'],
                $element['specialite_label']
            );
        }
        ?>
    </tbody>
    </table>
  </div>

  <?php include $root . '/doctolib/vue/templates/doctolib_footer.html'; ?>

  <!-- ----- fin vueListePraticiens -->
