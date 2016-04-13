<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-lg-2 align-middle"></div>
      <div id="middle" class="col-lg-8 align-middle">
        <div class="col-lg-4 text-center">
          <div class="panel padded-medium border-black semi-transparent-white">
            <h1>---</h1>
            <span class="fa fa-star-o fa-5x fa-inverse bordered-text"></span>
            <p>(placeholder icon)</p>
          </div>
        </div>
        <div class="col-lg-4 text-center">
          <div class="panel padded-medium border-black semi-transparent-white">
            <h1>---</h1>
            <span class="fa fa-star-half-o fa-5x fa-inverse bordered-text"></span>
            <p>(placeholder icon)</p>
          </div>
        </div>
        <div class="col-lg-4 text-center">
          <a href="alcoolemia.php">
            <div class="panel padded-medium border-black semi-transparent-white">
              <h1>Teste de Alcoolemia</h1>
              <span class="fa fa-glass fa-5x fa-inverse bordered-text"></span>
            </div>
          </a>
        </div>
      </div>
      <div id="right" class="col-lg-2 align-middle"></div>
      <div id="help-dialog" style="display: none;">
        Neste menu pode escolher uma das seguintes opções:
        <ul>
          <li>A primeira opção é para efetuar pedidos e pagamentos.</li>
          <li>A segunda opção é para jogar jogos ou escolher a música ambiente do bar.</li>
          <li>A terceira opção é para efetuar um teste de alcoolemia.</li>
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
    </script>
  </body>
</html>
