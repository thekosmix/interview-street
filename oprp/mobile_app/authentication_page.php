<?php /*echo $_POST["username"];
print("\n");
//username and password can be collected here...we need to verify and send the unique id for thew user....
echo $_POST["password"];*/

session_start();
if(($_POST["username"]))
{
	print(20);
	printf("\n");
	$auth_code = googleAuthenticate("<enteridhere>@gmail.com","");
//	$auth_code = "DQAAAL0AAAB51YAoFUuCUIqpyAg1ELVumMh108cjZzD9-fdLGU2N1-4rnby86X_L5fffvVH2-jXzxyDoJfB5z7xd_d4zRsCY3mXCVrvLqpr9dY0wPam9O2okBi_cbUu9wrgaf1LlTwqjPFt2xH_ojHvVqn0wElERgYlOKnaWwa0X5Oa1g3H5nhlseoD9EtOt3u1RGLDbYo3inVIlj6sWD32CCe4FUfciBAtPCZdb2losUPSl3YYbieq-X6MgTjRMNSRW-yA29FY";
//	print("13");
	print($auth_code);

}
else
	print(-1);
/*
$reply = googleAuthenticate("@gmail.com","");
print($reply);
*/
function googleAuthenticate($username, $password, $source="Company-AppName-Version", $service="ac2dm") {    

    session_start();
    if( isset($_SESSION['google_auth_id']) && $_SESSION['google_auth_id'] != null)
        return $_SESSION['google_auth_id'];

    // get an authorization token
    $ch = curl_init();
    if(!$ch){
        return false;
    }

    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/ClientLogin");
    $post_fields = "accountType=" . urlencode('HOSTED_OR_GOOGLE')
        . "&Email=" . urlencode($username)
        . "&Passwd=" . urlencode($password)
        . "&source=" . urlencode($source)
        . "&service=" . urlencode($service);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);    
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // for debugging the request
    //curl_setopt($ch, CURLINFO_HEADER_OUT, true); // for debugging the request

    $response = curl_exec($ch);

    //var_dump(curl_getinfo($ch)); //for debugging the request
    //var_dump($response);

//    print($response);	    
    curl_close($ch);

    if (strpos($response, '200 OK') === false) {
//	echo "in false";
        return false;
    }

    // find the auth code
    preg_match("/(Auth=)([\w|-]+)/", $response, $matches);

    if (!$matches[2]) {
        return false;
    }

    $_SESSION['google_auth_id'] = $matches[2];
    return $matches[2];
}

?>

