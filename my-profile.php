<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect.php');

    ?>

    <head>

	
		<script src="jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
		<script src="jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>



        <?php 

            include('head.php');

        ?>

    </head>

    <body id="page-my-profile">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


		<section class="flex flex-wrap">


						
			<div class="col-25">
				
				<div class="">
				
					<ul class="menu-perfil">
					
						<li>
							
							<a href="#" id="btn-dates" title="Clique aqui ver seus dados">
							
							<div class="icon">
								
								<img src="img/my-profile/user.png">
							
							
							</div>
							
							
							Meus Dados</a>
							
						</li>
						
						<?php 

							if($_SESSION['papel'] == 'cliente'){

						?>						

							<li>
								
								<a href="#" id="btn-adress" title="Clique aqui para ver seus endereços">
									
								<div class="icon">
									
									<img src="img/my-profile/address.png">
								
								
								</div>
									
								Endereços</a>
								
							</li>
							
							<li>
								
								<a href="#" id="btn-cards" title="Clique aqui para ver seus cartões">
									
								<div class="icon">
								
									<img src="img/my-profile/cards.png">
								
								
								</div>
								
								
								Cartões</a>
								
							</li>
							
							<li>
								
								<a href="meus-pedidos.php" title="Clique aqui para ver seus pedidos">
									
								<div class="icon">
								
									<img src="img/my-profile/pedidos.png">

								
								
								</div>
								
								
								Meus Pedidos</a>
								
							</li>


						<?php 

							}

						?>			
													
					</ul>
				
				</div>
			
			</div>

			<div class="card" id="dados">
			
				<form method="post" action="config/my-profile.php"  enctype="multipart/form-data">

				<?php 
					
					$sql_code = "SELECT * FROM usuario WHERE id='{$_SESSION['id']}'";	

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$usuario = $sql_query->fetch_assoc();


				?>


					<div class="form-group">
						<h2>Meu Perfil</h2>
					</div>
					
					<div class="form-group">

						<div id="avatar-container">

							<?php
							
								if($usuario['avatar'] != ''){
									
									$avatar = $usuario['avatar'];
									
									$extensao = $usuario['extensao'];
									
									print '<img src="img/users/'.$avatar.'.'.$extensao.'" width=250  id="img-atual">
									
									<label  for="upload" class="upload"  style="display: none">
		
										<span class="upload-image">	</span>

									</label>			
									
									
										<a class="btn btn-primary actions" id="change-image">Alterar Foto</a>
									
									
									';
									
									
								}
							
								else{
									
									
									print '<img src="img/user.png" width=250  id="img-atual">
									
										<label  for="upload" class="upload"  style="display: none">
			
										<span class="upload-image">	</span>

									</label>			
									
									<div class="actions">
									
										<a class="btn btn-primary" id="change-image">Alterar Foto</a>
									</div>';
									
								}
							
							
							?>

						</div>
						
						<input type="file" name="avatar" id="upload" accept="image/*" >
