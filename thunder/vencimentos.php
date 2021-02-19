<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleFAQ.css">
    <title>ThunderSuplementos</title>
</head>
<body>
  <?php
      session_start();
      if(empty($_SESSION['Status']) || $_SESSION['Status']!=1){
          header('location:index.php'); //volte para o Index
      }

      include 'shared/sidenav.php';
      include 'shared/conexao.php';	
      
      $consulta = $cn->query("SELECT id, validadeProduto from estoque ORDER BY validadeProduto ASC");
  ?>  

    <div class="geral">
        <div class="animated animatedFadeInUp fadeInUp">
            <div class="space">
                <h2>Vencimentos</h2>
            </div>
            <div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <symbol viewBox="0 0 24 24" id="expand-more">
                    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/><path d="M0 0h24v24H0z" fill="none"/>
                    </symbol>
                    <symbol viewBox="0 0 24 24" id="close">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/>
                    </symbol>
                </svg>
            </div>

            <details open>
                <summary>
                Sobre
                    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
                </summary>
                <p>Aqui você consegue ver todos aqueles produtos vencidos e/ou que estão perto de vencer</p>
            </details>

            <details>
                <summary>
                Legenda
                    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
                </summary>
                </br>
                <h6 class="darkBlue">Esse lote está vencido! Remova-o do seu estoque.</h6>
                <h6 class="blue">Menos de dois meses para vencer, hora de fazer uma promoção.</h6>
                <h6 class="green">Bom prazo de validade</h6>
            </details>

            <details>
                <summary>
                Produtos
                    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
                    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg>
                </summary>
                <?php

                    echo "<br>";
                    while ($exibe = $consulta->fetch(PDO::FETCH_ASSOC)) {

                        $data1 = date('Y-m-d');
                        $data2 = $exibe['validadeProduto'];

                        $d1 = strtotime("$data1");
                        $d2 = strtotime("$data2");

                        $dataFinal = ($d2 - $d1) / 86400;
                        $codigo = $exibe['id'];
                        $dataFinal = ceil($dataFinal);

                        if($dataFinal < 0)
                            echo "<h6 class='darkBlue'> O lote número $codigo está vencido.</h6>";
                        else if($dataFinal >= 0 &&  $dataFinal <= 60)
                            echo "<h6 class='blue'> O lote número $codigo vence em $dataFinal dias.</h6>";
                        else
                            echo "<h6 class='green'> O lote número $codigo vence em $dataFinal dias.</h6>";
                    } 

                ?>
            </details>
        </div>
    </div>
</body>
</html>