<!DOCTYPE html>


<html lang="pt-BR">
	
<?php

   print '
    
    
        <div class="container-posts flex justify-content-center flex-wrap">
		
        
        <h2 class="full-width text-center">Blog:</h2>
        
    ';

		if($_SESSION['papel'] == 'admin'){
			
			
			print '<div class="full-width flex justify-content-center"><a href="new-post.php" class="btn btn-primary">Adicionar Novo Post</a></div>';
			
		}

        
     

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

            print '
            <a href="post.php?id='.$row->id.'">

                <div class="card">

                    <img src="img/posts/'.$row->arquivo.''.$row->extensao.'">

                    <h3>'.$row->titulo.'</h3>
					
					
					<p class="date">Data da Publicação: '.$row->data_post.'</p>
					
					';
			
			
					if($_SESSION['papel'] == 'admin'){
						
						print '
						
						
						<div class="flex flex-wrap justify-content-space-betwen">
						
							<a href="delete-post.php?id='.$row->id.'" class="btn btn-delete">Excluir</a>
						
							<a href="new-post.php?id='.$row->id.'" class="btn btn-primary">Editar</a>
						
						
						</div>';
						
						
					}
			
			
					print'

                
                </div>
                
            </a>';
            
           
            
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
	
</html>