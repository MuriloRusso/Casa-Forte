<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('protect-adm.php');



    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="" class=''>

    
        <?php 

            include('header.php');

        ?>

        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>


            <section>


                <?php

                    // include('../connect.php');

                    $id_categoria = $_POST['id_categoria'];

                    // $sql_code = "SELECT * FROM categorizar WHERE ID_categoria=".$id_categoria;

                    $sql_code = "SELECT * FROM produtos";

                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                    $quantidadeProdutos = $sql_query->num_rows;


                    
                   



                    while($produto = $sql_query->fetch_object()){

                        $sql_code = "SELECT * FROM categorizar WHERE ID_categoria=".$id_categoria." AND ID_produto=".$produto->id;

                        $sql_query2 = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

                        $quantidade = $sql_query2->num_rows;

                        $categorizacao = $sql_query2->fetch_object();

                        print $quantidade;


                        if($quantidade === 1){

                            print '
                            <a href="product.php?id='.$produto->id.'" >
    
                                <div class="card">
    
                                    <img src="img/products/'.$produto->arquivo.''.$produto->extensao.'" alt="imagem do produto">
    
                                    <h3>'.$produto->nome.'</h3>
    
                                    <p class="price">R$: '.$produto->preco.'</p>

                                    <form action="config/remove-category.php" method="post">

                                         <input type="hidden" name="id_categorizacao" value="'.$categorizacao->ID.'">

                                         <input type="hidden" name="id_categoria" value="'.$id_categoria.'">

                                        <input type="hidden" name="id_produto" value="'.$produto->id.'">

                                        <input type="submit" value="Remover" class="btn btn-delete">
                                        
                                    </form>
                                    
                                
                                        
                                
                                </div>
    
                            </a>';


                        }

                    }


                ?>


            </section>


            <?php 

                include('footer.php');

            ?>


        </div>

    </body>

</html>
