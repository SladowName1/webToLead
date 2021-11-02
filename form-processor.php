//Initialize the $query_string variable for later use
$query_string = &quot;&quot;;

//If there are POST variables
if ($_POST) {

//Initialize the $kv array for later use
$kv = array();

//For each POST variable as $name_of_input_field =&amp;gt; $value_of_input_field
foreach ($_POST as $key =&amp;gt; $value) {

//Set array element for each POST variable (ie. first_name=Arsham)
$kv[] = stripslashes($key).&quot;=&quot;.stripslashes($value);

}

//Create a query string with join function separted by &amp;amp;
$query_string = join(&quot;&amp;amp;&quot;, $kv);
}

//Check to see if cURL is installed ...
if (!function_exists('curl_init')){
die('Sorry cURL is not installed!');
}

//The original form action URL from Step 2 :)
$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';

//Open cURL connection
$ch = curl_init();

//Set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($kv));
curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);

//Set some settings that make it all work :)
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

//Execute SalesForce web to lead PHP cURL
$result = curl_exec($ch);

//close cURL connection
curl_close($ch);