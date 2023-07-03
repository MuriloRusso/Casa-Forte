<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body id="page-post">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');
                

            ?>


            <section>

            <?php 

            $sql_code = "SELECT * FROM posts";

            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                
                while($row = $sql_query->fetch_object()){

                    if($row->id == $_GET['id']){

                        print '<div class="card text-center">
						
						

                           <img src="img/posts/'.$row->arquivo.''.$row->extensao.'">
						   
                            <h2>'.$row->titulo.'<h2/>
							
                            <p style="color: gray !important">'.$row->texto.'<p/>
							
							<p class="date">Data da Publicação: <span>'.$row->data_post.'</span></p>
							
							';
						
							if($_SESSION['papel'] == 'admin'){
						
							print '


							<div class="flex flex-wrap justify-content-space-betwen actions">

								<a href="delete-post.php?id='.$row->id.'" class="btn btn-delete">Excluir</a>

								<a href="new-post.php?id='.$row->id.'" class="btn btn-primary">Editar</a>


							</div>';


						}
											
						
						
						print '

                        
                        </div>';

                    }

                }                            

            ?>      

            </section>
			
			<?php 

				include('footer.php');

			?>


        </div>    



    </body>

    <script src="js/mascara-data.js"></script>



</html>