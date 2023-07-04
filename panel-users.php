<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect-adm.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="panel-users" class="panel">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<section>
				
				
				<h1 class="full-width text-center">Usuários:</h1>
				
				
			
				
				
				
				<!-- <ul>
					
					<h2>Administradores:</h2>
				
					<?php					
					
						$sql_code = "SELECT * FROM usuario WHERE papel='admin'";

						$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

						$quantidadeADMs = $sql_query->num_rows;
							
						while($admin = $sql_query->fetch_object()){
							
							print '<li class="flex justify-content-space-betwen align-items-center"><div>'.$admin->nome.'</div><div><a href="new-user-admin.php?id='.$admin->id.'" class="btn btn-primary" title="Clique nesse botão para ver mais detalhes">Ver</a></div></li>';
							
							
						}	
					
					?>
					
					
					<a href="new-user-admin.php" class="btn btn-primary" title="Clique nesse botão para adicionar novo usuário">Adicionar Usuário</a>
				
				
				</ul> -->
				
				
				
				<!-- <ul>
					
					<h2>Clientes:</h2> -->
				
					<?php					
					
						// $sql_code = "SELECT * FROM usuario WHERE papel='cliente'";

						// $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

						// $quantidadeADMs = $sql_query->num_rows;

						// $sql_code = "SELECT * FROM usuario pedido WHERE papel='cliente'";

						// $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					
						// $quantidade = $sql_query->num_rows;

						// if(!isset($_GET['page'])){

						// 	$sql_code = "SELECT * FROM usuario WHERE papel='cliente' ORDER BY id DESC LIMIT 0, 10";
					
						// 	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					
						// }
					
						// else{
					
						// 	$page = intval($_GET['page']) - 1;
					
						// 	$sql_code = "SELECT * FROM usuario WHERE papel='cliente' ORDER BY id DESC LIMIT ".$page."0, 10";
					
						// 	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					
					
						// }
					?>

					<ul>
					
						<h2>Administradores:</h2>
					
						<?php					
						
							$sql_code = "SELECT * FROM usuario WHERE papel='admin'";

							$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

							$quantidadeADMs = $sql_query->num_rows;
								
							while($admin = $sql_query->fetch_object()){
								
								print '<li class="flex justify-content-space-betwen align-items-center"><div>'.$admin->nome.'</div><div><a href="new-user-admin.php?id='.$admin->id.'" class="btn btn-primary" title="Clique nesse botão para ver mais detalhes">Ver</a></div></li>';
								
								
							}	
						
						?>
						
					
						<a href="new-user-admin.php" class="btn btn-primary" title="Clique nesse botão para adicionar novo usuário">Adicionar Usuário</a>

					</ul>

					<ul>
					
					<h2>Clientes:</h2>


					<?php

						$sql_code = "SELECT * FROM usuario pedido WHERE papel='cliente'";

						$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

						$quantidade = $sql_query->num_rows;

						if(!isset($_GET['page'])){

							$sql_code = "SELECT * FROM usuario WHERE papel='cliente' ORDER BY id DESC LIMIT 0, 10";

							$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

						}

						else{

							$page = intval($_GET['page']) - 1;

							$sql_code = "SELECT * FROM usuario WHERE papel='cliente' ORDER BY id DESC LIMIT ".$page."0, 10";

							$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


						}
							
						while($cliente = $sql_query->fetch_object()){
							
							print '<li class="flex justify-content-space-betwen align-items-center"><div>'.$cliente->nome.'</div><div><a href="new-user-admin.php?id='.$cliente->id.'" class="btn btn-primary" title="Clique nesse botão para ver mais detalhes">Ver</a></div></li>';
							
							
						}	


						if($quantidade > 10){

							$numPages = (intval($quantidade / 10)) + 1;
						
				//		$numPages = ceil((intval($quantidadeProdutos / 10)));
				
						print '
				
						<div class="pagination full-width flex justify-content-center">';
				
				
						for($a = 1; $a < $numPages+1; $a++){
				
					//		print '<a href="blog.php?page='.$a.'">'.$a.'</a>';
				
							if($a == $_GET['page'] || (!isset($_GET['page']) && $a == 1)){
				
								print '<a href="panel-users.php?page='.$a.'" class="btn-pagination-active">'.$a.'</a>';
				
							}
				
							else{
				
								print '<a href="panel-users.php?page='.$a.'">'.$a.'</a>';
				
				
							}
				
				
						}
				
				
						print '</div>';
							
				
					}

					
					?>
				
						

					
					<a href="new-user-admin.php" class="btn btn-primary" title="Clique nesse botão para adicionar novo usuário">Adicionar Usuário</a>
				
				</ul>
				
				
			</section>


			<?php 

				include('footer.php');

			?>




        </div>
        



    </body>



</html>