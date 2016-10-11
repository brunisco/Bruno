<!DOCTYPE html>
<?php
	$permissao_acesso = "1"; /*a permissão 1, é a permissão de cliente*/
	include "../../security/ff_setup_security.php"; /*o arquivo setup centraliza os includes e verifica se o usuário tem ou não permissão para visualizar a página dependendo da permissão*/
	include "../../security/database/ff_connection_database.php";
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Bruno Luis da Silva">
		<meta name="description" content="Página da área do cliente do festival onde ele poderá reservar seu ingresso.">
		<meta name="keywords" content="Cadastro, Cliente, Reservas, Ingressos, Festival, Holiday`s Festival">
		<title>Holiday`s Festival</title>
		<link rel="stylesheet" href="../../layout/css/ff_client_css.css">
		<script src="../../addons/js/ff_clientformsvalidate_js.js"></script>
	</head>
	<body>
		<header>
			<img src="../../layout/images/client/logo_client.png">
			<nav id='topbar'>
				<ul>
					<a href="?folder=tickets&file=ff_fmbooking_tickets"><li><span class='icon ticket' ></span>Reserva de Ingressos</li></a>
					<a href="?folder=tickets&file=ff_view_tickets"><li><span class='icon reservedticket' ></span>Ingressos reservados</li></a>
					<a href="?folder=profile&file=ff_view_profile"><li><span class='icon profile' ></span>Seu Perfil</li></a>
				</ul>
			</nav>
			<a href="../../security/authentication/ff_logout_authentication.php"><span class='exit' title='Sair'></span></a>
		</header>
		<div id="content">
			<?php
				if(isset($_GET['folder']) && isset($_GET['file'])){
					/*carrega as páginas de refêrencias dos gets*/
					if(!include $_GET['folder']."/".$_GET['file'].".php"){
						echo "<h1>Página não encontrada.</h1>";
					}
				}else{
					/*carrega a página inicial*/
					include "ff_initial_client.php";
				}
			?>
		</div>
		<footer>
			&copy; Copyright 2015 Escola Sistêmica. Todos os direitos reservados.
		</footer>
	</body>
</html>
