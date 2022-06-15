<?php
    function getConnection(){
        $conn = new PDO("mysql:host=localhost; dbname=shopdatabase; charset=utf8", "root", "");
        return $conn;
    }
    function getAllCategory($idRoot) {
        $conn=getConnection();
        $list = [];
        $sql = "SELECT * FROM category WHERE id_parent = ".$idRoot." ORDER BY m_index DESC";
        $statement = $conn->prepare($sql);
        $result = $statement->execute();
    
        $currentList = $statement->fetchAll(\PDO::FETCH_ASSOC);
    
        if($currentList != []){
            foreach($currentList as $currentItem){
                $currentItem['subCategory']= getAllCategory($currentItem['id']);
                array_push($list,$currentItem);
            }
        }
        return $list;
    }
    function addCategory($idParent,$title){
        $conn=getConnection();
        $sql = "INSERT INTO category(id_parent,m_title) VALUES (?,?)";
        $kq = $conn->prepare($sql);
        $kq->execute([$idParent,$title]);
    }
    function deleteCategory($id){
        $conn=getConnection();
        $sql = "DELETE FROM category WHERE id = $id";
        $kq = $conn->exec($sql);
    }
    function loadFormCategory($id){
        $conn=getConnection();
        $sql = "SELECT * FROM category WHERE id =".$id;
        $statement = $conn->query($sql);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    function updateCategory($id, $id_parent, $title, $index){
        $conn=getConnection();
        $sql = "UPDATE category SET id_parent=? , m_title=? , m_index =? WHERE id=?";
        $kq = $conn->prepare($sql)->execute([$id_parent,$title,$index,$id]);
    }
    function register($email,$password,$fullname){
        $password = md5($password);
        $conn=getConnection();
        $sql = "INSERT INTO user(m_email,m_password,m_name) VALUES (?,?,?)";
        $kq = $conn->prepare($sql);
        $kq->execute([$email,$password,$fullname]);
    }
    function login($email, $password, $isSave){
        $password = md5($password);
        $conn=getConnection();
        $sql = "SELECT * FROM user WHERE m_email ='".$email ."' AND m_password='".$password."'";
        $check = $conn->query($sql)->rowCount();

        if ($check == 1){
            $result = $conn->query($sql)->fetch(\PDO::FETCH_ASSOC);
            $_SESSION['user']= $result;
            if($isSave == true){
                setcookie('user', json_encode($result, JSON_UNESCAPED_UNICODE), time() + 3600 * 24 * 30);            
            }
        }
        return $check;
    }
    function getAllUser() {
        $conn=getConnection();
        $list = [];
        $sql = "SELECT * FROM user";
        $statement = $conn->prepare($sql);
        $result = $statement->execute();
    
        $list = $statement->fetchAll(\PDO::FETCH_ASSOC);
    
        
        return $list;
    }
?>