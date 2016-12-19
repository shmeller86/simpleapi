<!doctype html>
<html class="no-js" lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>NASA FEED</title>
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
                        <a href="/upd">Обновить записи</a>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Publication date</th>
                                <th class="text-center">Upload date</th>
                                <th class="text-center">Comments</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php foreach ($feedList as $feed): ?>
                                <tr>
                                    <td class="text-center"><?php echo $feed['id']; ?></td>
                                    <td><a href='/feed/<?php echo $feed['id']; ?>'><?php echo $feed['title']; ?></a></td>
                                    <td class="text-center"><a href='<?php echo $feed['link']; ?>'><?php echo $feed['pd']; ?></a></td>
                                    <td class="text-center"><?php echo $feed['ud']; ?></td>
                                    <td class="text-center"><?php echo TestWork::getCountComments($feed['id']); ?></td>
                                    <td class="text-center"><a href="/feed/edit/<?php echo $feed['id']; ?>">edit</a> / <a href="/feed/remove/<?php echo $feed['id']; ?>">remove</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </body>
</head>

