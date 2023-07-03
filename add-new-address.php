<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="new-address">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<section>

				<form method="post" action="config/new-address.php"  enctype="multipart/form-data">


					<div class="form-group">
						<h2>Novo Endereço</h2>
					</div>
					
					<input name="id_cliente" type="hidden" value="<?php echo $_SESSION['id']; ?>">

					<div class="form-group">

						<label for="nome">Nome do Endereço:</label>
						<input type="text" id="nome" name="nome" value="" required placeholder="Digite nome do seu endereço aqui">

					</div>

					
					<div class="form-group">

						<label for="cep">Cep:</label>
						<input type="text" id="cep" name="cep" required onkeypress="$(this).mask('00000-000')"value="" required placeholder="99999-999">
						<a href="#" class=" btn btn-primary" onclick="buscarEndereco()">Buscar Endereço</a>


					</div>

                    
                    <div class="form-group">

						<label for="logradouro">Logradouro:</label>
						<input type="text" id="logradouro" name="logradouro" value="" required placeholder="Clique em Buscar Endereço para preencher o logradouro" readonly>

					</div>

					<div class="form-group">

						<label for="numero">Numero:</label>
						<input type="text" id="numero" name="numero" value="" required placeholder="Digite o número do seu endereço aqui">

					</div>


                    <div class="form-group">

						<label for="bairro">Bairro:</label>
						<input type="text" id="bairro" name="bairro" value="" required placeholder="Clique em Buscar Endereço para preencher o bairro" readonly>

					</div>

                     <div class="form-group">

						<label for="cidade">Cidade:</label>
						<input type="text" id="cidade" name="cidade" value="" required placeholder="Clique em Buscar Endereço para preencher a cidade" readonly>

					</div>

                    <div class="form-group">

						<label for="pais">Pais:</label>
						<input type="text" id="pais" name="pais" value="" required placeholder="Clique em Buscar Endereço para preencher o pais" readonly>

					</div>


                        <div class="form-group">

						<label for="ponto-referencia">Ponto de Referência:</label>
						<input type="text" id="ponto-referencia" name="ponto-referencia" value="" required placeholder="Digite o ponto de referência aqui">

					</div>

					


					<div class="form-submit-group flex flex-wrap justify-content-space-betwen">

						<input class="btn-primary" type="submit" id="submit" value="Adicionar Novo Endereço">

					</div>


				</form>

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
        



    </body>



</html>

<script>
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
</script>
