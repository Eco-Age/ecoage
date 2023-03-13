<?php
  require("../database/tecidos.php");
  include("../include/cabecalho.php");
  include("../include/navegacao.php");
  include("../util/mensagens.php");
  include("../util/formatacoes.php");  

  exibirMsg();

  $lista_tecidos = listarTecidos();
  ?>
  
  <div class="container" id="tabela">
        <table id="tabelaTecidos">
        <thead id="thead">
          <tr>
            <th></th> 
            <th></th> 
            <th></th>
            <th>Descrição</th>
            <th>Sustentável?</th>
            <th></th> 
            <th></th>
          </tr>
        </thead>
        <tbody> 
        
        <?php
          foreach ($lista_tecidos as $tecido) :
        ?>
          <tr>
            <th scope="row"><?= $tecido["id_tecidos"] ?></th>
            <td><img id="tecidotabela" src="../assets/tecido.png" alt=""></td>
            <td><?= $tecido["nome_tecidos"] ?></td>
            <td><?= $tecido["desc_tecidos"] ?></td>
            <?php
                $sustentavel = $tecido["sustentavel"] ? "checked='checked'" : "";
            ?>
            <td class="text-center">
              <input type="checkbox" class="form-check-input" name="sustentavel" <?=$sustentavel?> disabled>    
            </td>
            <td>
              <form action="editar_tecido.php" method="get">
                <input type="hidden" name="id_serie" value="<?=$tecido["id_tecidos"]?>">
                <button type="submit" class="btn btn-secondary" value="edit"><span class="material-icons">edit</span></button>
              </form>
            </td>
            <td>
              <form action="remover_tecido.php" method="post">
                <input type="hidden" name="id_serie" value="<?=$tecido["id_tecidos"]?>">
                <button type="submit" class="btn btn-danger" value="del"><span class="material-icons">delete</span></button>
              </form>
            </td>
            
          </tr>  
        <?php
          endforeach
        ?>
        </tbody>
      </table>
      <?php
      include("../include/rodape.php");  
    ?>
    <script src="../assets/script.js"></script>
</body>
</html>
