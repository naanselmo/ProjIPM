<?php
  $foods = array(
    "hamburger" => array("Hamburger", "hamburger.png", "12€"),
    "steak" => array("Steak", "hamburger.png", "7€"),
    "pizza" => array("Pizza", "hamburger.png", "9€"),
    "chips" => array("Chips", "hamburger.png", "9€"),
    "nachos" => array("Nachos", "hamburger.png", "9€"),
    "mozzarella_sticks" => array("Mozzarella Sticks", "hamburger.png", "9€"),
    "onion_rings" => array("Onion Rings", "hamburger.png", "9€"),
    "chicken_wings" => array("Chicken Wings", "hamburger.png", "9€"),
    "grilled_cheese_sandwich" => array("Grilled Cheese Sandwich", "hamburger.png", "9€"),
    "calamari" => array("Calamari", "hamburger.png", "9€"),
    "empty_plate" => array("Empty Plate", "hamburger.png", "99€")
  );

  $drinks = array(
    "beer" => array("Beer", "hamburger.png", "19€"),
    "gin" => array("Gin", "hamburger.png", "21€"),
    "tequila" => array("Tequila", "hamburger.png", "15€"),
    "vodka" => array("Vodka", "hamburger.png", "6€"),
    "rum" => array("Rum", "hamburger.png", "17€"),
    "absinthe" => array("Absinthe", "hamburger.png", "21€"),
    "whisky" => array("Whisky", "hamburger.png", "21€"),
    "armagnac" => array("Armagnac", "hamburger.png", "21€"),
    "cognac" => array("Cognac", "hamburger.png", "21€"),
    "champagne" => array("Champagne", "hamburger.png", "21€"),
    "apple_cider" => array("Apple Cider", "hamburger.png", "21€"),
    "sake" => array("Sake", "hamburger.png", "21€"),
    "manhattan" => array("Manhattan", "hamburger.png", "21€"),
    "bourbon" => array("Bourbon", "hamburger.png", "21€"),
    "martini" => array("Martini", "hamburger.png", "21€"),
    "tom_collins" => array("Tom Collins", "hamburger.png", "21€"),
    "daiquiri" => array("Daiquiri", "hamburger.png", "21€"),
    "mojito" => array("Mojito", "hamburger.png", "21€"),
    "pina_colada" => array("Piña Colada", "hamburger.png", "21€"),
    "bloody_mary" => array("Bloody Mary", "hamburger.png", "21€"),
    "appletini" => array("Appletini", "hamburger.png", "21€"),
    "cosmopolitan" => array("Cosmopolitan", "hamburger.png", "21€"),
    "sex_on_the_beach" => array("Sex on the Beach", "hamburger.png", "21€"),
    "margarita" => array("Margarita", "hamburger.png", "21€"),
    "red_wine" => array("Red Wine", "hamburger.png", "21€"),
    "white_wine" => array("White Wine", "hamburger.png", "8€"),
    "empty_cup" => array("Empty Cup", "hamburger.png", "99€")
  );

  $others = array(
    "box" => array("Box", "hamburger.png", "0.01€")
  );

  function get_random($source, $amount){
    $random = array();
    foreach (array_rand($source, $amount) as $id)
      $random[$id] = $source[$id];
    return $random;
  }

  $highlights_foods = get_random($foods, 2);
  $highlights_drinks = get_random($drinks, 2);
  $highlights = array_merge($highlights_foods, $highlights_drinks);

  $top_foods = get_random($foods, 2);
  $top_drinks = get_random($drinks, 2);
  $top = array_merge($top_foods, $top_drinks);

  $all = array_merge($foods, $drinks);

  function print_orders($products){
    foreach ($products as $id => $details): ?>
      <div class="col-md-3 text-center order-item-wrapper">
        <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller order-item">
          <img class="img-responsive img-rounded" src="<?php echo("images/".$details[1])?>">
          <div class="order-text">
            <h3 id="name" class="text-white bordered-text-order"><?php echo($details[0]) ?></h3>
            <h4 id="price" class="text-white bordered-text-order"><?php echo($details[2]) ?></h4>
          </div>
        </div>
      </div>
    <?php endforeach;
  }

  function print_sort_button(){ ?>
    <div class="sort-button" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome'>
      <select class="selectpicker sort-select">
        <option selected disabled hidden value="none;0">Ordenar por…</option>
        <option value="price;1">&#xF162 Menor preço primeiro</option>
        <option value="price;-1">&#xF163 Maior preço primeiro</option>
        <option value="name;1">&#xF15E Alfabeticamente [A-Z]</option>
        <option value="name;-1">&#xF15D Alfabeticamente [Z-A]</option>
      </select>
    </div>
  <?php } ?>

