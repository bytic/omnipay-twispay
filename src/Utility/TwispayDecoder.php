<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Utility;

use function strlen;
use const OPENSSL_RAW_DATA;

class TwispayDecoder
{
    public static function decrypt($encrypted, $key = 'YOUR API KEY HERE')
    {
        $encrypted = (string)$encrypted;
        if (!strlen($encrypted) || (false == strpos($encrypted, ','))) {
            return null;
        }

        $encryptedParts = explode(',', $encrypted, 2);
        $decoded = base64_decode($encryptedParts[0]);
        if (false === $decoded) {
            throw new Exception('Invalid encryption iv');
        }

        $encrypted = base64_decode($encryptedParts[1]);
        if (false === $encrypted) {
            throw new Exception('Invalid encrypted data');
        }

        $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $decoded);
        if (false === $decrypted) {
            throw new Exception('Data could not be decrypted');
        }

        return $decrypted;
    }
}
