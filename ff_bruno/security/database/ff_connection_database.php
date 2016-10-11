<?php
  try{ //aqui ele tentará se conectar com o banco
    $conexaobd = new PDO("mysql:host=localhost; dbname=ff_bruno;charset=utf8", "root", ""); //cria a conexão com o banco de dados
  } catch(PDOException $e){
    die("Erro ao se conectar com o banco de dados: ".$e->getMessage()); //se ele não conseguir se conectar a página "morrerá" e exibirá essa mensagem
  }
 ?>
