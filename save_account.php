<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$file = "database.json";

$db = json_decode(file_get_contents($file), true);

if(!$db){
    $db = ["accounts"=>[]];
}

$username = strtolower(trim($data["username"]));

// cek duplikat
foreach($db["accounts"] as $acc){

    if(strtolower(trim($acc["username"])) === $username){
        echo json_encode(["error"=>"Username sudah ada"]);
        exit;
    }
}

// tambah
$db["accounts"][] = $data;

// bersihkan duplikat
$db["accounts"] = array_unique($db["accounts"], SORT_REGULAR);

file_put_contents($file, json_encode($db, JSON_PRETTY_PRINT));

echo json_encode(["ok"=>true]);
?>
