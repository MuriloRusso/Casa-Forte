<!DOCTYPE html>

<html>

    <?php 

         include('connect.php');

         include('login-verification.php');

    ?>

    <head>

        <?php 

            include('head.php');

        ?>

    </head>

    <body class="pages-login">

        <?php 

            include('header.php');
        
        ?>


        <div class="full-width flex flex-wrap">

            <section>

                <form method="post" action="">

                <?php 

                  
                ?>


                    <div class="form-group">
                        <h2>Preencha o campo abaixo para recuperação da senha!</h2>
                    </div>

                    <div class="form-group">

                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" placeholder="Digite seu e-mail aqui" value="<?php echo $_POST['email'] ?>">

                    </div>

                    
                    <div class="form-submit-group flex flex-wrap justify-content-space-betwen">

                        <input class="btn-primary" type="submit" id="submit" title="Clique aqui para enviar" value="Enviar E-mail de Redefinição de Senha">

                        <p class="text-center full-width">Já Possui conta? <a class="" href="login.php" title="Já possui conta? Clique aqui">Entre Aqui</a></p>

                    </div>


                </form>

            </section>

			<?php 

				include('footer.php');

			?>



        </div>
        



    </body>



</html>