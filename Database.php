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
    // Category 
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
        login($email,$password,true);
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
    function getNameCategory($id){
        $conn=getConnection();
        $sql = "SELECT * FROM category WHERE id =".$id;
        $statement = $conn->query($sql);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result['m_title'];
    }

    //User
    function getUserById($id){
        $conn=getConnection();
        $sql = "SELECT * FROM user WHERE id =".$id;
        $statement = $conn->query($sql);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    function getNameUser($id){
        $conn=getConnection();
        $sql = "SELECT * FROM user WHERE id =".$id;
        $statement = $conn->query($sql);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result['m_name'];
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

    function getRoleUser($id){
        $conn=getConnection();
        $sql = "SELECT * FROM user WHERE id =".$id;
        $statement = $conn->query($sql);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result['m_role'];
    }
    function updateUser($id,$role){
        $conn=getConnection();
        $sql = "UPDATE user SET m_role=? WHERE id=?";
        $kq = $conn->prepare($sql)->execute([$role,$id]);
    }
    // Product 
    function addProduct($data){
        $conn=getConnection();
        $sql = "INSERT INTO product(m_title,m_price,m_image,m_quantity,m_description,idUser,idCategory) VALUES (?,?,?,?,?,?,?)";
        $kq = $conn->prepare($sql);
        $kq->execute($data);
    }
    function getAllProduct(){
        $conn=getConnection();
        $sql = "SELECT*FROM product";
        $statement = $conn->prepare($sql);
        $result = $statement->execute();

        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }
    function getProductByIdUser($idUser){
        $conn=getConnection();
        $sql = "SELECT*FROM product WHERE idUser =".$idUser;
        $statement = $conn->prepare($sql);
        $result = $statement->execute();

        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }
    function deleteProduct($id){
        $conn=getConnection();
        $sql = "DELETE FROM product WHERE id = $id";
        $kq = $conn->exec($sql);
    }

    function loadFormProduct($id){
        $conn=getConnection();
        $sql = "SELECT*FROM product WHERE id =".$id;
        $statement = $conn->prepare($sql);
        $result = $statement->execute();

        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }
    function updateProduct($data,$id){
        $conn=getConnection();
        $sql = "UPDATE product SET m_title=? , m_price=? , m_image = ? , m_quantity = ?, m_description = ?, idUser = ?,  idCategory = ? WHERE id=".$id;
        $kq = $conn->prepare($sql)->execute($data);
    }
    // FILE
    function uploadImage($target_dir){
        $idImage = time();
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["addProduct"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }


            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                $target_file = $target_dir . $idImage . '.' . $imageFileType;
                $nameImage = $idImage . '.' . $imageFileType;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    
                } else {
                    
                }
            }
            return $nameImage;
    }
?>