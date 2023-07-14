<html lang="pt-BR">

	<?php

		print '


		<header class="flex full-width justify-content-space-betwen fixed">

			<a href="#" id="logo" class="flex justify-content-center align-items-center font-white">
				<img src="img/logo.jpeg" alt="Logo">


			</a>


			<nav class="flex align-items-center menu desktop">

				<ul class="flex align-items-center">

					<li><a href="index.php" title="Clique nesse botão para ir ao início da página">Home</a></li>

					<li>

						<a href="products.php" title="Clique nesse botão para ir a seção de produtos">Produtos</a>

						<ul class="card sub-menu-category">

							 <li><a id="btn-category-1" href="ambiente.php">Ambiente Externo</a></li>
							<li><a id="btn-category-2" href="residencial.php">Residencial</a></li>
							<li><a id="btn-category-3" href="comercial.php">Comercial</a></li>


						</ul>

					</li>

					<li><a href="blog.php" title="Clique nesse botão para ir a seção de blog">Blog</a></li>
					<li><a href="orcamento.php" title="Clique nesse botão para ir a seção de Orçamento">Orçamento</a></li>


				</ul>

			</nav>

			<span id="btn-menu-mobile" class="mobile open">

				<hr><hr><hr>

			</span>

			<span id="btn-close-menu-mobile" class="mobile">

				X

			</span>



			<nav class="mobile menu-mobile full-width">

				<ul>

					 <li><a href="index.php">Home</a></li>
					<li><a href="products.php">Produtos</a></li>
					<li><a href="blog.php">Blog</a></li>
					';

					$sql_code = "SELECT * FROM usuario WHERE id='{$_SESSION['id']}'";	

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$usuario = $sql_query->fetch_assoc();

					if($usuario['papel'] != 'admin'){
					
						print '<li><a href="orcamento.php">Orçamento</a></li>';

					}


					if(!isset($_SESSION['id'])){

						print '
							<li class="btn-entrar"><a href="login.php">Entrar</a></li>

						';
					}
					else{

						print '

							<li><a href="logout.php">Sair</a></li>

						';

					}


					print '

				</ul>

			</nav>


			';

			if(!isset($_SESSION)){

				session_start();

			}

			if(!isset($_SESSION['id'])){

				print '
				<ul id="box-login" class="flex align-items-center desloged">

				<a href="login.php" class="btn btn-primary" title="Clique nesse botão para entrar">Entrar</a>';                  


			}

			else{

				$sql_code = "SELECT * FROM usuario WHERE id='{$_SESSION['id']}'";	

				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

				$usuario = $sql_query->fetch_assoc();

				print '

				<ul id="box-login" class="flex align-items-center loged">
				';

				if($usuario['avatar'] != ''){

					$avatar = $usuario['avatar'];

					$extensao = $usuario['extensao'];

					print '<img src="img/users/'.$avatar.'.'.$extensao.'" alt="Avatar" class="avatar" width=50 height=50>';


				}

				else{


					print '<img src="img/user.png" alt="Avatar" class="avatar" width=50 height=50>';

				}




				print '<span class="nome-usuario">'.$_SESSION['nome'].'</span><span class="seta flex align-items-center"><img src="img/header/icon/seta.png"></span>

				<li class="sub-menu card">

					<ul>

						<li><a class="btn" href="my-profile.php" title="Clique aqui para ver seu perfil">Meu Perfil</a></li>
						';

						if($usuario['papel'] === 'cliente'){

							print '

							<li><a class="btn" href="meus-pedidos.php" title="Clique aqui para ver seus pedidos">Meus Pedidos</a></li>
							<li><a class="btn" href="carrinho.php" title="Clique aqui para ver seu carrinho">Meu Carrinho</a></li>

							';

						}

						print '<li><a class="btn btn-primary btn-sair" href="logout.php" title="Clique aqui para sair">Sair</a></li>

					</ul>

				</li>

				';

			}


			print '

			</ul>

		</header>


		<script src="js/menu-mobile.js"></script>

		';

	?>


</html>