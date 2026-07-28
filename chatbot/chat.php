<?php

header("Content-Type: application/json");

require_once "config.php";

// Get user message
$message = trim($_POST['message'] ?? '');

if ($message == '') {

    echo json_encode([
        "reply" => "Please type a message."
    ]);

    exit;
}

// ==============================
// Company Prompt
// ==============================

$prompt = "

You are PROEN AI Assistant.

You work for PROEN Consulting Services Pvt. Ltd.

About Company:

Services:

- Artificial Intelligence
- Data Engineering
- Data Analytics
- Contract Lifecycle Management
- Managed Contract Services
- Technology Development
- ISO Consulting

Rules:

1. Answer professionally.

2. Keep answers under 120 words.

3. Never invent company information.

4. If asked something unrelated to PROEN,
answer normally.

5. Be friendly.

User Question:

$message

";

// ==============================
// Gemini Request
// ==============================

$data = [

    "contents" => [

        [

            "parts" => [

                [

                    "text" => $prompt

                ]

            ]

        ]

    ]

];

$json = json_encode($data);

// ==============================
// CURL
// ==============================

$ch = curl_init(GEMINI_URL);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [

    "Content-Type: application/json"

]);

curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

$response = curl_exec($ch);

if (curl_errno($ch)) {

    echo json_encode([
        "reply" => "Unable to connect to Gemini API."
    ]);

    curl_close($ch);

    exit;

}

curl_close($ch);

// ==============================
// Decode Response
// ==============================

$result = json_decode($response, true);

$reply = "Sorry, I couldn't understand that.";

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {

    $reply = $result['candidates'][0]['content']['parts'][0]['text'];

}

// Return JSON
echo json_encode([
    "reply" => nl2br(htmlspecialchars($reply))
]);