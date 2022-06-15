<?php
if (isset($_SESSION['user'])){
    var_dump($_SESSION['user']);
    echo "Xin chào ".$_SESSION['user']['m_name'];
}