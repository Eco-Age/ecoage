<?php

function exibirMsg() {
  $mensagem = "";
  if(!empty($_SESSION["msg"])){
    $mensagem = $_SESSION["msg"];
    if(!empty($_SESSION["tipo_msg"])){
      $tipo_msg = $_SESSION["tipo_msg"];
    }
  }
  if (!empty($mensagem)) :
  ?>
    <p class="alert <?=$tipo_msg?> text-center">
      <?=$mensagem?>
    </p>  
  <?php
  endif;
  $_SESSION["msg"] = "";
  }
?>
