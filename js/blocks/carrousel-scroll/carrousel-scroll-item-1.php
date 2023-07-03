<!DOCTYPE html>


<html lang="pt-BR">
	
<?php

    print '
    
    <div class="container-carrousel-scroll-itens flex flex-wrap">

	
		<div class="container-posts flex full-width">
        
        
    ';
        
		//$sql_code = "SELECT * FROM produtos";


		$sql_code = "SELECT * FROM produtos ORDER BY id DESC LIMIT 20";

		$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


		while($row = $sql_query->fetch_object()){

			print '
			<a href="product.php?id='.$row->id.'" class="font-white carrousel-scroll-item">

				<div class="card">

					<img src="img/products/'.$row->arquivo.''.$row->extensao.'">

					<h3>'.$row->nome.'<h3/>       

				</div>

			</a>';



		}           
        

    print ' 

        </div>

    </div>   
        
    ';

?>
	
</html>