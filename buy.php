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

    <body id="page-pedido">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');
                

            ?>


            <section>

            <?php 


           
             if(isset($_POST['id_produto'])){

                $idProduto = $_POST['id_produto'];
                
                $sql_code = "SELECT * FROM produtos WHERE id=".$idProduto;
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                $produto = $sql_query->fetch_object();  

                print '<div class="card text-center">                                   
                            
                    <h2>Produto: '.$produto->nome.'</h2>

                    <div class="full-width">

                        <img src="img/products/'.$produto->arquivo.''.$produto->extensao.'">
                        
                    </div>
                                                
                    <p><strong>Descrição:</strong> '.$produto->descricao.'</p>

                    <a class="btn btn-primary" href="product.php?id='.$produto->id.'">Ver Produto</a>
                
                </div>';

                $sql_code = "SELECT * FROM usuario WHERE id=".$_SESSION['id'];
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                $user = $sql_query->fetch_object();  

                $sql_code = "SELECT * FROM endereco WHERE ID_Cliente=".$_SESSION['id'];

                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                print '
                    
                    <div class="card text-center">           
                    
                    <h2>Endereços</h2>

                    <select name="endereço">



                ';

                while($endereco = $sql_query->fetch_object()){

                    print '                                                    
                        <option>'.$endereco->nome_endereco.'</option>                                                       


                    ';

                }

                print '
                    
                    </select>                    

                            <div class="form-group">

                            <label for="nome">Nome do Endereço:</label>
                            <input type="text" id="nome" name="nome" value="" required placeholder="Digite nome do seu endereço aqui">

                        </div>

                        
                        <div class="form-group">

                            <label for="cep">Cep:</label>
                            <input type="text" id="cep" name="cep" required onkeypress="$(this).mask(`00000-000`)"value="" required placeholder="99999-999">
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



                    </div>

                ';



                $sql_code = "SELECT * FROM metodosdepagamento WHERE ID_Cliente=".$_SESSION['id'];

                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                print '
                    
                    <div class="card text-center">           
                    
                    <h2>Pagamento:</h2>

                    <select name="metodo_de_pagamento">



                ';

                while($metododepagamento = $sql_query->fetch_object()){

                    print '                                                    
                        <option>'.$metododepagamento->nome_do_cartao.'</option>                                                       


                    ';

                }

                print '
                    
                    </select>         
                    
                    
                    <div class="form-group">

						<label for="nome">Nome do Cartão:</label>
						<input type="text" id="nome" name="nome" required placeholder="Digite o nome do seu cartão aqui">

					</div>

					 <div class="form-group">

                        <label for="numero">Numero do Cartão:</label>
                        <input type="text" id="numero" name="numero" required onkeypress="$(this).mask(`0000 0000 0000 0000`)" placeholder="9999 9999 9999 9999">

                    </div>
					
					

                    <div class="form-group">

                        <label for="nome-titular">Nome do Titular do Cartão:</label>
                        <input type="text" id="nome-titular" name="nome-titular" required placeholder="Digite o nome do titular do cartão aqui">

                    </div>

                    <div class="form-group">

                        <label for="cpf-titular">CPF do Titular do Cartão:</label>
                        <input type="text" id="cpf-titular" name="cpf-titular" required onkeypress="$(this).mask(`000.000.000-00`)" placeholder="999.999.999-99">

                    </div>

                    <div class="form-group">

                        <label for="bandeira-cartao">Bandeira do Cartão:</label>
                        <input type="text" id="bandeira-cartao" name="bandeira-cartao" required placeholder="Digite a bandeira do cartão aqui">

                    </div>

                    <div class="form-group">
                        <label for="vencimento">Data de Vencimento do Cartão:</label>
                        <input type="text" id="vencimento" name="vencimento" onkeypress="$(this).mask(`00/0000`)" placeholder="MM/AAAA" required>
                    </div>
					
					<div class="form-group">

                        <label for="seguranca">Códio de Segurança:</label>
                        <input type="number" id="seguranca" name="seguranca" required onkeypress="$(this).mask(`000`)" placeholder="999">

                    </div>

				
                    </div>

                ';



            }

           

            ?>      

            </section>
			
			<?php 

				include('footer.php');

			?>


        </div>    


        <script>

            const selectStatus = document.querySelector('select[name="status"]');

            const containerDataEntrega = document.querySelector('#container-data-entrega');

            selectStatus.onchange = () => {

                exibirData();

            }

            function exibirData(){

                if(selectStatus.value === 'Entregue'){

                    containerDataEntrega.style.display = 'flex';

                }

                else{

                    containerDataEntrega.style.display = 'none';

                }

            }

            exibirData();


        </script>

        <script src="js/mascara-data.js"></script>

            <script>

                const statusValue = document.querySelector('#statusValue');

                document.querySelector(`select[name="status"] option[value="${statusValue.innerText}"]`).selected = true;


            </script>


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


    </body>



</html>