<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-md-2 align-middleish">
        <div class="col-md-offset-2 col-md-8 col-md-offset-2">
          <div class="sidemenu-item">
            <input id="search" class="form-control" type="text" placeholder="&#xF002; Search" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome'/>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showMain()">
            <span class="fa fa-star fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="main-option" class="text-white bordered-text-small inline active-option">Geral</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showDrinks()">
            <span class="fa fa-beer fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="drinks-option" class="text-white bordered-text-small inline">Bebidas</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showFoods()">
            <span class="fa fa-cutlery fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="foods-option" class="text-white bordered-text-small inline">Comidas</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showOthers()">
            <span class="fa fa-ellipsis-h fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="others-option" class="text-white bordered-text-small inline">Outros</h4></span>
          </div>
        </div>
      </div>

      <div id="middle" class="col-md-7">
        <div id="main" class="order-menu">
          <div class="col-md-12 no-padding order-section">
            <h2 id="name" class="text-white bordered-text-order">Recomendados</h2>
            <?php print_orders($highlights); ?>
          </div>
          <br>
          <br>
          <br>
          <div class="col-md-12 no-padding order-section">
            <h2 id="name" class="text-white bordered-text-order">Mais populares</h2>
            <?php print_orders($top); ?>
          </div>
        </div>
        <div id="drinks" class="order-menu order-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-order">Bebidas</h2>
          <?php print_orders($drinks); ?>
        </div>
        <div id="foods" class="order-menu order-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-order">Comidas</h2>
          <?php print_orders($foods); ?>
        </div>
        <div id="others" class="order-menu order-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-order">Outros</h2>
          <?php print_orders($others); ?>
        </div>
        <div id="search-results" class="order-menu order-section hidden">
          <h2 id="name" class="text-white bordered-text-order">Resultados da pesquisa</h2>
        </div>
      </div>

      <div id="right" class="col-md-3">
        <div class="col-md-offset-2 col-md-8 col-md-offset-2" style="position: relative; top: 22px;">
          <span class="fa fa-shopping-cart fa-3x fa-inverse bordered-text pull-left align-icon"></span>
          <span><h2 class="bold-text text-white bordered-text-small inline">Carrinho</h2></span>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div id="orders" class="orders">
          <div id="blank-order" class="col-md-12 order">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-5 text-center">
                <h4 id="name" class="text-white bordered-text inline">Blank test order!</h4>
              </div>
              <div class="col-md-7">
                <div class="col-md-3 text-center">
                  <h4 id="price" class="text-white bordered-text inline">10€</h4>
                </div>
                <div class="col-md-9 text-center">
                  <span class="fa fa-minus-circle fa-2x fa-inverse bordered-text pull-left align-icon cart-remove"></span>
                  <span><h4 id="count" class="text-white bordered-text inline">1</h4></span>
                  <span class="fa fa-plus-circle fa-2x fa-inverse bordered-text pull-right align-icon cart-add"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="panel padded-medium border-black semi-transparent-white rounded-corner text-center">
            <h2 id="text" class="text-white bordered-text inline" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome' onClick="clearOrders()">&#xF00C Efectuar Pedido</h2>
        </div>

      </div>

      <div id="help-dialog" style="display: none;">
        Este menu é dedicado à realização de pedidos e ao seu pagamento.
        <br>
        <br>
        Do lado esquerdo pode seleccionar qual a categoria que deseja visualizar, ou procurar por um dado produto.
        <br>
        Pode carregar nos botões que aparecem, com cada produto, para o adicionar ao seu carrinho.
        <br>
        Do lado direito pode alterar as quantidades pedidas de cada produto, ou efectuar pagamento.
      </div>
    </div>
    <?php include("includes/popup.html");?>
    <?php include("includes/footer-submenu.html");?>
    <?php include("includes/includes.html");?>

    <!-- Custom Script -->
    <script src="js/pedidos.js"></script>
    <script>
      set_help_dialog_element($('#help-dialog'));
      set_header_text("Pedidos");
    </script>
  </body>
</html>
