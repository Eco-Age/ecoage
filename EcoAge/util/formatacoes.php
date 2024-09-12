<?php

function formata_data_pagina($data) {
  if ($data == "" OR $data == "0000-00-00") {
    return "";
  }
  $dados = explode("-", $data);
  $data_formatada = "{$dados[2]}/{$dados[1]}/{$dados[0]}";
  return $data_formatada;
}

?>