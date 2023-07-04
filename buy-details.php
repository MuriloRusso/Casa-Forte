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

                    <p><strong>Status:</strong> '.$pedido->Status.'</p>

                    <p class="date"><strong>Data da Entrega:</strong>  <span>'.$pedido->DataEntrega.'</span></p>

                    
                    
                
                </div>';


                
                $sql_code = "SELECT * FROM produtos WHERE id=".$pedido->ID_Produtos;
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                $produto = $sql_query->fetch_object();  

                print '<div class="card text-center">                                   
                            
                    <h2>Produto: '.$produto->nome.'<h2/>
                                                
                    <p><strong>Descrição:</strong> '.$produto->descricao.'</p>

                    <a class="btn btn-primary" href="product.php?id='.$produto->id.'">Ver Produto</a>
                
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

    </body>



</html>