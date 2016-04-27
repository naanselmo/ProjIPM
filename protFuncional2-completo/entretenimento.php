<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-md-2 align-middle"></div>
      <div id="middle" class="col-md-8 align-middle">
        <div class="col-md-offset-2 col-md-4 text-center">
          <a href="pedidos.php">
            <div class="panel padded-large border-black semi-transparent-white rounded-corner">
              <br>
              <br>
              <h1 class="bold-text text-white bordered-text">Jukebox</h1>
              <br>
              <span class="fa fa-music fa-5x fa-inverse bordered-text"></span>
              <br>
              <br>
              <br>
            </div>
          </a>
        </div>
        <div class="col-md-4 text-center">
          <a href="pedidos.php">
            <div class="panel padded-large border-black semi-transparent-white rounded-corner">
              <br>
              <br>
              <h1 class="bold-text text-white bordered-text-small">Jogos</h1>
              <br>
              <span class="fa fa-gamepad fa-5x fa-inverse bordered-text"></span>
              <br>
              <br>
              <br>
            </div>
          </a>
        </div>
      </div>
      <div id="right" class="col-md-2 align-middle"></div>
      <div id="help-dialog" style="display: none;">
        Neste menu pode escolher uma das seguintes opções:
        <ul>
          <li>O botão de "Pedidos" é para efetuar pedidos e pagamentos.</li>
          <li>O botão de "Entretenimento" é para jogar jogos ou escolher a música ambiente do bar.</li>
          <li>O botão de "Teste de Alcoolemia" é para efetuar um teste de alcoolemia.</li>
        </ul>
        Para chamar um empregado carregue no botão da pessoa à esquerda do botão de ajuda.
        <br>
        Para aceder às definições da mesa carregue na engrenagem no canto inferior esquerdo.
      </div>
    </div>
    <?php include("includes/popup.html");?>
    <?php include("includes/footer-main.html");?>
    <?php include("includes/includes.html");?>

    <!-- Custom Script -->
    <script src="js/custom.js"></script>
    <script>
      set_help_dialog_element($('#help-dialog'));
      set_header_text("Menu Inicial");
    </script>
  </body>
</html>
