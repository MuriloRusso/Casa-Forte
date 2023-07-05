<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');


    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="new-product">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');
			
				
            ?>
			
			
			
			
			<section>

                <?php                
                
                // error_reporting(9999);


                    // require 'PHPMailer-master/PHPMailerAutoload.php';
/*
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                
                    $mail->Host = "smtp.hostinger.com";
                    $mail->Port = "465";
                    $mail->SMTPSecure = "tls";
                    $mail->SMTPAuth = "true";
                    $mail->Username = "no-reply@vertconclube.com.br";
                    $mail->Password = "Senti@nela2021";
                
                
                    $mail->setFrom($mail->Username, 'Site'); //remetente
                    $mail->addAddress('contato@murilorusso.com.br');
                    $mail->Subject = 'Formulário de Orçamento Preenchido';
                
                    $mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';
                
                    $conteudo_email = " 
                    
                    Formulário de Orçamento Preenchido
                    
                    ";
                
                
                    $conteudo_email = utf8_decode($conteudo_email);
                
                    $mail->IsHTML(true);
                    $mail->Body = $conteudo_email;
                
                    $mail->send();*/
                    
                
                   /* if($mail->send()){
                        
                        $mail->ClearAllRecipients();
                        
                        $mail->addAddress('arthur@2up.com.br');
                        
                        $mail->send();
                        
                        header("Location: index.php?alert=sucess");
                        
                    }
                
                    else{
                        
                        header("Location: index.php?alert=error".$mail->ErrorInfo);
                        
                    }*/
                
                
                
                    
                    
                    
                    
                
                
                
                
                ?>

				<form method="post" action=""  enctype="multipart/form-data">

					<div class="form-group">
						<h2>Orçamento</h2>
					</div>

											
					<div class="form-group">

						<label for="nome">Nome:</label>
						<input type="text" id="nome" name="nome" value="" required placeholder="Digite o titulo do post aqui">

					</div>


                    <div class="form-group">

						<label for="telefone">Telefone:</label>
						<input type="text" id="telefone" name="telefone" value="" required placeholder="(99) 99999-9999">

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

                    <div class="form-group">

						<label for="servico">Tipo de Serviço:</label>
                        <select name="servico" id="servico">
                            <option value="Instalação">Instalação</option>
                            <option value="Manutenção">Manutenção</option>
                        </select>

					</div>



					<div class="form-submit-group flex flex-wrap justify-content-space-betwen">

						<input type="submit" value="Enviar" class="btn btn-primary">

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
                alert("Erro ao buscar o endereço:", error);
            });
        }
        </script>    


    </body>



</html>