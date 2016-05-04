<?php
  $classic = array(
    "song1" => array("song1", "Dark_Side_of_the_Moon.png", "author1", "2015"),
    "song2" => array("song2", "Dark_Side_of_the_Moon.png", "author2", "2015"),
    "song3" => array("song3", "Dark_Side_of_the_Moon.png", "author3", "2010"),
    "song4" => array("song4", "Dark_Side_of_the_Moon.png", "author4", "2007")
  );

  $rock = array(
    "song5" => array("You Shook Me", "music/lz.png", "Led Zeppelin", "1969"),
    "song6" => array("A Kind Of Magic", "music/qn.png", "Queen", "1991"),
    "song7" => array("Dani California", "music/rhcp.png", "Red Hot Chili Peppers", "2006"),
    "song8" => array("Drive My Car", "music/tb.png", "The Beatles", "1965")
  );

  $punk = array(
    "song9" => array("California über alles", "music/dk.png", "Dead Kennedys", "1980"),
    "song10" => array("White Christmas", "music/br.png", "Bad Religion", "2013"),
    "song11" => array("Anarchy in the U.K.", "music/sp.png", "Sex Pistols", "1977"),
    "song12" => array("Indestructible", "music/rd.png", "Rancid", "2003")
  );

  $pop = array(
    "song13" => array("Perfect", "music/1d.png", "One Direction", "2015"),
    "song14" => array("Surfer Girl", "music/bb.png", "The Beach Boys", "1963"),
    "song15" => array("Nicotine", "music/pd.png", "Panic! at the Disco", "2013"),
    "song16" => array("Maps", "music/m5.png", "Maroon 5", "2014")
  );

  function get_random($source, $amount){
    $random = array();
    foreach (array_rand($source, $amount) as $id)
      $random[$id] = $source[$id];
    return $random;
  }

  $top_classic = get_random($classic, 2);
  $top_rock = get_random($rock, 2);
  $top_punk = get_random($punk, 2);
  $top_pop = get_random($pop, 2);
  $top = array_merge($top_classic, $top_rock, $top_punk, $top_pop);

  $all = array_merge($classic, $rock, $punk, $pop);

  function print_songs($songs){
    foreach ($songs as $id => $details): ?>
      <div class="col-md-3 text-center song-item-wrapper">
        <div id="<?php echo($id) ?>" class="panel padded-small border-black semi-transparent-white rounded-corner-smaller song-item">
          <img class="img-responsive img-rounded rounded-corner-smaller" src="<?php echo("images/".$details[1])?>">
          <div class="song-text">
            <h3 id="name" class="text-white bordered-text-song"><?php echo($details[0]) ?></h3>
            <h4 id="author" class="text-white bordered-text-song"><?php echo($details[2]) ?></h4>
            <h4 id="date" class="text-white bordered-text-song"><?php echo($details[3]) ?></h4>
          </div>
        </div>
      </div>
    <?php endforeach;
  }

  function print_sort_button(){ ?>
    <div class="sort-button" style='font-family:"Helvetica Neue",Helvetica,Arial,sans-serif, FontAwesome'>
      <select class="selectpicker sort-select">
        <option selected disabled hidden value="none;0">Ordenar por…</option>
        <option value="name;1">&#xF15D Nome [A-Z]</option>
        <option value="name;-1">&#xF15E Nome [Z-A]</option>
        <option value="author;1">&#xF15D Autor [A-Z]</option>
        <option value="author;-1">&#xF15E Autor [Z-A]</option>
        <option value="date;-1">&#xF162 Mais recente primeiro</option>
        <option value="date;1">&#xF163 Mais antigo primeiro</option>
      </select>
    </div>
  <?php } ?>

<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-md-2 align-middleisher">
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
          <div class="sidemenu-item" onClick="showClassic()">
            <span class="fa fa-music fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="classic-option" class="text-white bordered-text-small inline">Clássica</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showRock()">
            <span class="fa fa-music fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="rock-option" class="text-white bordered-text-small inline">Rock</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showPunk()">
            <span class="fa fa-music fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="punk-option" class="text-white bordered-text-small inline">Punk</h4></span>
          </div>
          <br>
          <div class="sidemenu-item" onClick="showPop()">
            <span class="fa fa-music fa-2x fa-inverse bordered-text pull-left align-icon"></span>
            <span><h4 id="pop-option" class="text-white bordered-text-small inline">Pop</h4></span>
          </div>
        </div>
      </div>

      <div id="middle" class="col-md-7">
        <div id="main" class="song-menu">
          <?php print_sort_button(); ?>
          <div class="col-md-12 no-padding song-section">
            <h2 id="name" class="text-white bordered-text-song">Mais populares</h2>
            <?php print_songs($top); ?>
          </div>
        </div>
        <div id="classic" class="song-menu song-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-song">Clássica</h2>
          <?php print_songs($classic); ?>
        </div>
        <div id="rock" class="song-menu song-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-song">Rock</h2>
          <?php print_songs($rock); ?>
        </div>
        <div id="punk" class="song-menu song-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-song">Punk</h2>
          <?php print_songs($punk); ?>
        </div>
        <div id="pop" class="song-menu song-section hidden">
          <?php print_sort_button(); ?>
          <h2 id="name" class="text-white bordered-text-song">Pop</h2>
          <?php print_songs($pop); ?>
        </div>
        <div id="search-results" class="song-menu song-section hidden">
          <h2 id="name" class="text-white bordered-text-song">Resultados da pesquisa</h2>
        </div>
      </div>

      <div id="right" class="col-md-3">
        <div class="col-md-offset-2 col-md-8 col-md-offset-2" style="position: relative; top: 22px;">
          <span class="fa fa-list-ol fa-3x fa-inverse bordered-text pull-left align-icon"></span>
          <span><h2 class="text-white bordered-text-small inline">Playlist</h2></span>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div id="playlist" class="playlist">
          <div id="blank-song" class="col-md-12 playlist-item">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-7 text-center">
                <h4 id="name" class="text-white bordered-text inline">Blank Name</h4>
                <h4 class="text-white bordered-text inline"> - </h4>
                <h4 id="author" class="text-white bordered-text inline">Blank Author</h4>
              </div>
              <div class="col-md-5 text-center">
                <span id="thumbs-down" class="fa fa-thumbs-o-down fa-2x fa-inverse bordered-text pull-left align-icon cart-remove"></span>
                <span><h4 id="score" class="text-white bordered-text inline">1</h4></span>
                <span id="thumbs-up" class="fa fa-thumbs-up fa-2x fa-inverse bordered-text pull-right align-icon cart-add"></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="help-dialog" style="display: none;">
        Este menu é dedicado ao pedido de musica ambiente do bar.
        <br>
        <br>
        Do lado esquerdo pode seleccionar qual a categoria que deseja visualizar, ou procurar por uma dada música.
        <br>
        Pode carregar nos botões que aparecem, com cada música, para o adicionar à playlist.
        <br>
        Do lado direito pode pode vizualizar a playlist da musica do bar.
      </div>
    </div>
    <?php include("includes/popup.html");?>
    <?php include("includes/footer.html");?>
    <?php include("includes/includes.html");?>

    <!-- Custom Script -->
    <script src="js/jukebox.js"></script>
    <script>
      set_help_dialog_element($('#help-dialog'));
      set_header_text("Jukebox");
    </script>
  </body>
</html>
