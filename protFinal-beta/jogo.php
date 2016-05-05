<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-md-1 align-middleish">
      </div>

      <div id="middle" class="col-md-8">
        <div class="col-md-12 text-center" style="position: relative; top: 50px;">
          <div class="panel padded-large border-black semi-transparent-white rounded-corner">
            <div class="panel-body">
              <h1 class="text-white bordered-text" id="heartrate-description">INSERIR JOGO AQUI</h1>
              <h1 class="text-white bordered-text" id="heartrate-description">INSERIR JOGO AQUI</h1>
              <h1 class="text-white bordered-text" id="heartrate-description">INSERIR JOGO AQUI</h1>
              <h1 class="text-white bordered-text" id="heartrate-description">INSERIR JOGO AQUI</h1>
              <h1 class="text-white bordered-text" id="heartrate-description">INSERIR JOGO AQUI</h1>
              <h1 class="text-white bordered-text" id="heartrate-description">INSERIR JOGO AQUI</h1>
              <h1 class="text-white bordered-text" id="heartrate-description">INSERIR JOGO AQUI</h1>
            </div>
          </div>
        </div>
      </div>


      <div id="right" class="col-md-3">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1" style="position: relative; top: 22px;">
          <span class="fa fa-star fa-3x fa-inverse bordered-text pull-left align-icon"></span>
          <span><h2 class="bold-text text-white bordered-text-small inline">Highscores</h2></span>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div id="highscores" class="highscores">
          <div id="blank-highscore" class="col-md-12 highscore">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-12 text-center">
                <h4 id="highscore-text" class="text-white bordered-text inline">Grupo 3 - 123456789</h4>
              </div>
            </div>
          </div>
          <div id="nuno-anselmo" class="col-md-12 highscore">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-12 text-center">
                <h4 id="highscore-text" class="text-white bordered-text inline">Nuno Anselmo - 100000</h4>
              </div>
            </div>
          </div>
          <div id="andre-mendes" class="col-md-12 highscore">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-12 text-center">
                <h4 id="highscore-text" class="text-white bordered-text inline">André Mendes - 99999</h4>
              </div>
            </div>
          </div>
          <div id="guilherme-serpa" class="col-md-12 highscore">
            <div class="panel padded-small border-black semi-transparent-white rounded-corner-smaller cart-item">
              <div class="col-md-12 text-center">
                <h4 id="highscore-text" class="text-white bordered-text inline">Guilherme Serpa - 99998</h4>
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
    <script src="js/jogo.js"></script>
    <script>
      set_help_dialog_element($('#help-dialog'));
      set_header_text('<?php echo $_GET["title"] ?>');
    </script>
  </body>
</html>
