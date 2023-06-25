<!-- ----- début confirmation-->
<?php

require ($root . '/doctolib/vue/templates/doctolib_header.html');
?>

<body>
  <div class="container bg-white">
    <?php
    //var_dump($_SESSION);
    if(isset($_SESSION['type'])){
      if($_SESSION['type'] == 0){
        include($root . '/doctolib/vue/templates/doctolib_menu_administrateur.php');
      }else if($_SESSION['type'] == 1){
        include ($root . '/doctolib/vue/templates/doctolib_menu_praticien.php');
      }else if($_SESSION['type'] == 2){
        include $root . '/doctolib/vue/templates/doctolib_menu_patient.php';
      }else{
        include $root . '/doctolib/vue/templates/doctolib_menu.html';
      }
    }

    include $root . '/doctolib/vue/templates/doctolib_jumbotron.html';

    echo ("<h3>$msg</h3>");
    echo("</div>");

    include $root . '/doctolib/vue/templates/doctolib_footer.html';
    ?>
    <!-- ----- fin confirmation -->
