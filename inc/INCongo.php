<?php    
    // Create a Mongo conenction
    //$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    //$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");    
    //$mongo = new MongoClient("mongodb://batefi:deadbeef88@10.223.176.228");
	$mongo = new MongoClient("mongodb://10.223.176.228");
	//$mongo = new MongoClient("mongodb://localhost");
    $db = $mongo->catohp_production;
?>