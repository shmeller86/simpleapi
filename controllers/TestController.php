<?php


class TestController {
    
    // Список
    public function actionIndex()
    {
        $feedList = TestWork::getAllFeed();
        require_once (ROOT.'/template/st/test-work/index.php');
        return TRUE;
    }
    
    // Редактор записи
    public function actionEdit($id)
    {
        $title = '';
        $text = '';
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $result = TestWork::editFeed($title, $text, $id);
            if ($result) $msg = "Успешно сохранено";
        }
        $feed = TestWork::getFeedById($id);
        require_once (ROOT.'/template/st/test-work/edit.php');
        return TRUE;
    }
    
    // Удаление записи
    public function actionRemove($id)
    {
        $result=TestWork::deleteFeedById($id);
        //print_r($result);
        return TRUE;
        
    }
    
    // Обновление ленты
    public function actionUpd()
    {
        $xml = new SimpleXMLElement(TestWork::file_get_contents_curl());
        foreach($xml->xpath('//item') as $item){
        TestWork::updateFeed($item->title,$item->pubDate,$item->link,$item->description,$item->enclosure['url']);
        }
        header("Location: /test");
        return TRUE;
    }
    
    // Обзор одной записи
    public function actionView($id)
    {
        $name = '';
        $text = '';
        if (isset($_POST['submit'])) {
            $text = $_POST['text'];
            $name = $_POST['name'];
            $errors = false;
            if (!TestWork::checkComment($name)) {
                $errors[] = 'Имя не может быть короче 2 букв';
            }
            if (!TestWork::checkComment($text)) {
                $errors[] = 'Слишком короткий комментарий';
            }
            
            if ($errors == false) {
               
               $result = TestWork::addComment(htmlspecialchars($name), htmlspecialchars($text), $id);
            }
        }
        
        $feed = TestWork::getFeedById($id);
        $commentsList = TestWork::getCommentsById($id);
        require_once (ROOT.'/template/st/test-work/view.php');
        return TRUE;
    }
      
}
