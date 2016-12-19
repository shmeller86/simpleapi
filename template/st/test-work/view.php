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
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object img-responsive img-circle img-thumbnail" src="<?php echo $feed['img']; ?>" width="350px" alt="<?php echo $feed['title']; ?>">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $feed['title']; ?></h4>
                                <?php echo $feed['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <p>(Оригинал: <a href='<?php echo $feed['link']; ?>'><?php echo $feed['link']; ?></a>)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <?php foreach ($commentsList as $comment): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">Пользователь <strong><?php echo $comment['name']; ?></strong> написал:</div>
                                <div class="panel-body">
                                    <?php echo $comment['text']; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li style="color: orangered;"> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div class="account-create-box">
                            <h2 class="box-info">Написать комментарий</h2>
                            <form method="post" action="#">
                                <div class="input-group input-group-xs">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name='name' class="form-control" placeholder="Имя">
                                </div>
                                <br>
                                <div class="input-group input-group-xs">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name='text' class="form-control" placeholder="Комментарий">
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control btn btn-lg btn-primary" type="submit" name="submit" value="Написать" />
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


