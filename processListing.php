<?php


$method = "";
if (isset($_POST['data'])) {
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
        
        case 'getListing': 
        $categoryID = $data['categoryID'];
        $result = getListing($categoryID);
        if($result!=FALSE){
            echo $result;
        }else{
            echo "Nothing Found";
        }
        break;
        case 'addListing': 
        $listingData = $data['listingData'];
        $result = addListing($categoryID);
        if($result!=FALSE){
            echo $result;
        }else{
            echo "Nothing Found";
        }
        break;
    }
}

function getCategories(){
    require './dbconnect.php';
    // var_dump($con);  
    $sql    = 'SELECT * FROM category order by category_name ';
    $result = mysql_query($sql, $con);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysql_error();
        return false;
    }
    $rows = [];
    while ($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return json_encode($rows);
    mysql_free_result($result);
}
function getListing($categoryID){
    require './dbconnect.php';
    // var_dump($con);  
    $sql    = "SELECT * FROM listing l inner join listing_address a on l.address_id=a.address_id where category_id='$categoryID' order by listing_name";
    $result = mysql_query($sql, $con);

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysql_error();
        return false;
    }
    $rows = [];
    while ($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return json_encode($rows);
    mysql_free_result($result);
}
function addListing($listingData){
    require './dbconnect.php';
    // var_dump($con);
    $listingName = $listingData['listingName'];  
    $ownerName = $listingData['ownerName'];
    $contactNo1 = $listingData['contactNo1'];
    $contactNo2= $listingData['contactNo2'];
    $email = $listingData['email'];
    $categoryID = $listingData['categoryID'];
    $plot = $listingData['plot'];
    $street = $listingData['street'];
    $area = $listingData['area'];
    $taluka = $listingData['taluka'];
    $sql    = "insert into listing_address (plot,street,area,taluka) values('$plot','$street','$area','$taluka')";
    $result = mysql_query($sql, $con);

    $sql    = "insert into listing (listing_name,owner_name,contact_no1,contact_no2,email,category_id,address_id) 
    values('$listingName','$ownerName',$contact_no1,$contact_no2,'$email',$categoryID,$addressIdD)";

    if (!$result) {
        echo "DB Error, could not query the database\n";
        echo 'MySQL Error: ' . mysql_error();
        return false;
    }
    $rows = [];
    while ($row = mysql_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return json_encode($rows);
    mysql_free_result($result);
}
?>