<!--						<input type="file" id="nome" name="nome" value="">-->

					</div>

					<script src="js/upload-avatar.js"></script>
					
					<input type="hidden" id="id" name="id" value="<?php echo $usuario['id'] ?>">
					
					<div class="form-group">

						<label for="nome">Nome Completo:</label>
						<input type="text" id="nome" name="nome" value="<?php echo $usuario['nome'] ?>" placeholder="Digite o seu nome aqui">

					</div>

					<div class="form-group">

						<label for="cpf">CPF:</label>
						<input type="text" id="cpf" name="cpf" value="<?php echo $usuario['cpfcnpj'] ?>" placeholder="Digite o seu CPF aqui" onkeypress="$(this).mask('000.000.000-00')">

					</div>
					

					<div class="form-group">

						<label for="email">E-mail:</label>
						<input type="text" id="email" name="email" readonly value="<?php echo $usuario['email'] ?>" placeholder="Digite o seu e-mail aqui">

					</div>

					<div class="form-group">

						<a href="change-password.php" class="btn btn-primary">Alterar Senha</a>

					</div>


					<div class="form-group">

						<label for="data_nascimento">Data de Nascimento:</label>
						<input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $usuario['data_nascimento'] ?>">

					</div>

					<div class="form-group">

						<label for="telefone">Telefone:</label>
						<input type="text" id="telefone" name="telefone" required onkeypress="$(this).mask('(99) 99999-9999')" value="<?php echo $usuario['telefone'] ?>" placeholder="(99) 99999-9999">
						
					</div>


					  
                    <div class="form-group">

                        <label for="cep">Cep:</label>
                        <input type="text" id="cep" name="cep" required onkeypress="$(this).mask('00000-000')" value="<?php echo $usuario['cep'] ?>" required placeholder="99999-999">
                        <a class="actions btn btn-primary" onclick="buscarEndereco2()">Buscar Endereço</a>


                    </div>


                    <div class="form-group">

                        <label for="logradouro">Logradouro:</label>
                        <input type="text" id="logradouro" name="logradouro"  value="<?php echo $usuario['rua'] ?>" required placeholder="Clique em Buscar Endereço para preencher o logradouro" readonly>

                    </div>

                    <div class="form-group">

                        <label for="numeroProfile">Numero:</label>
                        <input type="text" id="numeroProfile" name="numeroProfile"  value="<?php echo $usuario['numero'] ?>" required placeholder="Digite o número do seu endereço aqui">

                    </div>


                    <div class="form-group">

                        <label for="bairro">Bairro:</label>
                        <input type="text" id="bairro" name="bairro"  value="<?php echo $usuario['bairro'] ?>" required placeholder="Clique em Buscar Endereço para preencher o bairro" readonly>

                    </div>

                    <div class="form-group">

                        <label for="cidade">Cidade:</label>
                        <input type="text" id="cidade" name="cidade"  value="<?php echo $usuario['cidade'] ?>" required placeholder="Clique em Buscar Endereço para preencher a cidade" readonly>

                    </div>

                    <div class="form-group">

                        <label for="pais">Pais:</label>
                        <input type="text" id="pais" name="pais"  value="<?php echo $usuario['pais'] ?>" required placeholder="Clique em Buscar Endereço para preencher o pais" readonly>

                    </div>


                    <div class="form-group">

                        <label for="ponto-referencia">Ponto de Referência:</label>
                        <input type="text" id="ponto-referencia" name="ponto-referencia"  value="<?php echo $usuario['complemento'] ?>" required placeholder="Digite o ponto de referência aqui">

                    </div>




					
					<div class="form-group-submit">

						<input type="submit" value="Atualizar" class="btn btn-primary" title="Clique aqui para atualizar seu perfil">

					</div>

				
				</form>
			
			
			</div>
			
			
			
			<div class="card" id="enderecos" style="display: none;">
			
			
			
				<?php
				
					
				$sql_code = "SELECT * FROM endereco WHERE ID_Cliente='{$_SESSION['id']}'";	
				
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
//				$quantidadePedidos = $sql_query->num_rows;
				
				print '<ul>
				
					<div class="flex flex-wrap justify-content-space-around full-width">

						<h1 class="text-center">Endereços</h1>
						
						<a class="btn btn-primary" href="add-new-address.php" title="Clique aqui para adicionar novo endereço">Novo</a>
					
					</div>
				';
				
				

 				while($row = $sql_query->fetch_object()){														

						print '					
						
							<form method="post" action="config/edit-address.php" class="border-bottom-gray address">
							
								<h3>Endereço</h3>
								
							
								<input type="hidden" id="id" name="id" value="'.$row->ID.'">
								
								<div class="form-group">

									<label for="">Nome do Endereço:</label>
									<input type="text" id="" class="iptNome" name="nome" value="'.$row->nome_endereco.'" placeholder="Digite o nome do seu endereço aqui">

								</div>

								<div class="form-group">

									<label for="">Cep:</label>
									<input type="text" id="" class="iptCep"  name="cep" required onkeypress=$(this).mask("00000-000") value="'.$row->cep.'"placeholder="99999-999">
									<a class=" btn btn-primary actions btnBuscarEnd">Buscar Endereço</a>

								</div>
								
								
								
								<div class="form-group">

									<label for="">Logradouro:</label>
									<input readonly type="text" id="" class="iptLog"  name="logradouro" value="'.$row->logradouro.'"placeholder="Clique em Buscar Endereço para preencher o logradouro">

								</div>
								
								
								<div class="form-group">

									<label for="">Numero:</label>
									<input type="text" id="" class="iptNum"  name="numero" value="'.$row->numero.'"placeholder="Digite o número da sua casa aqui">

								</div>
								
								
								<div class="form-group">

									<label for="">Bairro:</label>
									<input readonly type="text" id="" class="iptBairro" name="bairro" value="'.$row->bairro.'"placeholder="Clique em Buscar Endereço para preencher o bairro">

								</div>
								
								<div class="form-group">

									<label for="">Cidade:</label>
									<input readonly type="text" id="" class="iptCidade"  name="cidade" value="'.$row->cidade.'" placeholder="Clique em Buscar Endereço para preencher a cidade">

								</div>



								<div class="form-group">

									<label for="">País:</label>
									<input readonly type="text" id="" class="iptPais"  name="pais" value="'.$row->pais.'"placeholder="Clique em Buscar Endereço para preencher o pais">

								</div>
								
								
								
								<div class="form-group">

									<label for="ponto_referencia">Ponto de Referência:</label>
									<input type="text" id="ponto_referencia" name="ponto_referencia" value="'.$row->ponto_referencia.'"placeholder="Digite a referencia aqui">

								</div>
								
								<div class="flex justify-content-space-betwen actions">

									<a href="delete-address.php?id='.$row->ID.'" class="btn btn-delete" title="Clique aqui para excluir endereço">Excluir</a>

									<input type="submit" class="btn btn-primary" value="Atualizar" title="Clique aqui para atualizar endereço">

								</div>



							</form>'
							
						;
					
//					}


					
                }    
				
				print '</ul>';
				
				?>
			
			
			
			
			
			</div>
			
			
			
			<div class="card" id="cartoes" style="display: none;">
			
			
			
				<?php
				
					
				$sql_code = "SELECT * FROM metodosdepagamento WHERE ID_Cliente='{$_SESSION['id']}'";	
				
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
								
