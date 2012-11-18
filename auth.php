<?


require('lib/PHP-OAuth2/Client.php');

require('lib/PHP-OAuth2/GrantType/IGrantType.php');
require('lib/PHP-OAuth2/GrantType/AuthorizationCode.php');

// These are your Singly client ID and secret from here:
// https://singly.com/apps
const CLIENT_ID = 'b63f9e7ba0c64a76c89336605f25f4e4';
const CLIENT_SECRET = '8c2177ab3988a1b45a42342bb76ff79d';

// Set his is the URL of this file (http://yourdomain.com/index.php, for example)
const REDIRECT_URI = 'http://knitspiring.com/freecyclestoop/auth.php';

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

   session_start();
   $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);

   $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);

   $singly_account = $response['result']['account'];
   $access_token = $response['result']['access_token'];

   // check if user is in the db
   require("dbconfig.php");

   $get_user_id_query = "SELECT * FROM users WHERE singly_account = '$singly_account';";

   $user_id_result = mysql_query($get_user_id_query);

   // if not, add them to users
   if( mysql_num_rows($result) == 0) {
   		$new_user_query = "INSERT INTO users (`singly_account`) VALUES ('$singly_account');";
   		$new_user_result = mysql_query($new_user_query);

		$get_user_id_query = "SELECT id FROM users WHERE singly_account = '$singly_account';";
		$user_id_result = mysql_query($get_user_id_query);
   }
   // add session to db, setup browser session
   else {
   		while($row = mysql_fetch_row($result)) {
			$user_id = $row[0];
		}
		$new_session_query = "INSERT INTO sessions (`user_id`, `access_token`) VALUES ($user_id, '$access_token');";
		$new_session_result = mysql_query($new_session_query);

		$_SESSION['user_id'] = $user_id;
		$_SESSION['access_token'] = $client->setAccessToken($response['result']['access_token']);
   }
   // From here on you can access Singly API URLs using $client->fetch
   // $response = $client->fetch('https://api.singly.com/profiles');

  header('Location: http://knitspiring.com/freecyclestoop/');
}
