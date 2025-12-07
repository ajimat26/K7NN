<?php
header("Content-Type: application/json");

$file = "database.json";

$db = json_decode(file_get_contents($file), true);

$now = time();

$new = [];

foreach($db["accounts"] as $a){

    if($a["expired"] == "NEVER"){
        $new[] = $a;
        continue;
    }

    $exp = strtotime($a["expired"]);

    // jika belum expired
    if($now < $exp){
        $new[] = $a;
    }
}

$db["accounts"] = $new;

file_put_contents($file, json_encode($db, JSON_PRETTY_PRINT));

echo json_encode(["ok"=>true]);
?>