//				$quantidadePedidos = $sql_query->num_rows;
				
				// print '<ul>
				
				// 	<h1 class="text-center">Cartões</h1>
					
				// 	<a class="btn btn-primary" href="add-card.php" title="Clique aqui para adicionar novo cartão">Adicinar Novo Cartão</a>

				
				// ';
				

					
				print '<ul>
				
					<div class="flex flex-wrap justify-content-space-around full-width">

						<h1 class="text-center">Cartões</h1>
						
						<a class="btn btn-primary" href="add-card.php" title="Clique aqui para adicionar novo endereço">Novo</a>
					
					</div>
				';
				
				

 				while($row = $sql_query->fetch_object()){
														
//					$idProduto = $row->ID_Produtos;
//										
//					$sql_code2 = "SELECT * FROM produtos WHERE id='{$idProduto}'";
//					
//					$sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);
//
//					while($produto = $sql_query2->fetch_object()){

						print '
						
						
							<form method="post" action="config/edit-card.php" class="border-bottom-gray">
							
								<h3>Cartão</h3>
								
								<input type="hidden" id="id" name="id" value="'.$row->ID.'">
							

								<div class="form-group">

									<label for="nome">Nome do Cartão:</label>
									<input type="text" id="nome" name="nome" value="'.$row->nome_do_cartao.'" placeholder="Digite o nome do seu cartão aqui">

								</div>
								
								<div class="form-group">

									<label for="numero">Numero do Cartão:</label>
									<input type="text" id="numero" name="numero" required onkeypress="$(this).mask(`0000 0000 0000 0000`)" value="'.$row->numero_do_cartao.'" placeholder="9999 9999 9999 9999">

								</div>
								
								<div class="form-group">

									<label for="titular">Nome do Titular do Cartão:</label>
									<input type="text" id="titular" name="titular" value="'.$row->nome_titular.'" placeholder="Digite o nome do titular do cartão aqui">

								</div>
								
								<div class="form-group">

									<label for="cpf">CPF do Titular do Cartão:</label>
									<input type="text" id="cpf" name="cpf" required onkeypress="$(this).mask(`000.000.000-00`)" value="'.$row->cpf_titular.'" placeholder="999.999.999-99">

								</div>
								
								<div class="form-group">

									<label for="bandeira">Bandeira do Cartão:</label>
									<input type="text" id="bandeira" name="bandeira" value="'.$row->bandeira_do_cartao.'" placeholder="Digite a bandeira do cartão aqui">

								</div>



								<div class="form-group">

									<label for="vencimento">Data de Vencimento do Cartão:</label>
									<input type="text" id="vencimento" name="vencimento" onkeypress="$(this).mask(`00/0000`)" placeholder="MM/AAAA" value="'.$row->data_vencimento.'">

								</div>
								
								<div class="flex justify-content-space-betwen actions">

									<a href="delete-card.php?id='.$row->ID.'" class="btn btn-delete" title="Clique aqui para excluir o cartão">Excluir</a>

									<input type="submit" class="btn btn-primary" value="Atualizar" title="Clique aqui para atualizar dados do cartão">


								</div>


							</form>'
							
						;
					
//					}


					
                }    
				
				print '</ul>';
				
				?>
			
			
			
			
			
			</div>

		</section>



            <!-- <section>

            <?php 

                include('blocks/posts.php');

            ?>

            </section> -->


			<?php 

				include('footer.php');

			?>



        </div>
        
		<script>
		
			document.querySelector('#btn-dates').onclick = () =>{
				
				limparForms();
				
				
				document.querySelector('#dados').style.display = 'block';
				
			}
			
			document.querySelector('#btn-cards').onclick = () =>{
				
				limparForms();
				
				document.querySelector('#cartoes').style.display = 'block';
				
			}
			
			document.querySelector('#btn-adress').onclick = () =>{
				
				limparForms();
				
				document.querySelector('#enderecos').style.display = 'block';
				
			}
		
			const limparForms = () => {
				
				let cards = document.querySelectorAll('section .card');
				
				for(let cont = 0; cont < cards.length; cont++){
					
					cards[cont].style.display = 'none';
					
				}
				
				
				
			}


			const formAddress = document.querySelectorAll('.address');

			const iptCep = document.querySelectorAll('.iptCep');

			const btnBuscar = document.querySelectorAll('.btnBuscarEnd');

			for(let cont = 0; cont < formAddress.length; cont++){

				btnBuscar[cont].onclick = () => {

					var cep = iptCep[cont].value;
					var url = "https://viacep.com.br/ws/" + cep + "/json/";

					fetch(url, { method: 'GET' })
					.then(response => response.json())
					.then(data => {
						console.log(data);
						
						document.querySelectorAll(".iptLog")[cont].value = data.logradouro;
						document.querySelectorAll(".iptBairro")[cont].value = data.bairro;
						document.querySelectorAll(".iptCidade")[cont].value = data.localidade;
						document.querySelectorAll(".iptPais")[cont].value = "Brasil";
						
					})
					.catch(error => {
						console.log("Erro ao buscar o endereço:", error);
					});



				}

			}

			/*

			function buscarEndereco() {
			var cep = document.getElementById("cep").value;
			var url = "https://viacep.com.br/ws/" + cep + "/json/";

			fetch(url, { method: 'GET' })
			.then(response => response.json())
			.then(data => {
				console.log(data);
				
				document.getElementById("logradouro").value = data.logradouro;
				document.getElementById("bairro").value = data.bairro;
				document.getElementById("cidade").value = data.localidade;
				document.getElementById("pais").value = "Brasil";
				
			})
			.catch(error => {
				console.log("Erro ao buscar o endereço:", error);
			});
		}
					
*/

		

		document.getElementById('vencimento').addEventListener('blur', function() {
			var inputValue = this.value;
			var month = parseInt(inputValue.substring(0, 2));

			if (month <= 0 || month > 12 || inputValue === "00") {
			this.setCustomValidity('O mês deve ser um valor entre 01 e 12.');
			} else {
			this.setCustomValidity('');
			}
		});

		
		</script>

	<script>
	function buscarEndereco2() {
		var cep = document.getElementById("cep").value;
		var url = "https://viacep.com.br/ws/" + cep + "/json/";

		fetch(url, { method: 'GET' })
		.then(response => response.json())
		.then(data => {
			console.log(data);
			
			document.getElementById("logradouro").value = data.logradouro;
			document.getElementById("bairro").value = data.bairro;
			document.getElementById("cidade").value = data.localidade;
			document.getElementById("pais").value = "Brasil";
			
		})
		.catch(error => {
			console.log("Erro ao buscar o endereço:", error);
		});
	}
	</script>





    </body>



</html>