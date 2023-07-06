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

                    </div>

                ';


                /*$sql_code = "SELECT * FROM usuario WHERE id=".$pedido->ID_Cliente;
    
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                $user = $sql_query->fetch_object();  

                print '<div class="card text-center">                                   
                            
                    <h2>Cliente:</strong> '.$user->nome.'<h2/>
                                                
                    <p><strong>E-mail:</strong> '.$user->email.'</p>

                    <p><strong>Telefone:</strong> '.$user->telefone.'</p>


                    <a class="btn btn-primary" href="new-user-admin.php?id='.$user->id.'">Ver Cliente</a>
                
                </div>';*/


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