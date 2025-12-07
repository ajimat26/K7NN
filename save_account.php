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

    // prevent duplicate username + password
if (db.accounts.find(a => a.username === u && a.password === p)) {
  alert("Akun dengan username & password yang sama sudah ada.");
  return;
}
    }
}

// tambah
$db["accounts"][] = $data;

// bersihkan duplikat
$db["accounts"] = array_unique($db["accounts"], SORT_REGULAR);

file_put_contents($file, json_encode($db, JSON_PRETTY_PRINT));

echo json_encode(["ok"=>true]);
?>
