<!DOCTYPE html>


<html lang="pt-BR">
	
<?php

	print '
		
		
	<div class="container-posts flex justify-content-center flex-wrap">

		<div class="flex justify-content-space-around flex-wrap full-width align-items-center">

			<h2 class="text-center">Blog:</h2>

	';

	if($_SESSION['papel'] == 'admin'){
		
		
		print '<div class="flex justify-content-center">
		<a href="new-post.php" class="btn btn-primary" title="Clique nesse botão para adicionar um novo produto">Novo</a></div>';
		
	}

	print '</div>';
        
     

    // $sql_query;

    $sql_code = "SELECT * FROM posts";

    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
   
    $quantidadeProdutos = $sql_query->num_rows;

    if(!isset($_GET['page'])){

		$sql_code = "SELECT * FROM posts ORDER BY id DESC LIMIT 0, 10";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

    }

	else{

		$page = intval($_GET['page']) - 1;

		$sql_code = "SELECT * FROM posts ORDER BY id DESC LIMIT ".$page."0, 10";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


	}

        
        while($row = $sql_query->fetch_object()){

			//$dat = explode($row->data_post, '-' , 999);

            print '

            
                <div class="post flex flex-wrap">

                    <img src="img/posts/'.$row->arquivo.''.$row->extensao.'" alt="imagem do post" class="col-50">

						<div class="col-50">

							<h3>'.$row->titulo.'</h3>

							<p class="">'.$row->texto.'</p>

							
							<p class="date">Data da Publicação: <span>'.$row->data_post.'</span></p>


							<a href="post.php?id='.$row->id.'" class="btn btn-primary">Continuar Lendo</a>

							
							
						</div>

						';

						if($_SESSION['papel'] == 'admin'){
								
							print '								
								
								<div class="flex flex-wrap justify-content-space-betwen actions full-width">
								
									<a href="delete-post.php?id='.$row->id.'" class="btn btn-delete" title="Clique nesse botão para excluir o post">Excluir</a>
								
									<a href="new-post.php?id='.$row->id.'" class="btn btn-primary" title="Clique nesse botão para editar o post">Editar</a>
								
								
								</div>
							
							';
							
							
						}

					print '	
					

                </div>
                
			
			
			';
            
           
            
        }

	if($quantidadeProdutos > 10){

			$numPages = (intval($quantidadeProdutos / 10)) + 1;
		
//		$numPages = ceil((intval($quantidadeProdutos / 10)));

		print '

		<div class="pagination full-width flex justify-content-center">';


		for($a = 1; $a < $numPages+1; $a++){

	//		print '<a href="blog.php?page='.$a.'">'.$a.'</a>';

			if($a == $_GET['page'] || (!isset($_GET['page']) && $a == 1)){

				print '<a href="blog.php?page='.$a.'" class="btn-pagination-active">'.$a.'</a>';

			}

			else{

				print '<a href="blog.php?page='.$a.'">'.$a.'</a>';


			}


		}


		print '</div>';
			

	}


    

    print ' 

        </div>
        
        
    ';

?>

<script src="js/mascara-data.js"></script>
	
</html>