<?php

if(($_POST["registrationId"]))
$registrationId = $_POST["registrationId"];
print($registrationId);
$auth_code = $_POST["auth_code"];
sendMessageToPhone($auth_code, $registrationId, "0", "This is a test message from the Google C2DM servers");

function sendMessageToPhone($authCode, $deviceRegistrationId, $msgType, $messageText) {

        $headers = array('Authorization: GoogleLogin auth=' . $authCode);
        $data = array(
            'registration_id' => $deviceRegistrationId,
            'collapse_key' => $msgType,
            'data.payload' => $messageText //TODO Add more params with just simple data instead           
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://android.apis.google.com/c2dm/send");
        if ($headers)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }


?>
