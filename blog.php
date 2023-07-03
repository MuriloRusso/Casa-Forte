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

    <body>

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <?php 

                include('left-menu.php');

            ?>

            <section>

                <?php 

                    include('blocks/pages-blocks/posts.php');

                ?>

            </section>
			
			<?php 

				include('footer.php');

			?>

        </div>
        



    </body>



</html>