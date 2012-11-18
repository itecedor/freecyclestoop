<?


require('lib/PHP-OAuth2/Client.php');

require('lib/PHP-OAuth2/GrantType/IGrantType.php');
require('lib/PHP-OAuth2/GrantType/AuthorizationCode.php');

// These are your Singly client ID and secret from here:
// https://singly.com/apps
const CLIENT_ID = 'b63f9e7ba0c64a76c89336605f25f4e4';
const CLIENT_SECRET = '8c2177ab3988a1b45a42342bb76ff79d';

// Set his is the URL of this file (http://yourdomain.com/index.php, for example)
const REDIRECT_URI = 'http://localhost:8888/auth.php';

// The service you want the user to authenticate with
const SERVICE = 'facebook';

const AUTHORIZATION_ENDPOINT = 'https://api.singly.com/oauth/authorize';
const TOKEN_ENDPOINT = 'https://api.singly.com/oauth/access_token';

$client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET);

if (!isset($_GET['code'])) {
   $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI) ."&service=". SERVICE;

   header('Location: '. $auth_url);

   die('Redirect');
} else {
   $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);

   $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);

   $singly_account = $response['result']['account'];
   $access_token = $response['result']['access_token'];

   // check if user is in the db
   require("dbconfig.php");

   $query = "SELECT * FROM users WHERE singly_account = '$singly_account';";

   $result = mysql_query($query);

   // if not, add them to users and to sessions
   if( mysql_num_rows($result) == 0) {
   		$new_user_query = "INSERT INTO users (`singly_account`) VALUES ('$singly_account');";
   		$new_user_result = mysql_query($new_user_query);

		$get_user_id_query = "SELECT id FROM users WHERE singly_account = '$singly_account';";
		$user_id_result = mysql_query($get_user_id_query);

		while($row = mysql_fetch_row($user_id_result)) {
			$user_id = $row[0];
		}

		$new_session_query = "INSERT INTO sessions (`user_id`, `access_token`) VALUES ($user_id, '$access_token');";
		$new_session_result = mysql_query($new_session_query);
   }
   // if so, add to sessions
   else {
   		echo "user exists";
   		echo "<p>";
   		while($row = mysql_fetch_row($result)) {
			$user_id = $row[0];
		}
		$new_session_query = "INSERT INTO sessions (`user_id`, `access_token`) VALUES ($user_id, '$access_token');";
		$new_session_result = mysql_query($new_session_query);
   }
 
   print_r($response);
   // You should also store this in the user's session
   $client->setAccessToken($response['result']['access_token']);

   //print_r($client);

   // From here on you can access Singly API URLs using $client->fetch
   $response = $client->fetch('https://api.singly.com/profiles');


}