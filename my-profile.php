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
				
				<div class="card">
				
					<ul class="menu-perfil">
					
						<li>
							
							<a href="#" id="btn-dates" title="Clique aqui ver seus dados">Meus Dados</a>
							
						</li>
						
						<li>
							
							<a href="#" id="btn-adress" title="Clique aqui para ver seus endereços">Endereços</a>
							
						</li>
						
						<li>
							
							<a href="#" id="btn-cards" title="Clique aqui para ver seus cartões">Cartões</a>
							
						</li>
						
						<li>
							
							<a href="meus-pedidos.php" title="Clique aqui para ver seus pedidos">Meus Pedidos</a>
							
						</li>
						
					</ul>
				
				</div>
			
			</div>

			<div class="card" id="dados">
			
				<form method="post" action="config/my-profile.php">

				<?php 
					
					$sql_code = "SELECT * FROM usuario WHERE id='{$_SESSION['id']}'";	

					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

					$usuario = $sql_query->fetch_assoc();


				?>


					<div class="form-group">
						<h2>Meu Perfil</h2>
					</div>
					
					<div class="form-group">

						<?php
						
							if($usuario['avatar'] != ''){
								
								$avatar = $usuario['avatar'];
								
								$extensao = $usuario['extensao'];
								
								print '<img src="img/users/'.$avatar.'.'.$extensao.'" width=250>';
								
								
							}
						
							else{
								
								
								print '<img src="img/user.png" width=250>';
								
							}
						
						
						?>
						
						
<!--						<input type="file" id="nome" name="nome" value="">-->

					</div>
					
					<input type="hidden" id="id" name="id" value="<?php echo $usuario['id'] ?>">
					
					<div class="form-group">

						<label for="nome">Nome Completo:</label>
						<input type="text" id="nome" name="nome" value="<?php echo $usuario['nome'] ?>" placeholder="Digite o seu nome aqui">

					</div>
					

					<div class="form-group">

						<label for="email">E-mail:</label>
						<input type="text" id="email" name="email" readonly value="<?php echo $usuario['email'] ?>" placeholder="Digite o seu e-mail aqui">

					</div>


					<div class="form-group">

						<label for="data_nascimento">Data de Nascimento:</label>
						<input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $usuario['data_nascimento'] ?>">

					</div>

					<div class="form-group">

						<label for="telefone">Telefone:</label>
						<input type="text" id="telefone" name="telefone" required onkeypress="$(this).mask('(99) 99999-9999')" value="<?php echo $usuario['telefone'] ?>" placeholder="(99) 99999-9999">
						
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
				
					<h1 class="text-center">Endereços</h1>
					
					<a class="btn btn-primary" href="add-new-address.php" title="Clique aqui para adicionar novo endereço">Adicinar Novo Endereço</a>
				
				';
				
				

 				while($row = $sql_query->fetch_object()){
														

						print '
						
						
							<form method="post" action="config/edit-address.php" class="border-bottom-gray">
							
								<h3>Endereço</h3>
								
							
								<input type="hidden" id="id" name="id" value="'.$row->ID.'">
								
								<div class="form-group">

									<label for="nome">Nome do Endereço:</label>
									<input type="text" id="nome" name="nome" value="'.$row->nome_endereco.'" placeholder="Digite o nome do seu endereço aqui">

								</div>

								<div class="form-group">

									<label for="cep">Cep:</label>
									<input type="text" id="cep" name="cep" required onkeypress=$(this).mask("00000-000") value="'.$row->cep.'"placeholder="99999-999">
									<a href="#" class=" btn btn-primary" onclick="buscarEndereco()">Buscar Endereço</a>

								</div>
								
								
								
								<div class="form-group">

									<label for="logradouro">Logradouro:</label>
									<input type="text" id="logradouro" name="logradouro" value="'.$row->logradouro.'"placeholder="Clique em Buscar Endereço para preencher o logradouro">

								</div>
								
								
								<div class="form-group">

									<label for="numero">Numero:</label>
									<input type="text" id="numero" name="numero" value="'.$row->numero.'"placeholder="Digite o número da sua casa aqui">

								</div>
								
								
								<div class="form-group">

									<label for="bairro">Bairro:</label>
									<input type="text" id="bairro" name="bairro" value="'.$row->bairro.'"placeholder="Clique em Buscar Endereço para preencher o bairro">

								</div>
								
								<div class="form-group">

									<label for="cidade">Cidade:</label>
									<input type="text" id="cidade" name="cidade" value="'.$row->cidade.'" placeholder="Clique em Buscar Endereço para preencher a cidade">

								</div>



								<div class="form-group">

									<label for="pais">País:</label>
									<input type="text" id="pais" name="pais" value="'.$row->pais.'"placeholder="Clique em Buscar Endereço para preencher o pais">

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
				
				print '<ul>
				
					<h1 class="text-center">Cartões</h1>
					
					<a class="btn btn-primary" href="add-card.php" title="Clique aqui para adicionar novo cartão">Adicinar Novo Cartão</a>

				
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
				
				for(let cont = 1; cont < cards.length; cont++){
					
					cards[cont].style.display = 'none';
					
				}
				
				
				
			}

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


    </body>



</html>