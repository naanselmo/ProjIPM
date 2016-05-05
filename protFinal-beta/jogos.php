<?php
  $singleplayer = array(
    "bubbles" => array("Bolhinhas", "games/bubbles.png"),
    "flappy_bird" => array("Pássaro Flapejante", "games/flappy_bird.png"),
    "pacman" => array("Homem do Pac", "games/pacman.png"),
    "space_invaders" => array("Invasores do Espaço", "games/space_invaders.png")
  );

  $multiplayer = array(
    "pong" => array("Pong", "games/pong.png"),
    "battle_tetris" => array("Tetris de Batalha", "games/battle_tetris.png"),
    "chess" => array("Xadrez", "games/chess.png"),
    "checkers" => array("Damas", "games/checkers.png")
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

  function print_games($games){
    foreach ($games as $id => $details): ?>
      <div class="col-md-3 text-center game-item-wrapper">
        <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller game-item" onClick="window.location.href='jogo.php?game=<?php echo($id) ?>&title=<?php echo($details[0]) ?>'">
          <img class="img-responsive img-rounded rounded-corner-smaller" src="<?php echo("images/".$details[1])?>">
          <div class="game-text">
            <h3 id="name" class="text-white bordered-text-game"><?php echo($details[0]) ?></h3>
          </div>
        </div>
      </div>
    <?php endforeach;
  }

  function print_sort_button(){ ?>
    <div class="sort-button" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome'>
      <select class="selectpicker sort-select">
        <option selected disabled hidden value="none;0">Ordenar por…</option>
        <option value="name;1">&#xF15D Alfabeticamente [A-Z]</option>
        <option value="name;-1">&#xF15E Alfabeticamente [Z-A]</option>
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
            <input id="search" class="form-control" type="text" placeholder="&#xF002; Search" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome' onfocus="show_keyboard()" onblur="hide_keyboard()"/>
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
        <div id="main" class="game-menu">
          <?php print_sort_button(); ?>
          <div class="col-md-12 no-padding games-section">
            <h2 id="name" class="text-white bordered-text-games">Recomendados</h2>
            <?php print_games($highlights); ?>
          </div>
          <br>
          <br>
          <br>
          <div class="col-md-12 no-padding games-section">
            <h2 id="name" class="text-white bordered-text-games">Mais populares</h2>
            <?php print_games($top); ?>
          </div>
        </div>
        <div id="singleplayer" class="game-menu games-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-games">Singleplayer</h2>
          <?php print_games($singleplayer); ?>
        </div>
        <div id="multiplayer" class="game-menu games-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-games">Multiplayer</h2>
          <?php print_games($multiplayer); ?>
        </div>
        <div id="search-results" class="game-menu games-section hidden">
          <h2 id="name" class="text-white bordered-text-games">Resultados da pesquisa</h2>
        </div>
      </div>

      <div id="right" class="col-md-3">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1" style="position: relative; top: 22px;">
          <span class="fa fa-user-plus fa-3x fa-inverse bordered-text pull-left align-icon"></span>
          <span><span><h2 class="text-white bordered-text-small inline">Jogos Abertos</h2></span></span>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div id="open-games" class="games">
          <div id="blank-game" class="col-md-12 open-game">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-8 text-center no-padding">
                <h4 id="game-title" class="text-white bordered-text inline">Empty Open Game</h4>
              </div>
              <div class="col-md-4">
                <span class="fa fa-sign-in fa-2x fa-inverse bordered-text pull-left align-icon enter-game"></span>
                <span class="fa fa-eye fa-2x fa-inverse bordered-text pull-right align-icon spectate-game"></span>
              </div>
            </div>
          </div>
          <div id="pong#2984375" class="col-md-12 open-game">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-8 text-center">
                <h4 id="game-title" class="text-white bordered-text inline">Pong #2984375</h4>
              </div>
              <div class="col-md-4">
                <span class="fa fa-sign-in fa-2x fa-inverse bordered-text pull-left align-icon enter-game" onClick="window.location.href='jogo.php?game=game=pong&title=Pong&match=2984375&action=join'"></span>
                <span class="fa fa-eye fa-2x fa-inverse bordered-text pull-right align-icon spectate-game" onClick="window.location.href='jogo.php?game=game=pong&title=Pong&match=2984375&action=spectate'"></span>
              </div>
            </div>
          </div>
          <div id="battle_tetris#347631" class="col-md-12 open-game">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-8 text-center">
                <h4 id="game-title" class="text-white bordered-text inline">Battle Tetris #347631</h4>
              </div>
              <div class="col-md-4">
                <span class="fa fa-sign-in fa-2x fa-inverse bordered-text pull-left align-icon enter-game" onClick="window.location.href='jogo.php?game=battle_tetris&title=Battle Tetris&match=347631&action=join'"></span>
                <span class="fa fa-eye fa-2x fa-inverse bordered-text pull-right align-icon spectate-game" onClick="window.location.href='jogo.php?game=battle_tetris&title=Battle Tetris&match=347631&action=spectate'"></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="help-dialog" style="display: none;">
        Este menu é dedicado ao lazer através de jogos.
        <br>
        <br>
        Do lado esquerdo pode escolher uma das categorias, ou procurar por nome dos jogos.
        <br>
        Pode carregar nos botões que aparecem, com cada jogo, para o jogar e ver as pontuações mais altas.
        <br>
        Do lado direito pode visualizar quais os jogos atualmente abertos.
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
