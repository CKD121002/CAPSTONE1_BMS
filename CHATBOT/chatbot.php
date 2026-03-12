<?php

$conn = new mysqli("localhost","root","","barangay_db");

$userMessage = strtolower($_POST['message']);

/* CLEAN TEXT */
$userMessage = preg_replace('/[^\w\s]/','',$userMessage);

/* SIMPLE INTENT KEYWORDS */
$intents = [
    "hours" => ["hours","time","open","schedule"],
    "clearance" => ["clearance","certificate"],
    "incident" => ["incident","report","complaint"],
    "contact" => ["contact","phone","number"]
];

$response = "";
$bestMatch = 0;

/* INTENT DETECTION */
foreach($intents as $intent=>$words){

    foreach($words as $word){

        if(strpos($userMessage,$word) !== false){

            $sql = "SELECT answer FROM faq WHERE question LIKE '%$intent%' LIMIT 1";
            $result = $conn->query($sql);

            if($row = $result->fetch_assoc()){
                $response = $row['answer'];
                break 2;
            }

        }

    }

}

/* SIMILARITY MATCHING IF NO INTENT FOUND */

if($response == ""){

    $sql = "SELECT * FROM faq";
    $result = $conn->query($sql);

    $bestMatch = 0;

    while($row = $result->fetch_assoc()){

        similar_text($userMessage, strtolower($row['question']), $percent);

        if($percent > $bestMatch){

            $bestMatch = $percent;
            $response = $row['answer'];

        }

    }

}

/* FALLBACK RESPONSE */

if($bestMatch < 40 && $response == ""){
    $response = "Sorry, I couldn't understand your question. Please contact the barangay office.";
}

echo $response;

?>