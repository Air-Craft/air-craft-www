<?php



function buildBaseString($baseURI, $method, $params)
{
    $r = array();
    ksort($params);
    foreach ($params as $key => $value) {
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth)
{
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach ($oauth as $key => $value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

function getTweets($usr, $count, $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret)
{
    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

//    $oauth_access_token = "7134262-5oEfJM3e9QNcP6eFWnoPY6hkPSJmhqXFCljSsanprg";
//    $oauth_access_token_secret = "UBluMI03on2cIDgYaaSyuwHeAlG5OpfjVt5ZBUg5SY";
//    $consumer_key = "fCuoVkS3OviKVxzv9nHhA";
//    $consumer_secret = "AZAEBg1CO60A2ZYcAI4UDM5yy94sRJPOpHXaCNL9qA";

    $oauth = array('oauth_consumer_key' => $consumer_key,
        'screen_name' => $usr,
        'count' => $count,
        'oauth_nonce' => time(),
        'oauth_signature_method' => 'HMAC-SHA1',
        'oauth_token' => $oauth_access_token,
        'oauth_timestamp' => time(),
        'oauth_version' => '1.0');

    $base_info = buildBaseString($url, 'GET', $oauth);
    $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
    $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $oauth['oauth_signature'] = $oauth_signature;

// Make Requests
    $header = array(buildAuthorizationHeader($oauth), 'Expect:');
    $options = array(CURLOPT_HTTPHEADER => $header,
        //CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HEADER => false,
        CURLOPT_URL => $url . '?screen_name=' . $usr . '&count=' . $count,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false);

    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);

    //$twitter_data = json_decode($json);
    return $json;
}
