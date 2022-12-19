<?php

$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c";
$key = "your-256-bit-secret";

function getTokenPayload($token, $key)
{
    $t = explode('.', $token);
    // Проверяем число элементов токена, должно быть три
    if (count($t)!=3) {
        return false;
    }
    // Получаем заголовок из токена
    $header=json_decode(base64_decode($t[0]));
    // Получаем содержимое токена
    $payload = json_decode(base64_decode($t[1]));
    // Проверяем корректно ли декодировались данные из токена
    if (!$header or !$payload) {
        return false;
    }
    // Проверяем, что токен является JWT
    if (!isset($header->typ) or $header->typ!='JWT') {
        return false;
    }
    // Проверяем, что в токене указан алгоритм
    if (!isset($header->alg)) {
        return false;
    }
    // Готовим данные токена для проверки хеша
    $token_data = $t[0] . '.' . $t[1];
    // Получаем хеш в соответствии с алгоритмам
    switch ($header->alg) {
        case 'HS256':
            $hash=hash_hmac('sha256', $token_data, $key, true);
            if ($t[2] != str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($hash))) {
                return false;
            }
            break;
        default:
            return false;
    }
    // Ещё нужно проверить время действия токена
    return $payload;
}

var_dump(getTokenPayload($token, $key));