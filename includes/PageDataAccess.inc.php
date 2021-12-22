<?php

class PageDataAccess{
    private $link;

    function __construct($link){
        $this->link = $link;
    }
    
    function handleError($msg){
        throw new Exception($msg);
    }

    function getPageList($activeOnly = true){
        $qStr = "SELECT pageId, path, title, DATE_FORMAT(publishedDate, '%m/%e/%Y') as publishedDate, content, defaultImg, active FROM pages";

        if($activeOnly){
            $qStr .= " WHERE active = 'yes'";
        }

        $qStr .= " ORDER BY publishedDate DESC";

        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

        $pageList = array();

        while($row = mysqli_fetch_assoc($result)){
            $page = array();
            $page['pageId'] = htmlentities($row['pageId']);
            $page['path'] = htmlentities($row['path']);
            $page['title'] = htmlentities($row['title']);
            $page['publishedDate'] = htmlentities($row['publishedDate']);
            $page['content'] = strip_tags($row['content']);
            $page['defaultImg'] = htmlentities($row['defaultImg']);
            $page['active'] = htmlentities($row['active']);
            $pageList[] = $page;
        }
        return $pageList;
    }

    function getPageById($id){

        // prevent SQL injection attack by 'scrubbing' the $id
        $id = mysqli_real_escape_string($this->link, $id);
    
        $qStr = "SELECT 
                    pageId, 
                    path, 
                    title,
                    description,
                    content,
                    categories.categoryId, 
                    categories.name as categoryName,
                    DATE_FORMAT(publishedDate,'%m/%e/%Y') as publishedDate, 
                    pages.active 
                FROM pages
                INNER JOIN categories on pages.categoryId = categories.categoryId
                WHERE pageId = {$id}";
    
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
    
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $page = array();
            $page['pageId'] = htmlentities($row['pageId']);
            $page['path'] = htmlentities($row['path']);
            $page['title'] = htmlentities($row['title']);
            $page['description'] = htmlentities($row['description']);
            $page['content'] = sanitizeHtml($row['content']); // Note that we are not using htmlentities() here!!!
            $page['categoryId'] = htmlentities($row['categoryId']);
            $page['categoryName'] = htmlentities($row['categoryName']);
            $page['publishedDate'] = htmlentities($row['publishedDate']);
            $page['active'] = htmlentities($row['active']);
            return $page;
        }else{
            return false;
        }
    }

    function insertPage($page){
        $page['path'] = mysqli_real_escape_string($this->link, $page['path']);
        $page['title'] = mysqli_real_escape_string($this->link, $page['title']);
        $page['description'] = mysqli_real_escape_string($this->link, $page['description']);
        $page['content'] = mysqli_real_escape_string($this->link, $page['content']);
        $page['categoryId'] = mysqli_real_escape_string($this->link, $page['categoryId']);
        $page['publishedDate'] = mysqli_real_escape_string($this->link, $page['publishedDate']);
        $page['defaultImg'] = mysqli_real_escape_string($this->link, $page['defaultImg']);
        $page['active'] = mysqli_real_escape_string($this->link, $page['active']);

        $qStr = "INSERT INTO pages (
            path,
            title,
            description,
            content,
            categoryid,
            publishedDate,
            defaultImg,
            active
            )VALUES(
                '{$page['path']}',
                '{$page['title']}',
                '{$page['description']}',
                '{$page['content']}',
                '{$page['categoryId']}',
                '{$page['publishedDate']}',
                '{$page['defaultImg']}',
                '{$page['active']}'
            )";
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

        if($result){
            $page['pageId'] = mysqli_insert_id($this->link);
            return $page;
        }
        else{
            $this->handleError("unable to insert page");
        }
        return false;
    }

    function updatePage($page){
        
        $page['pageId'] = mysqli_real_escape_string($this->link, $page['pageId']);
        $page['path'] = mysqli_real_escape_string($this->link, $page['path']);
        $page['title'] = mysqli_real_escape_string($this->link, $page['title']);
        $page['description'] = mysqli_real_escape_string($this->link, $page['description']);
        $page['content'] = mysqli_real_escape_string($this->link, $page['content']);
        $page['categoryId'] = mysqli_real_escape_string($this->link, $page['categoryId']);
        $page['publishedDate'] = mysqli_real_escape_string($this->link, $page['publishedDate']);
        $page['defaultImg'] = mysqli_real_escape_string($this->link, $page['defaultImg']);
        $page['active'] = mysqli_real_escape_string($this->link, $page['active']);

        $qStr = "UPDATE pages SET
            path = '{$page['path']}',
            title = '{$page['title']}',
            description = '{$page['description']}',
            content = '{$page['content']}',
            categoryId = '{$page['categoryId']}',
            publishedDate = '{$page['publishedDate']}',
            defaultImg = '{$page['defaultImg']}',
            active = '{$page['active']}'
            WHERE pageId = {$page['pageId']}";
            
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
        if($result){
            return $page;
        }
        else{
            $this->handleError("Unable to update page");
        }
        return false;
    }
    function getPaginatedList($offset, $limit, $activeOnly = true){
        $qStr = "SELECT pageId, path, title, DATE_FORMAT(publishedDate, '%m/%e/%Y') as publishedDate, content, defaultImg, active FROM pages";

        if($activeOnly){
            $qStr .= " WHERE active = 'yes'";
        }
        $qStr .= " ORDER BY publishedDate DESC";
        $qStr .= " LIMIT {$offset}, {$limit}";

        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

        $pageList = array();

        while($row = mysqli_fetch_assoc($result)){
            $page = array();
            $page['pageId'] = htmlentities($row['pageId']);
            $page['path'] = htmlentities($row['path']);
            $page['title'] = htmlentities($row['title']);
            $page['publishedDate'] = htmlentities($row['publishedDate']);
            $page['content'] = strip_tags($row['content']);
            $page['defaultImg'] = htmlentities($row['defaultImg']);
            $page['active'] = htmlentities($row['active']);
            $pageList[] = $page;
        }
        return $pageList;
    }

    function search_bar_pages($str = "", $activeOnly = true, $paginate = false, $offset = null, $limit = null){
        $qStr = "SELECT pageId, path, title, DATE_FORMAT(publishedDate, '%m/%e/%Y') as publishedDate, content, defaultImg, active FROM pages";
        $str = mysqli_real_escape_string($this->link, $str);

        if($activeOnly){
            $qStr .= " WHERE active = 'yes' && MATCH (content,title) AGAINST ('*{$str} IN BOOLEAN MODE')";
        }
        $qStr .= " ORDER BY publishedDate DESC";

        if($paginate == true){
            $qStr .= " LIMIT {$offset}, {$limit}";
        }
        

        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

        $pageList = array();

        while($row = mysqli_fetch_assoc($result)){
            $page = array();
            $page['pageId'] = htmlentities($row['pageId']);
            $page['path'] = htmlentities($row['path']);
            $page['title'] = htmlentities($row['title']);
            $page['publishedDate'] = htmlentities($row['publishedDate']);
            $page['content'] = strip_tags($row['content']);
            $page['defaultImg'] = htmlentities($row['defaultImg']);
            $page['active'] = htmlentities($row['active']);
            $pageList[] = $page;
        }
        return $pageList;
    }
}