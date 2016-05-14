<?php 

//$auth_code = "DQAAAL0AAAB51YAoFUuCUIqpyAg1ELVumMh108cjZzD9-fdLGU2N1-4rnby86X_L5fffvVH2-jXzxyDoJfB5z7xd_d4zRsCY3mXCVrvLqpr9dY0wPam9O2okBi_cbUu9wrgaf1LlTwqjPFt2xH_ojHvVqn0wElERgYlOKnaWwa0X5Oa1g3H5nhlseoD9EtOt3u1RGLDbYo3inVIlj6sWD32CCe4FUfciBAtPCZdb2losUPSl3YYbieq-X6MgTjRMNSRW-yA29FY";
//$registrationId = "APA91bELfPQhZAYm1lBmVonU4FM3Sr-UjURhYA8HNsQSBg9G_yKWPixFdH-ADMkZMRxEVLMF3hQeya20Zx5x22oT4a-066xhjgJ4-NJK4QiUsydv934qBPL7-aS8ysGY99GrnNbt9wVu";

$auth_code = $_POST["auth_code"];
$registrationId = $_POST["registrationId"];

sendMessageToPhone($auth_code, $registrationId, "0", "This is the second message ");

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

