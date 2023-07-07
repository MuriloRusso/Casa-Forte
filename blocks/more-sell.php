<!DOCTYPE html>


<html lang="pt-BR">
	
<?php

    print '
    
    
        <div class="container-posts flex justify-content-center flex-wrap">
        
        <h2 class="full-width text-center">Mais Vendidos:</h2>
        
    ';
        
    // $sql_code = "SELECT * FROM produtos";

    // $sql_code = "SELECT * FROM produtos ORDER BY id DESC LIMIT 5";

    $sql_code = "SELECT ID_Produtos, COUNT(*) AS total_compras
					FROM pedido
					GROUP BY ID_Produtos
					ORDER BY total_compras DESC
					LIMIT 5;
					";

  /*  $sql_code = "SELECT ID_Produtos, COUNT(*) AS quantidade_pedidos
                    FROM pedido
                    GROUP BY ID_Produtos
                    ORDER BY quantidade_pedidos DESC
                    LIMIT 5;       
    ";
*/
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

    // $quantidade = $sql_query->num_rows;

    // if($quantidade > 0) {
        
        while($row = $sql_query->fetch_object()){

            $sql_code2 = "SELECT * from produtos WHERE id=".$row->ID_Produtos;
		
            $sql_query2 = $mysqli->query($sql_code2) or die("Falha na execução do código SQL" . $mysqli->error);

            $produto = $sql_query2->fetch_object();


            print '
            <a href="product.php?id='.$produto->id.'" class="font-white">

                <div class="card">

                    <img src="img/products/'.$produto->arquivo.''.$produto->extensao.'" alt="imagem do produto">

                    <h3>'.$produto->nome.'<h3/>

                    <p class="price">R$: '.$produto->preco.'<p/>

                    <p class="parc">Em Até '.$produto->NumeroParcelas.'X no cartão.<p/>
					
					<p class="desc">'.$produto->descricao.'<p/>    
					 
					 
					<a href="product.php?id='.$produto->id.'">Ver Mais</a>
                
                </div>
                
            </a>';
            
           

        }
        
    // }

           
        

    print ' 

            <div class="full-width flex justify-content-center align-items-center padding-y-50px">
                <a href="products.php" class="btn btn-primary" title="Clique nesse botão para ver todos os produtos">Ver Tudo</a>
            </div>


        </div>
        
        
    ';

?>
	
	
</html>