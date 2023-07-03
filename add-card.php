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

    <body id="add-card">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


			<section>

				<form method="post" action="config/new-card.php"  enctype="multipart/form-data">


					<div class="form-group">
						<h2>Adicionar Novo Cartão</h2>
					</div>
					
					<input name="id_cliente" type="hidden" value="<?php echo $_SESSION['id']; ?>">

					<div class="form-group">

						<label for="nome">Nome do Cartão:</label>
						<input type="text" id="nome" name="nome" required placeholder="Digite o nome do seu cartão aqui">

					</div>

					 <div class="form-group">

                        <label for="numero">Numero do Cartão:</label>
                        <input type="text" id="numero" name="numero" required onkeypress="$(this).mask('0000 0000 0000 0000')" placeholder="9999 9999 9999 9999">

                    </div>
					
					

                    <div class="form-group">

                        <label for="nome-titular">Nome do Titular do Cartão:</label>
                        <input type="text" id="nome-titular" name="nome-titular" required placeholder="Digite o nome do titular do cartão aqui">

                    </div>

                    <div class="form-group">

                        <label for="cpf-titular">CPF do Titular do Cartão:</label>
                        <input type="text" id="cpf-titular" name="cpf-titular" required onkeypress="$(this).mask('000.000.000-00')" placeholder="999.999.999-99">

                    </div>

                    <div class="form-group">

                        <label for="bandeira-cartao">Bandeira do Cartão:</label>
                        <input type="text" id="bandeira-cartao" name="bandeira-cartao" required placeholder="Digite a bandeira do cartão aqui">

                    </div>

                    <div class="form-group">
                        <label for="vencimento">Data de Vencimento do Cartão:</label>
                        <input type="text" id="vencimento" name="vencimento" onkeypress="$(this).mask('00/0000')" placeholder="MM/AAAA" required>
                    </div>
					
					<div class="form-group">

                        <label for="seguranca">Códio de Segurança:</label>
                        <input type="number" id="seguranca" name="seguranca" required onkeypress="$(this).mask('000')" placeholder="999">

                    </div>

					

					<div class="form-submit-group flex flex-wrap justify-content-space-betwen">

						<input class="btn-primary" type="submit" id="submit" value="Adicionar Novo Cartão">

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
