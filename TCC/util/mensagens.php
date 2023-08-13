<?php

function exibirMsg() {
  $mensagem = "";
  $tipo_msg = ""; // Inicialize a variável $tipo_msg

  if (!empty($_SESSION["msg"])) {
      $mensagem = $_SESSION["msg"];
      if (!empty($_SESSION["tipo_msg"])) {
          $tipo_msg = $_SESSION["tipo_msg"];
      }
  }

  if (!empty($mensagem)) :
  ?>
   <div class="row">
      <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
        <div class="col-10 col-sm-10 col-md-8 col-lg-8 col-xl-8" style="margin: auto">
          <p class="alert <?=$tipo_msg?> text-center">
              <?=$mensagem?>
          </p> 
        </div>
      <div class="col-auto col-sm-auto col-md-auto col-lg-auto col-xl-auto"></div>
   </div>
  <?php
  endif;

  // Limpa as variáveis de sessão após exibição
  $_SESSION["msg"] = "";
  $_SESSION["tipo_msg"] = "";
}

?>
