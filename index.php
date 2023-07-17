
<!DOCTYPE html>

<html lang="pt-BR">

    <?php 

         include('connect.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="page-index">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width">

            <?php 

                include('left-menu.php');

            ?>

            
			<?php 
						
				if($_SESSION['papel'] == 'admin' || $_SESSION['papel'] == 'colaborador'){
					
					$sql_code = "SELECT * FROM pedido";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadePedidos = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM pedido WHERE status='Entregue'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadePedidosEntregues = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM pedido WHERE status='Em Transito'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadePedidosTransito = $sql_query->num_rows;

					$sql_code = "SELECT * FROM usuario  WHERE papel='cliente'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadeUsuarios = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM usuario  WHERE papel='admin'";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadeAdmins = $sql_query->num_rows;
					
					$sql_code = "SELECT * FROM produtos";

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$quantidadeProdutos = $sql_query->num_rows;

					
					print '
					
					
					<section class="text-center painel-adm">
					
						<h2>Painel Administrativo</h2>
						
						
						<div class="flex flex-wrap justify-content-center">
						
							<div class="vendas col-33 card">
							
								<div>
								
									<h3>Vendas</h3>
									<p>Total: '.$quantidadePedidos.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/sales-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							<div class="clientes col-33 card">
							
								<div>
								
									<h3>Clientes</h3>
									<p>Total: '.$quantidadeUsuarios.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/client-icon.png">
								
								
								</div>
								
								
								
							</div>	



							<div class="produtos col-33 card">
							
								<div>
								
									<h3>Produtos</h3>
									<p>Total: '.$quantidadeProdutos.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/product-icon.png">
								
								
								</div>
								
								
								
							</div>	

							
						</div>	

					
					</section>
					
					<section class="text-center painel-adm">
					
						<h2>Pedidos</h2>
						
						
						<div class="flex flex-wrap justify-content-center">
						
							<div class="vendas col-33 card">
							
								<div>
								
									<h3>Pedidos</h3>
									<p>Total: '.$quantidadePedidos.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/total-sales-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							<div class="clientes col-33 card">
							
								<div>
								
									<h3>Pedidos Entregues</h3>
									<p>Total: '.$quantidadePedidosEntregues.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/delivery-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							<div class="produtos col-33 card">
							
								<div>
								
									<h3>Pedidos Pendentes</h3>
									<p>Total: '.$quantidadePedidosTransito.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/pendant-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							
													
						</div>	
						
						
						<a class="btn btn-primary" href="vendas.php" title="Clique nesse botão para ver mais pedidos">Ver Pedidos</a>
						
					
					
					</section>
					
					
					
					<section class="text-center painel-users painel-adm">
					
						<h2>Usuários</h2>
						
						<div class="flex flex-wrap justify-content-center">
						
							<div class="vendas col-33 card">
							
								<div>
								
									<h3>Administradores</h3>
									<p>Total: '.$quantidadeAdmins.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/admin-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
							
							<div class="clientes col-33 card">
							
								<div>
								
									<h3>Clientes</h3>
									<p>Total: '.$quantidadeUsuarios.'</p>
								
								
								</div>
								
								<div class="icon">
								
									<img src="img/admin/icons/client-icon.png">
								
								
								</div>
								
								
								
							</div>	
							
						</div>	
					
						<a class="btn btn-primary" href="panel-users.php" title="Clique nesse botão para ver o painel de usuários">Painel de Usuários</a>
					
					
					</section>
					

					';

					$sql_code = "SELECT * FROM orcamentos LIMIT 5";

	
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
					
					print '<section class="text-center painel-orcamentos painel-adm">
					
					<h2 class="full-width text-center">Últimos Orçamentos</h2>
					
					<div class="flex flex-wrap justify-content-center">
					
					<table border="1" class="content opened">
                                <tr>
                                    <td>Data</td>
                                    <td>Nome</td>
                                    <td>Telefone</td>
                                    <td>Serviço</td>
                                    <td>Endereço</td>
                                </tr>';
	
						while($orcamento = $sql_query->fetch_object()){	

						/*	print '
					
							<li class="card justify-content-space-betwen flex-wrap">
	
					
								<div class="date full-width">
	
									<span>
								
										<strong>Data:</strong> '.$orcamento->data_orcamento.'
	
									</span>
									
								</div>	
	
								<div class="full-width">
								
									<strong>Nome:</strong> '.$orcamento->nome.'
									
								</div>	
	
								<div class="full-width">
								
									<strong>Telefone:</strong> '.$orcamento->telefone.'
									
								</div>	
	
								<div class="full-width">
										
									<strong>Serviço:</strong> '.$orcamento->servico.'
									
								</div>	
	
								<div class="full-width">
	
								<strong>Endereço:</strong> 
									
									'.$orcamento->logradouro.', 
									
									'.$orcamento->numero.', 
							
									'.$orcamento->bairro.', 						
									
									'.$orcamento->cidade.',					
									
									'.$orcamento->pais.',
	
									'.$orcamento->referencia.'	
									
								</div>									
								
							</li>
	
						';*/

						print 

                        '                        
                            <tr>
								<td>'.$orcamento->data_orcamento.'</td>

                                <td>'.$orcamento->nome.'</td>

                                <td>'.$orcamento->telefone.'</td>

								<td>'.$orcamento->servico.'</td>
								
								<td>
	
									
									'.$orcamento->logradouro.', 
									
									'.$orcamento->numero.', 
							
									'.$orcamento->bairro.', 						
									
									'.$orcamento->cidade.',					
									
									'.$orcamento->pais.',
	
									'.$orcamento->referencia.'	
									
								</td>


                            </tr>                            
                            
                        ';

						}

							print '

							</table>

						</div>	

						<a class="btn btn-primary" href="orcamentos.php">Ver Todos</a>
						
					</section>';
					
					
				












					$sql_code = "SELECT ID_Cliente, COUNT(*) AS total_compras
					FROM pedido
					GROUP BY ID_Cliente
					ORDER BY total_compras DESC
					LIMIT 10;
					";
	
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);	

					print '<section class="text-center painel-users painel-adm">
					
					<h2 class="full-width text-center">Melhores Clientes</h2>
					
					<div class="flex flex-wrap justify-content-center">';

	
						while($pedido = $sql_query->fetch_object()){	
		
							$sql_code2 = "SELECT * from usuario WHERE id=".$pedido->ID_Cliente;
		
							$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
		
							$user = $sql_query2->fetch_object();

								print '				
									<div class="col-33 card flex-wrap">

										<div class="icon">

										';
										
										if($user->avatar != ''){

											print '<img src="img/users/'.$user->avatar.'.'.$user->extensao.'" style="border-radius: 100%">';

										}

										else{

											print '<img src="img/user.png">';

										}


										print'
										
										
										</div>
									


										<div>
										
											<p>Nome: '.$user->nome.'</p>
											<p>E-mail: '.$user->email.'</p>
											<p>Telefone: '.$user->telefone.'</p>

										
										
										</div>
										
										<div class="full-width actions">
										
											<a class="btn btn-primary" href="new-user-admin.php?id='.$user->id.'" title="Ver usuário">Ver</a>
										
										
										</div>
										
										

										
									</div>	
															
								
							
							';

						}

						print '
						</div>	
						
						</section>';
					
					
				}
			
			
			?>


				<?php
				
				
				// $sql_code = "SELECT ID_Cliente, COUNT(*) AS total_compras
				// FROM pedido
				// GROUP BY ID_Cliente
				// ORDER BY total_compras DESC
				// LIMIT 10;
				// ";

				// $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


				// while($pedido = $sql_query->fetch_object()){


				// 	$sql_code2 = "SELECT * from usuario WHERE id=".$pedido->ID_Cliente;

				// 	$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);

				// 	$user = $sql_query2->fetch_object();

				// 	print 'Nome: '.$user->nome.'<br>';



				// 	print $pedido->ID_Cliente.'<br>';

				// }

				// print 'Deu certo';

				
				
				?>
			
			
			
			<?php
			
			if($_SESSION['papel'] == 'cliente' || !isset($_SESSION['papel'])){
				
			?>
			

				<section class="banner flex align-items-center justify-content-center">

					<div class="col-50">

						<h1>CASA FORTE PROJETOS E SERVIÇOS DE SEGURANÇA</h1>

						<h2>Segurança, Instalação e Monitoramento de Câmeras e Alarmes</h2>

					</div>

				</section>

				<section class="up">
					
					<div id="container-icons">

						<div class="col-33 flex item">

							<img src="" alt="">

							<div>
								<h2>PROTEÇÃO</h2>

								<p>SEGURANÇA PRIVADA</p>

							</div>

						</div>

						<div class="col-33 flex item">

							<img src="" alt="">

							<div>
								<h2>MONITORAMENTO</h2>

								<p>DIVERSOS SETORES</p>

							</div>

						</div>

						<div class="col-33 flex item">

							<img src="" alt="">

							<div>
								<h2>IMPRESSÃO DIGITAL</h2>

								<p>BIOMETRIA</p>

							</div>

						</div>

					</div>
					
					
				</section>

				<section class="margin-0">

					<div class="text-center boxed">

						<h2 class="font-primary"> QUEM SOMOS...</h2>

						<h3 class="font-secondary">Nossa Empresa, foi criada e desenvolvida especificamente para garantir segurança e tranquilidade as familias, bem como as Empresas.

 

Nossa equipe e formada por profissionais altamente qualificados, equipamentos de ultima geração e tecnologia de ponta.

 

Desenvolvimento de projetos individualizado e especifico a necessidade de cada cliente.</h3>

					</div>

					<div class="boxed flex flex-wrap">

						<div class="col-50">

							<div class="bg" id="bg-1"></div>

							<div class="coment">

								<p class="font-primary">SEGURANÇA PROFISSIONAL </p>
								<p class="font-secondary">Especialistas e equipe</p>

							</div>


						</div>

						<div class="col-50">

							<div class="bg" id="bg-2"></div>

							<div class="coment">

								<p class="font-primary">EXPLORE A TÉCNICA</p>
								<p class="font-secondary">SEGURANÇA DO GUARDA-COSTAS</p>

							</div>

						
						</div>



					</div>

				</section>


				<section class="boxed">

					<div class="text-center">

						<h2 class="font-primary">SERVIÇOS</h2>

						<h3 class="font-secondary">CÂMERAS DE SEGURANÇA</h3>

					</div>

					<div class="flex flex-wrap">

						<div class="col-33 text-center">

							<div class="card-model-2">

							<img src="img/home/icons/servicos/responsive-design.png" alt="">

								<h2>Câmeras com acesso em tempo real via celular, computador ou tablet</h2>

								<p>Lorem ipsum dolor ame elit, sed do eiusmod tempor incididunt</p>

							</div>

						</div>

						<div class="col-33 text-center">

							<div class="card-model-2">

							<img src="img/home/icons/servicos/face.png" alt="">

								<h2>Câmeras com Sistema de identificação facial</h2>

								<p>Lorem ipsum dolor ame elit, sed do eiusmod tempor incididunt</p>

							</div>

						</div>


						<div class="col-33 text-center">

							<div class="card-model-2">

							<img src="img/home/icons/servicos/movement.png" alt="">

								<h2>Câmeras com sensor de movimento e sensor de calor</h2>

								<p>Lorem ipsum dolor ame elit, sed do eiusmod tempor incididunt</p>

							</div>

						</div>


					</div>
					

				
				</section>

						
				<div class="text-center boxed">

					<h2 class="font-primary">NOSSOS PRODUTOS</h2>

					<h3 class="font-secondary">CONFIRA NOSSAS NOVIDADES.</h3>

				</div>
		


				<section class="flex justify-content-center carrousel-scroll margin-0">

				
					<div class="seta-carrousel left"><img src="img/carrousel/icons/circulo-de-flecha.png" class="espelhar" alt="<"></div>  
					
						<div class="carrousel-scroll-itens">

							<?php 

								include('blocks/carrousel-scroll/carrousel-scroll-item-1.php');

							?>

							
						</div>

					<div class="seta-carrousel right"><img src="img/carrousel/icons/circulo-de-flecha.png" alt=">"></div> 
				
				
				</section>
				
				<script src="js/carrousel-scroll.js"></script>

						
				<section class="margin-0">
						
					<div class="text-center boxed">

						<h2 class="font-primary">COMO TRABALHAMOS</h2>

						<h3 class="font-secondary">CONFIRA AS CARACTERISTICAS DOS NOSSOS PROJETOS</h3>

					</div>

					<div class="flex flex-wrap">

						<div class="col-33">

							<div class="card-model-3 bg-1">

								<div class="content">

									<h3>RECONHECIMENTO FACIAL</h3>
									<p>Sistema e equipamentos com sensores de reconhecimento facial, através de cadastros dos moradores dos condominios, ou funcionários das Empresas,  ou ainda de imagens disponibilizadas nas redes sociais e cadastros oficiais.

</p>

								</div>


							</div>


						</div>

						<div class="col-33">

							<div class="card-model-3 bg-2">

								<div class="content">
									<h3>CONTROLADORES DE ACESSO RESIDENCIAL  E DE PORTARIA PREDIAL</h3>
									<p>Sistema de controle de acesso de moradores e de funcionários de Empresas, através da biometria digital, facial ou de leitura de retina.

</p>


								</div>


							</div>

							
						</div>


						<div class="col-33">

							<div class="card-model-3 bg-3">

								<div class="content">

									<h3> SISTEMA DE MONITORAMENTO E ALARME</h3>

									<p>Nosso Sistema de Alarme Residencial possui equipamentos de última geração que garantem o monitoramento 24 horas por dia da sua residência. Com o Monitoramento Residencial  você pode contar com a melhor proteção para seu lar, da sua família e de seu patrimônio</p>

								</div>



							</div>

							
						</div>


					</div>



				</section>


				<section>

					<div class="boxed flex flex-wrap">

						<div class="col-50 flex align-items-center">

							<div class="text-pad">
								<h2 class="font-primary">Nossos projetos</h2>
								<h3 class="font-secondary">Projetos personalizados que e atendem casas, apartamentos, sobrados etc...</h3>

								<p>Nossos projetos são personalizados e atendem casas, apartamentos, sobrados etc. O monitoramento e alarme possibilita através de sensores de presença, sensores perimetrais, câmeras de segurança e botões de pânico garantindo a detecção de intrusos, que permite uma atuação de maneira eficaz em qualquer situação de emergência.</p>

							</div>	
					
						</div>


						<div class="col-50">

							<img src="img/home/nossos-projetos.jpg" alt="">

						</div>


					</div>

				</section>
					


			<?php
			
			}
				
			?>

			<?php 

				include('footer.php');

			?>


        </div>
        



    </body>



</html>