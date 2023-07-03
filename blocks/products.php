<!DOCTYPE html>


<html lang="pt-BR">
	
<?php

    print '
    
    
        <div class="container-posts flex justify-content-center flex-wrap">
        
        <h2 class="full-width text-center">Produtos:</h2>
        
    ';
        
    // $sql_code = "SELECT * FROM produtos";

    $sql_code = "SELECT * FROM produtos ORDER BY id DESC LIMIT 5";

    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

    // $quantidade = $sql_query->num_rows;

    // if($quantidade > 0) {
        
        while($row = $sql_query->fetch_object()){

            print '
            <a href="product.php?id='.$row->id.'" class="font-white">

                <div class="card">

                    <img src="img/products/'.$row->arquivo.''.$row->extensao.'" alt="imagem do produto">

                    <h3>'.$row->nome.'<h3/>

                    <p class="price">R$: '.$row->preco.'<p/>

                    <p class="parc">Em Até '.$row->NumeroParcelas.'X no cartão.<p/>
					
					<p class="desc">'.$row->descricao.'<p/>    
					 
					 
					<a href="product.php?id='.$row->id.'">Ver Mais</a>
                
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