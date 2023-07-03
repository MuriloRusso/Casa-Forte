<?php

    print '
    
    <div class="flex full-width flex-wrap">


    <div class="container-posts flex justify-content-center flex-wrap full-width">
        
        
    ';
        
    //$sql_code = "SELECT * FROM produtos";


    $sql_code = "SELECT * FROM produtos ORDER BY id DESC LIMIT 6";

    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


	while($row = $sql_query->fetch_object()){

		print '
		<a href="product.php?id='.$row->id.'" class="font-white">

			<div class="card">

				<img src="img/products/'.$row->arquivo.''.$row->extensao.'" alt="imagem do produto">

				<h3>'.$row->nome.'<h3/>       

			</div>

		</a>';



	}           
        

    print ' 

        </div>

    </div>   
        
    ';

?>