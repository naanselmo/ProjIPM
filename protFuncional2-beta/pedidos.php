<?php
  $foods = array(
    "hamburger" => array("Hamburger", "hamburger.png", "12€"),
    "steak" => array("Steak", "hamburger.png", "7€"),
    "pizza" => array("Pizza", "hamburger.png", "9€"),
    "empty_plate" => array("Empty Plate", "hamburger.png", "1000€")
  );

  $drinks = array(
    "beer" => array("Beer", "hamburger.png", "19€"),
    "gin" => array("Gin", "hamburger.png", "21€"),
    "tequila" => array("Tequila", "hamburger.png", "15€"),
    "vodka" => array("Vodka", "hamburger.png", "6€"),
    "wine" => array("Wine", "hamburger.png", "8€")
  );

  $others = array(
    "box" => array("Box", "hamburger.png", "0.01€")
  );

  $highlights_foods = array();
  foreach (array_rand($foods, 2) as $id)
    $highlights_foods[] = $foods[$id];

  $highlights_drinks = array();
  foreach (array_rand($drinks, 2) as $id)
    $highlights_drinks[] = $drinks[$id];

  $top_foods = array();
  foreach (array_rand($foods, 2) as $id)
    $top_foods[] = $foods[$id];

  $top_drinks = array();
  foreach (array_rand($drinks, 2) as $id)
    $top_drinks[] = $drinks[$id];

  $highlights = array_merge($highlights_foods, $highlights_drinks);
  $top = array_merge($top_foods, $top_drinks);

  $all = array_merge($foods, $drinks);

?>

<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-md-2 align-middleish">
        <div class="col-md-offset-2 col-md-8 col-md-offset-2">
          <div class="sidemenu-item">
            <input id="search" class="form-control" type="text" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome" />
          </div>
          <br>
          <div class="sidemenu-item" onClick="showMain()">
            <span class="fa fa-star fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 class="bold-text text-white bordered-text-small">Geral</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showFoods()">
            <span class="fa fa-cutlery fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 class="bold-text text-white bordered-text-small">Comidas</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showDrinks()">
            <span class="fa fa-beer fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 class="bold-text text-white bordered-text-small">Bebidas</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showOthers()">
            <span class="fa fa-ellipsis-h fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 class="bold-text text-white bordered-text-small">Outros</h4></span>
          </div>
        </div>
      </div>

      <div id="middle" class="col-md-7 align-middle">
        <div id="main">
          <h2 id="name" class="text-white bordered-text-order">Recomendados</h2>
          <?php foreach ($highlights as $id => $details): ?>
              <div class="col-md-3 text-center">
                <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller order-item">
                  <img class="img-responsive img-rounded" src="<?php echo("images/".$details[1])?>">
                  <div class="order-text">
                    <h3 id="name" class="text-white bordered-text-order"><?php echo($details[0]) ?></h3>
                    <h4 id="price" class="text-white bordered-text-order"><?php echo($details[2]) ?></h4>
                  </div>
                </div>
              </div>
          <?php endforeach; ?>
          <br>
          <br>
          <br>
          <h2 id="name" class="text-white bordered-text-order">Mais pedidos</h2>
          <?php foreach ($top as $id => $details): ?>
              <div class="col-md-3 text-center">
                <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller order-item">
                  <img class="img-responsive img-rounded" src="<?php echo("images/".$details[1])?>">
                  <div class="order-text">
                    <h3 id="name" class="text-white bordered-text-order"><?php echo($details[0]) ?></h3>
                    <h4 id="price" class="text-white bordered-text-order"><?php echo($details[2]) ?></h4>
                  </div>
                </div>
              </div>
          <?php endforeach; ?>
        </div>
        <div id="drinks" class="hidden">
          <?php foreach ($drinks as $id => $details): ?>
              <div class="col-md-3 text-center">
                <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller order-item">
                  <img class="img-responsive img-rounded" src="<?php echo("images/".$details[1])?>">
                  <div class="order-text">
                    <h3 id="name" class="text-white bordered-text-order"><?php echo($details[0]) ?></h3>
                    <h4 id="price" class="text-white bordered-text-order"><?php echo($details[2]) ?></h4>
                  </div>
                </div>
              </div>
          <?php endforeach; ?>
        </div>
        <div id="foods" class="hidden">
          <?php foreach ($foods as $id => $details): ?>
              <div class="col-md-3 text-center">
                <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller order-item">
                  <img class="img-responsive img-rounded" src="<?php echo("images/".$details[1])?>">
                  <div class="order-text">
                    <h3 id="name" class="text-white bordered-text-order"><?php echo($details[0]) ?></h3>
                    <h4 id="price" class="text-white bordered-text-order"><?php echo($details[2]) ?></h4>
                  </div>
                </div>
              </div>
          <?php endforeach; ?>
        </div>
        <div id="others" class="hidden">
          <?php foreach ($others as $id => $details): ?>
              <div class="col-md-3 text-center">
                <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller order-item">
                  <img class="img-responsive img-rounded" src="<?php echo("images/".$details[1])?>">
                  <div class="order-text">
                    <h3 id="name" class="text-white bordered-text-order"><?php echo($details[0]) ?></h3>
                    <h4 id="price" class="text-white bordered-text-order"><?php echo($details[2]) ?></h4>
                  </div>
                </div>
              </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div id="right" class="col-md-3">
        <div id="orders">
          <div id="blank-order" class="col-md-12 text-center">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-6">
                <h4 id="name" class="text-white bordered-text inline">Blank test order!</h4>
              </div>
              <div class="col-md-2">
                <h4 id="price" class="text-white bordered-text inline">10€</h4>
              </div>
              <div class="col-md-4">
                <span class="fa fa-plus-circle fa-2x fa-inverse bordered-text pull-left align-icon cart-add"></span>
                <span><h4 id="count" class="text-white bordered-text inline">1</h4></span>
                <span class="fa fa-minus-circle fa-2x fa-inverse bordered-text pull-right align-icon cart-remove"></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="help-dialog" style="display: none;">
        Expire para o ecrã para obter uma leitura do seu nível de álcool no sangue.
        <br>
        Indica também se ainda está ou não dentro do limite legal e quais a consequências de ser mandado parar pelas autoridades.
        <br>
        <br>
        Para chamar um empregado carregue no botão da pessoa à esquerda do botão de ajuda.
        <br>
        Para aceder às definições da mesa carregue na engrenagem no canto inferior esquerdo.
      </div>
    </div>
    <?php include("includes/popup.html");?>
    <?php include("includes/footer-submenu.html");?>
    <?php include("includes/includes.html");?>

    <!-- Custom Script -->
    <script src="js/pedidos.js"></script>
    <script>
      set_help_dialog_element($('#help-dialog'));
    </script>
  </body>
</html>
