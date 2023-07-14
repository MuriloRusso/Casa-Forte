<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect-cliente.php');



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

                

				<form method="post" action=""  enctype="multipart/form-data" class="form-model">

                <?php              
                
                
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

                    require 'PHPMailer-master-atual/PHPMailer-master/src/Exception.php';
                    require 'PHPMailer-master-atual/PHPMailer-master/src/PHPMailer.php';
                    require 'PHPMailer-master-atual/PHPMailer-master/src/SMTP.php';

                     if(isset($_POST['nome'])){


                        $nome = $_POST['nome'];
                        $telefone = $_POST['telefone'];
                        $cep = $_POST['cep'];
                        $logradouro = $_POST['logradouro'];
                        $numero = $_POST['numero'];
                        $bairro = $_POST['bairro'];
                        $cidade = $_POST['cidade'];
                        $pais = $_POST['pais'];
                        $referencia = $_POST['ponto-referencia'];
                        $servico = $_POST['servico'];

                        $data = date('Y-m-d');
                        $data_orcamento = date('Y-m-d', strtotime($data));


						$sql_code = "INSERT INTO orcamentos (nome, telefone, cep, logradouro, numero, bairro, cidade, pais, referencia, servico, data_orcamento) VALUES ('{$nome}', '{$telefone}', '{$cep}', '{$logradouro}', '{$numero}', '{$bairro}', '{$cidade}', '{$pais}', '{$referencia}', '{$servico}', '{$data_orcamento}')";

						$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
						

                        $mail = new PHPMailer();
                        $mail->isSMTP();


                        $mail->Host = 'smtp.hostinger.com';
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = "tls";
                        $mail->Port = "587";
                        $mail->Username = 'no-reply@vertconclube.com.br';
                        $mail->Password = 'Senti@nela2021';

                        $mail->setFrom('no-reply@vertconclube.com.br', 'vertconclube');

                        $mail->addReplyTo('no-reply@vertconclube.com.br', 'vertconclube');

                        // include('config/smtp.php');



                        // $mail->addAddress('no-reply@vertconclube.com.br', 'vertconclube');

                        $mail->addAddress('contato@murilorusso.com.br', 'vertconclube');


                        // $mail->addCC('contato@murilorusso.com.br', 'SLMIT');

                        // $mail->addBCC('murilorussooo@gmail.com', 'SLMIT');	
                            
                        $mail->Subject = 'Formulário de Orçamento Preenchido';

                        $mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';


                        $mail->isHTML(true);


                    
                        $mailContent = " 
                        
                        Nome: $nome <br>

                        Telefone: $telefone  <br>

                        Cep: $cep <br>

                        Logradouro: $logradouro <br>

                        Numero: $numero <br>

                        Bairro: $bairro <br>

                        Cidade: $cidade <br>

                        Pais: $pais <br>

                        Ponto de Referência: $referencia <br>

                        Serviço: $servico <br>


                
                        
                        ";
                    
                        $mailContent = utf8_decode($mailContent);

                        $mail->Body = $mailContent;


                        if($mail->send()){

                            print '<p class="alert-sucess text-center">Solicitação Enviada Com Sucesso</p>';

                        }
                        
                        else{

                            print '<p class="btn-delete btn">'.$mail->ErrorInfo.'</p>';

                        }

                    }
                            
                
                
                ?>


					<div class="form-group full-width">
						<h2>Orçamento</h2>
					</div>

											
					<div class="form-group">

						<label for="nome">Nome:</label>
						<input type="text" id="nome" name="nome" value="" required placeholder="Digite o seu nome aqui">

					</div>


                    <div class="form-group">

						<label for="telefone">Telefone:</label>
						<input type="text" id="telefone" name="telefone" value="" required placeholder="(99) 99999-9999">

					</div>

                        <div class="form-group full-width">

                        <label for="cep">Cep:</label>
                        <input type="text" id="cep" name="cep" required onkeypress="$(this).mask('00000-000')"value="" required placeholder="99999-999">
                        <a href="#" class=" btn btn-primary actions" onclick="buscarEndereco()">Buscar Endereço</a>


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
                    <input type="text" id="ponto-referencia" name="ponto-referencia" value="" placeholder="Digite o ponto de referência aqui">

                    </div>

                    <div class="form-group full-width">

						<label for="servico">Tipo de Serviço:</label>
                        <select name="servico" id="servico">
                            <option value="Instalação">Instalação</option>
                            <option value="Manutenção">Manutenção</option>
                        </select>

					</div>



					<div class="form-submit-group flex flex-wrap justify-content-space-betwen full-width">

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