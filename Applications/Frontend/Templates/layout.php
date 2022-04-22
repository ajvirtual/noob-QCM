<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if(isset($title)) {
            echo $title;
        } else {
            echo "MEGA QCM GAME";
        }?>
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">    
    <?php
        $css = isset($css) ? $css : '';
        echo '<link rel="stylesheet" href="css/'.$css.'">';
    ?>
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand text-decoration-none" href="/"><h1 id="logo-text">MQG</h1></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <?php if($user->isAuthenticated()) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/">admin<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/news-insert.php">ajouter une news<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a href="/admin/deconnect.php" class="nav-link">deconnect</a>
                    </li>
                    <?php } ?>   
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a href="/admin/" class="dropdown-item">admin</a>
                            <a href="/admin/news-insert.html" class="dropdown-item">ajouter une news</a>
                        </div>
                    </li> -->
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>
    <section class="container m-5">
        <div id="content-wrap">
            <div id="main">
                <?php if($user->hasFlash()) echo '<p class="text-center">', $user->getFlash(), '</p>';?>
                <?php echo $content; ?>
            </div>
        </div>
    </section>
    <footer id="footer">
    </footer>

    <script src="js/Jquery.3.4.1.min.js"></script>
    <script src="js/pooper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php 
        $js = isset($js) ? $js : '';
        echo "<script src='js/$js'></script>";
    ?>
</body>
</html>