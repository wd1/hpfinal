<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'deadbeef88');
define('DB_NAME', 'custom');


if (isset($_GET['term'])){
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".DB_SERVER.";port=8889;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('SELECT id,name FROM countries WHERE name LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        
        while($row = $stmt->fetch()) {
            $return_arr[] =  ['id' => $row['id'], 'value' => $row['name'] ];
        }

        $stmt = $conn->prepare('SELECT rid,region FROM regions WHERE region LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        
        while($row = $stmt->fetch()) {
            $return_arr[] =  ['id' => "r".$row['rid'], 'value' => html_entity_decode($row['region']) ];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}

?>