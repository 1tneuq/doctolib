
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

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='<?php echo ($target);?>'>
        <label for="id">id : </label> <select class="form-control" id='id' name='id' style="width: 100px">
            <?php
            foreach ($results as $id) {
             echo ("<option>$id</option>");
            }
            ?>
        </select>
      </div>
      <p/><br/>
      <button class="btn btn-primary" type="submit">Valider</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/doctolib/vue/templates/doctolib_footer.html'; ?>

  <!-- ----- fin vueSpecialiteId -->