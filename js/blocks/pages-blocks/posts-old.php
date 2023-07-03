<?php

    print '
    
    
        <div class="container-posts flex justify-content-space-betwen flex-wrap">
        
        <h2 class="full-width text-center">Blog:</h2>
        
    ';
        
    $sql_code = "SELECT * FROM posts";

    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

    // $quantidade = $sql_query->num_rows;

    // if($quantidade > 0) {
        
        while($row = $sql_query->fetch_object()){

            print '<div class="card">
            <img src="img/posts/'.$row->arquivo.''.$row->extensao.'">
                <p>'.$row->titulo.'<p/>
                <a href="post.php?id='.$row->id.'" class="font-white">VER MATÉRIA</a>
            
            </div>';
            
           

        }
        
    // }

           
        

    print ' 

        </div>
        
        
    ';

?>