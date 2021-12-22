<?php
class CategoryDataAccess{
    private $link;

    function __construct($link){
        $this->link = $link;
    }

    function handleError($msg){
        throw new Exception($msg);
    }

    function getCategoryList($activeOnly = true){
        $qStr = "SELECT categoryId, name, active FROM categories";

        if($activeOnly){
            $qStr .= " WHERE ACTIVE = 'yes'";
        }

        $qStr .= " ORDER BY name ASC";

        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));

        $categoryList = array();
        while($row = mysqli_fetch_assoc($result)){
            $category = array();
            $category['categoryId'] = htmlentities($row['categoryId']);
            $category['name'] = htmlentities($row['name']);
            $category['active'] = htmlentities($row['active']);
            $categoryList[] = $category;
        }
        return $categoryList;
    }

    function getCategoryById($id){
        $qStr = "SELECT categoryId, name, active FROM categories WHERE categoryId={$id}";
        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $category = array();
            $category['categoryId'] = htmlentities($row['categoryId']);
            $category['name'] = htmlentities($row['name']);
            $category['active'] = htmlentities($row['active']);
            return $category;
        }
        else{
            return false;
        }
    }

    function insertCategory($assoc){
        $assoc['name'] = mysqli_real_escape_string($this->link, $assoc['name']);
        $assoc['active'] = mysqli_real_escape_string($this->link, $assoc['active']);

        $qStr = "INSERT INTO categories (
            name,
            active
            )VALUES(
            '{$assoc['name']}',
            '{$assoc['active']}'
            )";

            $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
            if(!$result){
                $this->handleError("Unable to insert category");
                return false;
            }else{
                return $assoc;
            }
    }

    function updateCategory($assoc){
        $assoc['categoryId'] = mysqli_real_escape_string($this->link, $assoc['categoryId']);
        $assoc['name'] = mysqli_real_escape_string($this->link, $assoc['name']);
        $assoc['active'] = mysqli_real_escape_string($this->link, $assoc['active']);

        $qStr = "UPDATE categories SET
            name = '{$assoc['name']}',
            active = '{$assoc['active']}'
            WHERE categoryId = {$assoc['categoryId']}";

        $result = mysqli_query($this->link, $qStr) or $this->handleError(mysqli_error($this->link));
        if($result){
            return $assoc;
        }else{
            $this->handleError("Unable to update category");
            return false;
        }


    }
    

}