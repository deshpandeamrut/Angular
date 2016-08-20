<?php

require './dbconnect.php';
$data = file_get_contents('php://input');
//var_dump($data);
$method = "";
if (isset($data['data'])) {
    $data = $_POST['data'];
    $method = $data['method'];
    switch ($method) {
        case 'getAllCategories': 
            $result = getCategories();
            if($result!=FALSE){
                echo $result;
            }else{
                echo "Nothing Found";
            }
            break;
    }
}

function getCategories(){
    $getCategoriesSQL = "select category_id,category_name,category_image "
                    . "from categories order by category_name";
            if ($result = $mysqli->query($getCategoriesSQL)) {
                $resultSetArray = [];
                while ($row = $result->fetch_row()) {
                    $resultSetArray[] = $row;
                }
                /* free result set */
                $result->close();
                return json_encode($resultSetArray);
            }else{
                return FALSE;
            }
}
?>

