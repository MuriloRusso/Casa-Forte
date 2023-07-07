<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect-colaborador.php');

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


           
            if(isset($_GET['id'])){

                $idPedido = $_GET['id'];

                $sql_code = "SELECT * FROM pedido WHERE ID=".$idPedido;

                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
               
                $pedido = $sql_query->fetch_object();     

                print '<div class="card text-center"> ';
                

                if(isset($_POST['idPedido'])){

                    $idPedido = $mysqli->real_escape_string($_POST['idPedido']);
    
                    $status = $mysqli->real_escape_string($_POST['status']);
    
                    $entrega = $mysqli->real_escape_string($_POST['dataEntrega']);
    
                    $sql_code = "SELECT * FROM pedido WHERE id=".$idPedido;
    
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    
                    $pedido = $sql_query->fetch_object();
    
                    $sql_code = "UPDATE pedido SET Status='{$status}', DataEntrega='{$entrega}' WHERE id=".$idPedido;
    
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    
                    print '<p class="alert-sucess text-center">Dados do Pedido Alterados com sucesso!</p>';
    
                }

                print'
                    
                    <h2>Pedido: #'.$pedido->ID.'<h2/>
                                                

                    <p class="date"><strong>Data da Compra:</strong> <span>'.$pedido->DataCompra.'</span></p>

                    <p><strong>Quantidade:</strong> '.$pedido->Quantidade.'</p>

                    <p><strong>Dados da Entrega:</strong> '.$pedido->EnderecoEntrega.'</p>

                    <p class="date"><strong>Data da Previsão da Entrega:</strong> <span>'.$pedido->DataPrevisaoEntrega.'</span></p>

                    <p><strong>Status:</strong> <span id="statusValue">'.$pedido->Status.'</span></p>

                    <p class="date"><strong>Data da Entrega:</strong> <span>'.$pedido->DataEntrega.'</span></p>

                    <form action="" method="post">


                    <input type="hidden" name="idPedido" value="'.$pedido->ID.'">
                    
                        <div class="form-group">
                        
                            <label for="status"></label>

                            <select name="status">
                                <option value="Em transito">Em transito</option>
                                <option value="Entregue">Entregue</option>
                            </select>
                        
                        </div>
                    
                        <div class="form-group" id="container-data-entrega">
                        
                            <label for="Data da Entrega"></label>

                            <input type="date" name="dataEntrega" placeholder="99/99/9999">
                        
                        </div>


                        <input type="submit" value="Atualizar" class="btn btn-primary">


                    </form>
                    
                
                </div>';


                
                $sql_code = "SELECT * FROM produtos WHERE id=".$pedido->ID_Produtos;
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                $produto = $sql_query->fetch_object();  

                print '<div class="card text-center">                                   
                            
                    <h2>Produto: '.$produto->nome.'<h2/>
                                                
                    <p><strong>Descrição:</strong> '.$produto->descricao.'</p>

                    <a class="btn btn-primary" href="product.php?id='.$produto->id.'">Ver Produto</a>
                
                </div>';


                $sql_code = "SELECT * FROM usuario WHERE id=".$pedido->ID_Cliente;
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                $user = $sql_query->fetch_object();  

                print '<div class="card text-center">                                   
                            
                    <h2>Cliente:</strong> '.$user->nome.'<h2/>
                                                
                    <p><strong>E-mail:</strong> '.$user->email.'</p>

                    <p><strong>Telefone:</strong> '.$user->telefone.'</p>


                    <a class="btn btn-primary" href="new-user-admin.php?id='.$user->id.'">Ver Cliente</a>
                
                </div>';


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


    </body>



</html>