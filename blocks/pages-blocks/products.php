<!DOCTYPE html>


<html lang="pt-BR">

<?php

    print '
    
    
        <div class="container-posts flex justify-content-center flex-wrap">

			<div class="flex justify-content-space-around flex-wrap full-width align-items-center">
        
       			<h2 class="text-center">Produtos:</h2>
        
    ';
        
		if($_SESSION['papel'] == 'admin'){
			
			
			print '<div class="flex justify-content-center">
			<a href="new-product.php" class="btn btn-primary" title="Clique nesse botão para adicionar um novo produto">Novo</a></div>';
			
		}

		print '</div>';
     

    // $sql_query;

	$sql_code = "SELECT * FROM produtos";

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

	$quantidadeProdutos = $sql_query->num_rows;

	if(!isset($_GET['page'])){

		$sql_code = "SELECT * FROM produtos ORDER BY id DESC LIMIT 0, 10";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

    }

	else{

		$page = intval($_GET['page']) - 1;

		$sql_code = "SELECT * FROM produtos ORDER BY id DESC LIMIT ".$page."0, 10";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


	}
        
	while($row = $sql_query->fetch_object()){

		print '
		<a href="product.php?id='.$row->id.'" >

			<div class="card">

				<img src="img/products/'.$row->arquivo.''.$row->extensao.'" alt="imagem do produto">

				<p class="parc">Em Até '.$row->NumeroParcelas.'X no cartão.<p/>


				<h3>'.$row->nome.'</h3>

				<p class="price">R$: '.$row->preco.'<p/>

					
				<p class="desc">'.$row->descricao.'<p/>    
				
				<a href="product.php?id='.$row->id.'">Ver Mais</a>
					 
				';

				if($_SESSION['papel'] == 'admin'){

					print '


					<div class="flex flex-wrap justify-content-space-betwen actions">

						<a href="delete-product.php?id='.$row->id.'" class="btn btn-delete" title="Clique nesse botão para excluir o produto">Excluir</a>

						<a href="new-product.php?id='.$row->id.'" class="btn btn-primary" title="Clique nesse botão para editar o produto">Editar</a>


					</div>';


				}


				print'


			</div>

		</a>';



	}

	if($quantidadeProdutos > 10){

		$numPages = (intval($quantidadeProdutos / 10)) + 1;
		
	//	$numPages = ceil((intval($quantidadeProdutos / 10)));
		
		if(intval($quantidadeProdutos) / 10 === 0){
			
			$numPages = $numPages - 1;
			
		}
		

		print '

		<div class="pagination full-width flex justify-content-center">';


		for($a = 1; $a < $numPages+1; $a++){


			
			if($a == $_GET['page'] || (!isset($_GET['page']) && $a == 1)){
				
				print '<a href="products.php?page='.$a.'" class="btn-pagination-active">'.$a.'</a>';
				
			}
			
			else{
				
				print '<a href="products.php?page='.$a.'">'.$a.'</a>';
				
				
			}
			

		}


	print '</div>';


	}


    

    print ' 

        </div>
        
        
    ';

?>
	
</html>