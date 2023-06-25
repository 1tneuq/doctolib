<!-- début de la page accueil -->
 <?php
 include 'templates/doctolib_header.html';
?>
<body>
  <div class="container bg-white">
    <?php
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
    include 'templates/doctolib_jumbotron.html';
    ?>
  </div>

  <?php
  include 'templates/doctolib_footer.html';
  ?>

  <!-- fin de la page accueil -->

</body>
</html>
