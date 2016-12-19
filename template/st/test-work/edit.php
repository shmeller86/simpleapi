<!doctype html>
<html class="no-js" lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $feed['title']; ?></title>
        <meta name="description" content="Nasa feed">
        <meta name="keywords" content="nasa, feed">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Google Fonts
        ============================================ -->		
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
        <!-- Bootstrap CSS
        ============================================ -->		
        <link rel="stylesheet" href="/template/css/bootstrap.min.css">
        <!-- Font awesome CSS
        ============================================ -->
        <link rel="stylesheet" href="/template/css/font-awesome.min.css">
        <!-- main CSS
        ============================================ -->
        <link rel="stylesheet" href="/template/css/main.css">
        <!-- style CSS
        ============================================ -->
        <link rel="stylesheet" href="/template/css/style.css">
        <!-- responsive CSS
        ============================================ -->
        <link rel="stylesheet" href="/template/css/responsive.css">
    <body>
        <section class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="page-menu">
                            <li><a href="/test">Главная</a></li>
                            <li class="active"><?php echo $feed['title']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="account-create-box">
                            <h2 class="box-info">Редактировать запись № <?php echo $feed['id']; ?></h2>
                            <form method="post" action="#">
                                <div class="input-group input-group-xs">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name='title' class="form-control" value="<?php echo $feed['title']; ?>">
                                </div>
                                <br>
                                <div class="input-group input-group-xs">
                                    <span class="input-group-addon"></span>
                                    <textarea name="text" class="form-control"><?php echo $feed['description']; ?></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-xs-12 text-center">
                                        <?php if (isset($msg)) echo '<span style=color:green;>' . $msg . '</span>'; ?>
                                        <input class="form-control btn btn-lg btn-primary" type="submit" name="submit" value="Сохранить" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>


