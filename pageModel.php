<?php

class Category
{
	
	public static function getCategoriesList()
	{
	$dataBase = Db::getConnection();
    $categoryList = [];
	$result = $dataBase->query('SELECT * FROM categories');
	$i = 0;
	while($row = $result->fetch()) {
		$categoryList[$i]['tag'] = $row['tag'];
		$categoryList[$i]['title'] = $row['title'];
		$categoryList[$i]['text'] = $row['text'];
		$i++;
    }
	return $categoryList;
	}
    public static function getCategoryItemByTag($category_tag)
    {
    //请求数据库
    $category_tag = intval($category_tag);
	    if($category_tag){
        // 数据库连接
            $dataBase = Db::getConnection();
            // 向数据库发送请求
            $sql = 'SELECT * FROM categories WHERE tag = :tag';
            // 请求就绪
            $result = $dataBase->prepare($sql);
            $result->bindParam(':tag', $category_tag, PDO::PARAM_INT); 
            // 以指定形式接受数据
            $result->setFetchMode(PDO::FETCH_ASSOC);
            // 执行
            $result->execute();
            // 返回数据 
            return $categoryItem = $result->fetch();
	    }
    }
    
    public static function getCategoriesListBy_tag_title()
    {
        // 数据库连接
        $dataBase = Db::getConnection();
        // 发送请求
        $result = $dataBase->query('SELECT tag,title FROM categories');
        // 接受并返回数据
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['tag'] = $row['tag'];
            $categoryList[$i]['title'] = $row['title'];
            $i++;
        }
        // 有多少类别
        $GLOBALS["amountCategories"] = $i; 
        return $categoryList;
    }

    public static function createCategory($title, $meta_data, $meta_key, $text)
    {
        // 数据库连接
        $dataBase = Db::getConnection();
        // 发送请求
        $sql = 'INSERT INTO categories (title, meta_data, meta_key, text)' . 'VALUES (:title, :meta_data, :meta_key, :text)';
        // 请求就绪后发送      接受并返回结果 
        $result = $dataBase->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);     //绑定
        $result->bindParam(':meta_data', $meta_data, PDO::PARAM_STR);
        $result->bindParam(':meta_key', $meta_key, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        return $result->execute();
    }
    /**
     * 编辑给定tag的类别
     */
    public static function updateCategory($tag, $title, $meta_data, $meta_key,$text)
    {
        // 数据库连接
        $dataBase = Db::getConnection();
        // 发送请求
        $sql = "UPDATE categories
            SET 
                title = :title, 
                meta_data = :meta_data, 
                meta_key = :meta_key,
                text = :text
            WHERE tag = :tag";
        // 请求就绪后发送      接受并返回结果 
        $result = $db->prepare($sql);
        $result->bindParam(':tag', $tag, PDO::PARAM_INT);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':meta_data', $meta_data, PDO::PARAM_STR);
        $result->bindParam(':meta_key', $meta_key, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        return $result->execute();
    }
    /**
     * 删除给定tag的类别
     */
    public static function deleteCategoryByTag($tag)
    {
        // 数据库连接
        $dataBase = Db::getConnection();
        // 发送请求
        $sql = 'DELETE FROM categories WHERE tag = :tag';
        // 请求就绪后发送      接受并返回结果
        $result = $dataBase->prepare($sql);
        $result->bindParam(':tag', $tag, PDO::PARAM_INT);
        return $result->execute();
    }
}


class Page
{
	
	public static function getSettings()
	{
       $dataBase = Db::getConnection();
       $settings = array();
       $result = $dataBase->query("SELECT title,meta_data,meta_key,text,tag FROM settings WHERE page='index'");
       $settings = $result->fetch();
       return $settings;
    }

    public static function getAdminSettings()
    {
        $dataBase = Db::getConnection();
        $settings = array();
        $result = $dataBase->query("SELECT title,meta_data,meta_key,text,tag FROM settings WHERE page='index'");
        $i = 0;
        while($row = $result->fetch()) {
            $settings[$i]['tag'] = $row['tag'];
            $settings[$i]['title'] = $row['title'];
            $settings[$i]['meta_data'] = $row['meta_data'];
            $settings[$i]['meta_key'] = $row['meta_key'];
            $settings[$i]['text'] = $row['text'];
            $i++;
        } 
    return $settings;
    }
    public static function getPageBytag($tag)
    {
        // 数据库连接
        $dataBase = Db::getConnection();
        // 发送请求
        $sql = 'SELECT * FROM settings WHERE tag = :tag';
        // 请求就绪
        $result = $dataBase->prepare($sql);
        $result->bindParam(':tag', $tag, PDO::PARAM_INT);
        // 以指定形式接受数据
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // 执行
        $result->execute();
        // 接受并返回结果
        return $result->fetch();
    }

    public static function updatePage($tag, $options)
    {
        $db = Db::getConnection();
        $sql = "UPDATE settings
        SET 
        title = :title, 
        meta_data = :meta_data, 
        meta_key = :meta_key,
        text = :text
        WHERE tag = :tag";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':meta_data', $options['meta_data'], PDO::PARAM_STR);
        $result->bindParam(':meta_key', $options['meta_key'], PDO::PARAM_STR);
        $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
        return $result->execute();
    }
}