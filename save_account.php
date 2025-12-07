<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$file = "database.json";
$db = json_decode(file_get_contents($file), true);

if(!$db){
    $db = ["accounts"=>[]];
}

// cek double
foreach($db["accounts"] as $acc){
    if($acc["username"] == $data["username"]){
        echo json_encode(["error"=>"Username sudah ada"]);
        exit;
    }
}

$db["accounts"][] = $data;

file_put_contents($file, json_encode($db, JSON_PRETTY_PRINT));

echo json_encode(["ok"=>true]);
?>
