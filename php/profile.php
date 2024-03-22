<?php
    require 'vendor/autoload.php';

    $mongo = new MongoDB\Client;

    if($_SERVER['REQUEST_METHOD']==='GET'){
        $param = $_GET['email'];
        $filter = ['email' => $param];
        $options = [
            'projection' => ['_id' => 0],
        ];
        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $mongo->executeQuery('database.collection', $query);

        foreach ($cursor as $document) {
            echo json_encode($document) . "\n";
        }
    }

    else if($_SERVER['REQUEST_METHOD']==='PUT'){
        parse_str(file_get_contents("php://input"), $_PUT); 

        $name = $_PUT['name'];
        $email = $_PUT['email'];
        $dob = $_PUT['dob'];
        $bulk = new MongoDB\Driver\BulkWrite();
        $filter = ['email' => $email];
        $update = ['$set' => ['name' => $name, 'dob' => $dob]];
        $bulk->update($filter, $update);
        $mongo->executeBulkWrite('database.collection', $bulk);

        echo "success";
    }
?>
