<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-md-1 align-middle"></div>
      <div id="middle" class="col-md-10 align-middle">
        <div class="col-md-6 text-center">
          <div class="panel padded-medium border-black semi-transparent-white rounded-corner">
            <h1 class="bold-text text-white bordered-text" onclick="updateAlcoholLevel()">Teste de Alcoolemia</h1>
            <div class="panel-body">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <div id="alcohol-gauge" style="height:294px; width:294px;" class="center-block"></div>
                <h3 id="alcohol-level" style="position:relative; top:-90px;">0%</h3>
              </div>
              <div class="col-md-2"></div>
              <div class="col-md-12">
                <h4 class="text-white bordered-text" id="alcohol-level-description">Por favor expire para o ecrã!</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 text-center">
          <div class="panel padded-medium border-black semi-transparent-white rounded-corner">
            <h1 class="bold-text text-white bordered-text" onclick="updateHeartrate()">Batimentos Cardíacos</h1>
            <div class="panel-body">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <div id="heartrate-gauge" style="height:294px; width:294px;" class="center-block"></div>
                <h3 id="heartrate" style="position:relative; top:-90px;">0 BPM</h3>
              </div>
              <div class="col-md-2"></div>
              <div class="col-md-12">
                <h4 class="text-white bordered-text" id="heartrate-description">Por favor coloque o polegar sobre o ícone!</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="right" class="col-md-1 align-middle"></div>

      <div id="help-dialog" style="display: none;">
        Expire para o ecrã para obter uma leitura do seu nível de álcool no sangue.
        <br>
        Indica também se ainda está ou não dentro do limite legal e quais a consequências de ser mandado parar pelas autoridades.
        <br>
        <br>
        Coloque o dedo sobre o ícone de leituras digitais para obter uma leitura dos seus batimentos cardíacos.
        <br>

      </div>
    </div>
    <?php include("includes/popup.html");?>
    <?php include("includes/footer-submenu.html");?>
    <?php include("includes/includes.html");?>

    <!-- Custom Script -->
    <script src="js/alcoolemia.js"></script>
    <script>
      set_help_dialog_element($('#help-dialog'));
      set_header_text("Medições");
    </script>
  </body>
</html>
