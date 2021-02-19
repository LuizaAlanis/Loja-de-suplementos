<?php
    $servidor = "localhost"; // ou o IP do servidor
    $usuario = "ThunderSuplementos"; // ou usuário criado na hora da hospedagem
    $senha = "123456"; // respectiva senha
    $banco = "ThunderSuplementos"; // nome da base de dados
    
    $cn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

    $cnx = mysqli_connect($servidor, $usuario, $senha, $banco);
?>