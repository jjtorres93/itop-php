<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            if(isset($_SESSION["user_id"]))
            {
                echo $_SESSION["username"];
            }
            else
            {
                header("location: ../index.php?error=unathorizedaccess");
                exit();
            }
        ?>
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../tablesbootstrap.css">
</head>
<body>

<header>
    <nav>
        <div>
            <h3>ITOP CONSULTING</h3>
            <ul class="menu-main">
            <li><a href="../index.php">HOME</a></li>
                <li <?php if(!isset($_SESSION["user_id"])){?> class="disabled"<?php }?>><a href="user.view.php">REGISTROS</a></li>
                <li <?php if(!isset($_SESSION["user_id"])){?> class="disabled"<?php }?>><a href="#">PERFIL</a></li>
                <li><a href="#">SOBRE NOSOTROS</a></li>
            </ul>
        </div>
        <ul class="menu-member">            
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="../includes/logout.inc.php" class="header-login-a">CERRAR SESIÓN</a></li>
           
        </ul>
    </nav>
</header>

<section class="index-login">
    <div class="wrapper">
        <div class="index-login-login">
            <h4>CREAR REGISTRO</h4>            
            <form action="../includes/crud.inc.php" method="post">
                <select name="table" id="table">
                    <option value="customer">Customer</option>
                    <option value="business">Business</option>
                </select>
                <br>
                <button type="submit" name="create">CREAR</button>
            </form>
        </div>
        <div class="index-login-signup">
        <h4>REGISTROS</h4>   
        <button class="end-right" onclick="show()" id="showOrHide">Mostrar Borrados</button>                    
            <?php 
            include_once "../includes/user.inc.php";
            ?>
        </div>        
    </div>
</section>
    
</body>
</html>
<script src="../script.js"></script>