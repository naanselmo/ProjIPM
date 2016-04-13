<!DOCTYPE html>
<html lang="en">
  <?php include("includes/head.html");?>
  <body>
    <?php include("includes/header.html");?>
    <div id="wrapper" class="center-wrapper container-fluid">
      <div id="left" class="col-lg-3 align-middle"></div>
      <div id="middle" class="col-lg-6 align-middle">
        <div class="col-lg-12 text-center">
          <div class="panel padded-medium border-black semi-transparent-white">
            <span class="fa fa-glass fa-5x fa-inverse bordered-text" onclick="updateAlcoholLevel()"></span>
            <h1>Teste de Alcoolemia</h1>

            <div class="panel-body">
              <div class="col-lg-2"></div>
              <div class="col-lg-8">
                <div id="alcohol-gauge" style="height:294px; width:294px;" class="center-block"></div>
                <h3 id="alcohol-level" style="position:relative; top:-90px;">0%</h3>
              </div>
              <div class="col-lg-2"></div>
              <div class="col-lg-12">
                <h4 id="alcohol-level-description">Por favor expire para o ecrã!</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="right" class="col-lg-3 align-middle"></div>
    </div>
    <?php include("includes/popup.html");?>
    <?php include("includes/footer-submenu.html");?>
    <?php include("includes/includes.html");?>

    <!-- Custom Script -->
    <script src="js/alcoolemia.js"></script>

  </body>
</html>
