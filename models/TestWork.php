<?php
class TestWork{
    const URL_BY_DEFAULT = 'https://www.nasa.gov/rss/dyn/lg_image_of_the_day.rss';
    
    /**
     * 
     * @param Строка (url для парсинга)
     * @return data
     */
    public static function file_get_contents_curl($url = self::URL_BY_DEFAULT) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);

	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}

/**
 * 
 * @return array (Список всех записей)
 */
public static function getAllFeed(){
    $db = Db::getConnection();
    $feedList = array();
    $result = $db->query('SELECT id,title,link,pd,ud FROM `test-work` ORDER BY pd ASC');
    $i = 0;
    while ($row = $result->fetch()) {
        $feedList[$i]['id'] = $row['id'];
        $feedList[$i]['title'] = $row['title'];
        $feedList[$i]['link'] = $row['link'];
        $feedList[$i]['pd'] = $row['pd'];
        $feedList[$i]['ud'] = $row['ud'];
        $i++;
    }
    return $feedList;
}

/**
 * 
 * @param type int $id
 * @return array (все поля из одной записи)
 */
public static function getFeedById($id){
    $id = intval($id);
        if ($id) {
            $db = Db::getConnection();
            $result = $db->query('SELECT * FROM `test-work` WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();
        }
}
/**
 * 
 * @param type $id
 * @return array (Все комментарии к записи)
 */
public static function getCommentsById($id){
    
    $id = intval($id);
    $db = Db::getConnection();
    $commentsList = array();
    $result = $db->query("SELECT name,text,data FROM `test-comment` WHERE feed_id=$id ORDER BY data DESC");
    $i = 0;
    while ($row = $result->fetch()) {
        $commentsList[$i]['name'] = $row['name'];
        $commentsList[$i]['text'] = $row['text'];
        $commentsList[$i]['date'] = $row['data'];
        $i++;
    }
    return $commentsList;
}

/**
 * 
 * @param type $check
 * @return boolean
 */
public static function checkComment($check){
     if (strlen($check) >= 2) {
            return true;
        }
        return false;
}

/**
 * 
 * @param type $name
 * @param type $text
 * @param type $id
 */
public static function addComment($name, $text, $id){
    $db = Db::getConnection();
        
        $sql = 'INSERT INTO `test-comment` (name, text, data, feed_id) '
                . 'VALUES (:name, :text, :data, :feed_id)';
        $data = date("Y-m-d H:i");
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':data', $data, PDO::PARAM_STR);
        $result->bindParam(':feed_id', $id, PDO::PARAM_INT);
        $result->execute();
        
        header("Location: /feed/".$id);
        
    
}

/**
 * 
 * @param type $id
 */
public static function deleteFeedById($id){
    $db = Db::getConnection();
    $sql = "DELETE FROM `test-work` WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    //return $result->errorInfo();
    header("Location: /test");
}

/**
 * 
 * @param type $title
 * @param type $pubDate
 * @param type $link
 * @param type $description
 * @param type $img
 * @return boolean
 */
public static function updateFeed($title,$pubDate,$link,$description,$img){
        if (self::checkIssetFeed($link) > 0) return false;
        $pubDate = self::changeDateFormat($pubDate, "Y-m-d H:i");
        $db = Db::getConnection();
        $date = date("Y-m-d H:i");
        $sql = 'INSERT INTO `test-work` '
                . '(title, pd, ud, link, description, img) '
                . 'VALUES '
                . '(:title, :pd, :ud, :link, :description, :img)';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':pd', $pubDate, PDO::PARAM_STR);
        $result->bindParam(':ud', $date, PDO::PARAM_STR);
        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':img', $img, PDO::PARAM_STR);
        $result->execute();
        return true;
}

/**
 * 
 * @param type $link
 * @return type
 */
public static function checkIssetFeed($link){
    $db = Db::getConnection();
    $result = $db->prepare("SELECT COUNT(0) AS id FROM `test-work` WHERE link = :link");
    $result->execute(array(":link" => $link));
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return $result['id'];
}

/**
 * 
 * @param type $id
 * @return type
 */
public static function getCountComments($id){
    
    $db = Db::getConnection();
    $result = $db->prepare("SELECT COUNT(0) AS feed_id FROM `test-comment` WHERE feed_id = :id");
    $result->execute(array(":id" => $id));
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return $result['feed_id'];
}

/**
 * 
 * @param type $title
 * @param type $text
 * @param type $id
 * @return boolean
 */
public static function editFeed($title, $text, $id) {
        $db = Db::getConnection();
        $sql = "UPDATE `test-work` SET title=:title, description=:text WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        if ($result->execute()) {
            return true;
        }
        return false;
    }

        function changeDateFormat($sourceDate, $newFormat) {
    $r = date($newFormat, strtotime($sourceDate));
    return $r;
}

}