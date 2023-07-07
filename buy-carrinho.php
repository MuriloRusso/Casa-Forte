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

    <body id="page-buy">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');
                

            ?>


            <section>

            <form action="">

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
                                                    
                        <p class="actions"><strong>Descrição:</strong> '.$produto->descricao.'</p>

                        <a class="btn btn-primary" href="product.php?id='.$produto->id.'">Ver Produto</a>

                        <div class="form-group">	

                            <label>Preço Unitário:</label>

                            <h2>R$: '.$produto->preco .'</h2>



                            <input type="hidden" readonly name="preco" id="preco" value="'.$produto->preco .'">


                        </div>

                    
                    </div>';


                    print '<div class="card text-center">                                   
                                
                        <h2>Detalhes da Compra:</h2>


                        <div class="form-group">	

                            <label>Quantidade:</label>


                            <input type="number" min="1" name="quantidade" id="quantidade" placeholder="" value="'.$_POST['quantidade'].'">


                        </div>


                        
                    
                    </div>';

                    $sql_code = "SELECT * FROM usuario WHERE id=".$_SESSION['id'];
        
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                    $user = $sql_query->fetch_object();  

                    $sql_code = "SELECT * FROM endereco WHERE ID_Cliente=".$_SESSION['id'];

                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                    print '
                        
                        <div class="card text-center">           
                        
                        <h2>Endereços:</h2>

                        <div class="form-group">

                        <select name="endereço" id="endereco">

                        <option value="">Seus Endereços Salvos</option>



                    ';

                    while($endereco = $sql_query->fetch_object()){

                        print '                                                    
                            <option 
                            data-cep="'.$endereco->cep.'"
                            data-logradouro="'.$endereco->logradouro.'"
                            data-numero="'.$endereco->numero.'"
                            data-cidade="'.$endereco->cidade.'"
                            data-bairro="'.$endereco->bairro.'"
                            data-pais="'.$endereco->pais.'"
                            data-referencia="'.$endereco->ponto_referencia.'" 
                            value="'.$endereco->ID.'">'
                            .$endereco->nome_endereco.'
                            </option>                                                       


                        ';

                    }

                    print '
                        
                        </select>    
                        
                        </div>

                                                        
                            <div class="form-group">

                                <label for="cep">Cep:</label>
                                <input type="text" id="cep" name="cep" required onkeypress="$(this).mask(`00000-000`)"value="" required placeholder="99999-999">
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
                                <input type="text" id="ponto-referencia" name="ponto-referencia" value="" required placeholder="Digite o ponto de referência aqui">

                            </div>



                        </div>

                    ';



                    $sql_code = "SELECT * FROM metodosdepagamento WHERE ID_Cliente=".$_SESSION['id'];

                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                    print '
                        
                        <div class="card text-center">           
                        
                        <h2>Pagamento:</h2>

                        <div class="form-group">


                        <select name="metodo_de_pagamento" id="pagamento">

                        <option value="">Seus Cartões Salvos</option>

                    ';

                    while($metododepagamento = $sql_query->fetch_object()){

                        print '                                                    
                            
                            <option 
                            data-numero="'.$metododepagamento->numero_do_cartao.'"
                            data-vencimento="'.$metododepagamento->data_vencimento.'"
                            data-codigo="'.$metododepagamento->codigo_seguranca.'"
                            data-nome="'.$metododepagamento->nome_titular.'"
                            data-cpf="'.$metododepagamento->cpf_titular.'"
                            data-bandeira="'.$metododepagamento->bandeira_do_cartao.'"
                            value="'.$metododepagamento->ID.'">
                            
                            '.$metododepagamento->nome_do_cartao.'
                            </option>                                                       



                        ';

                    }

                    print '
                        
                        </select>    
                        
                        <div>
                    

                        <div class="form-group">

                            <label for="numero">Numero do Cartão:</label>
                            <input type="text" id="numero-cartao" name="numero" required onkeypress="$(this).mask(`0000 0000 0000 0000`)" placeholder="9999 9999 9999 9999">

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

                <div class="form-group-submit">

                    <input type="submit" value="Confirmar" class="btn btn-primary">

                </div>


            </form>
            


            </section>
			
			<?php 

				include('footer.php');

			?>


        </div>    

            <script>

                let selectAddress = document.querySelector('#endereco');

                selectAddress.onchange = function() {

                    const options = selectAddress.querySelectorAll('option');

                    for(let cont = 0; cont < options.length; cont++){

                        if(options[cont].selected === true){

                            document.querySelector('#cep').value = options[cont].getAttribute('data-cep');

                            document.querySelector('#logradouro').value = options[cont].getAttribute('data-logradouro');

                            document.querySelector('#numero').value = options[cont].getAttribute('data-numero');

                            document.querySelector('#bairro').value = options[cont].getAttribute('data-bairro');

                            document.querySelector('#cidade').value = options[cont].getAttribute('data-cidade');

                            document.querySelector('#pais').value = options[cont].getAttribute('data-pais');

                            document.querySelector('#ponto-referencia').value = options[cont].getAttribute('data-referencia');

                        }

                    }

                }


                let selectCards = document.querySelector('#pagamento');

                console.log('select endereco guardada');

                selectCards.onchange = function() {

                    console.log('Função iniciada');

                    const options = selectCards.querySelectorAll('option');

                    console.log('options guardadas ' + options.length);

                    for(let cont = 0; cont < options.length; cont++){

                        console.log(options[cont].selected);

                        if(options[cont].selected === true){

                            document.querySelector('#numero-cartao').value = options[cont].getAttribute('data-numero');

                            document.querySelector('#nome-titular').value = options[cont].getAttribute('data-nome');

                            document.querySelector('#cpf-titular').value = options[cont].getAttribute('data-cpf');

                            document.querySelector('#bandeira-cartao').value = options[cont].getAttribute('data-bandeira');

                            document.querySelector('#vencimento').value = options[cont].getAttribute('data-vencimento');

                            document.querySelector('#seguranca').value = options[cont].getAttribute('data-codigo');

                        }

                    }

                }




            </script>


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