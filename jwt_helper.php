<?php


define('JWT_SECRET', 'my_super_secret_key_123'); 
define('JWT_EXPIRY', 3600); 

function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlDecode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}

function generateJWT($payload) {
    $header = ['typ' => 'JWT', 'alg' => 'HS256'];

    $payload['iat'] = time();
    $payload['exp'] = time() + JWT_EXPIRY;

    $base64Header = base64UrlEncode(json_encode($header));
    $base64Payload = base64UrlEncode(json_encode($payload));

    $signature = hash_hmac(
        'sha256',
        $base64Header . "." . $base64Payload,
        JWT_SECRET,
        true
    );

    $base64Signature = base64UrlEncode($signature);

    return $base64Header . "." . $base64Payload . "." . $base64Signature;
}

function verifyJWT($jwt) {
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) return false;

    list($header, $payload, $signature) = $parts;

    $expected = base64UrlEncode(
        hash_hmac('sha256', "$header.$payload", JWT_SECRET, true)
    );

    if (!hash_equals($expected, $signature)) return false;

    $data = json_decode(base64UrlDecode($payload), true);

    if ($data['exp'] < time()) return false;

    return $data;
}
