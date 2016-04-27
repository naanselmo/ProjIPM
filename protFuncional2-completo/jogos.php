<?php
  $singleplayer = array(
    "bubbles" => array("Bubbles", "hamburger.png", "bubbles.php"),
    "flappy_bird" => array("Flappy Bird", "hamburger.png")
  );

  $multiplayer = array(
    "pong" => array("Pong", "hamburger.png", "pong.php"),
    "battle_tetris" => array("Battle Tetris", "hamburger.png")
  );

  function get_random($source, $amount){
    $random = array();
    foreach (array_rand($source, $amount) as $id)
      $random[$id] = $source[$id];
    return $random;
  }

  $highlights_singleplayer = get_random($singleplayer, 2);
  $highlights_multiplayer = get_random($multiplayer, 2);
  $highlights = array_merge($highlights_singleplayer, $highlights_multiplayer);

  $top_singleplayer = get_random($singleplayer, 2);
  $top_multiplayer = get_random($multiplayer, 2);
  $top = array_merge($top_singleplayer, $top_multiplayer);

  $all = array_merge($singleplayer, $multiplayer);

  function print_games($products){
    foreach ($products as $id => $details): ?>
      <div class="col-md-3 text-center order-item-wrapper">
        <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller order-item" onClick="window.location.href='jogo.php?game=<?php echo($id) ?>&title=<?php echo($details[0]) ?>'">
          <img class="img-responsive img-rounded" src="<?php echo("images/".$details[1])?>">
          <div class="order-text">
            <h3 id="name" class="text-white bordered-text-order"><?php echo($details[0]) ?></h3>
          </div>
        </div>
      </div>
    <?php endforeach;
  }

  function print_sort_button(){ ?>
    <div class="sort-button" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome'>
      <select class="selectpicker sort-select">
        <option selected disabled hidden value="none;0">Ordenar por…</option>
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
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">
          <div class="sidemenu-item">
            <input id="search" class="form-control" type="text" placeholder="&#xF002; Search" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome'/>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showMain()">
            <span class="fa fa-star fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="main-option" class="text-white bordered-text-small inline active-option">Geral</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showSingleplayer()">
            <span class="fa fa-user fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="singleplayer-option" class="text-white bordered-text-small inline">Singleplayer</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showMultiplayer()">
            <span class="fa fa-users fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="multiplayer-option" class="text-white bordered-text-small inline">Multiplayer</h4></span>
          </div>
        </div>
      </div>

      <div id="middle" class="col-md-7">
        <div id="main" class="order-menu">
          <div class="col-md-12 no-padding order-section">
            <h2 id="name" class="text-white bordered-text-order">Recomendados</h2>
            <?php print_games($highlights); ?>
          </div>
          <br>
          <br>
          <br>
          <div class="col-md-12 no-padding order-section">
            <h2 id="name" class="text-white bordered-text-order">Mais populares</h2>
            <?php print_games($top); ?>
          </div>
        </div>
        <div id="multiplayer" class="order-menu order-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-order">Bebidas</h2>
          <?php print_games($multiplayer); ?>
        </div>
        <div id="singleplayer" class="order-menu order-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-order">Comidas</h2>
          <?php print_games($singleplayer); ?>
        </div>
        <div id="search-results" class="order-menu order-section hidden">
          <h2 id="name" class="text-white bordered-text-order">Resultados da pesquisa</h2>
        </div>
      </div>

      <div id="right" class="col-md-3">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1" style="position: relative; top: 22px;">
          <span class="fa fa-user-plus fa-3x fa-inverse bordered-text pull-left align-icon"></span>
          <span><h2 class="bold-text text-white bordered-text-small inline">Jogos Abertos</h2></span>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div id="open-games" class="games">
          <div id="blank-game" class="col-md-12 order">
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
    <?php include("includes/footer.html");?>
    <?php include("includes/includes.html");?>

    <!-- Custom Script -->
    <script src="js/jogos.js"></script>
    <script>
      set_help_dialog_element($('#help-dialog'));
      set_header_text("Jogos");
    </script>
  </body>
</html>
