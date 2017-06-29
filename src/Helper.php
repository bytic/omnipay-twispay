<?php

namespace ByTIC\Omnipay\Twispay;

/**
 * Class Helper
 * @package ByTIC\Omnipay\Twispay
 */
class Helper
{
    /**
     * @param array $data
     * @param string $key
     * @return string
     */
    public static function generateChecksun(array $data, string $key)
    {
        unset($data['checksum']);
        self::recursiveKeySort($data);
        $query = http_build_query($data);
        $encoded = hash_hmac('sha512', $query, $key, true);
        return base64_encode($encoded);
    }

    /**
     * @param array $data
     */
    private static function recursiveKeySort(array &$data)
    {
        ksort($data, SORT_STRING);
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                self::recursiveKeySort($data[$key]);
            }
        }
    }

    /**
     * @param string $encrypted
     * @param $key
     * @return null|string
     * @throws \Exception
     */
    public static function decrypt(string $encrypted, $key)
    {
        if (strpos($encrypted, ',') !== false) {
            $encryptedParts = explode(',', $encrypted, 2);
            $iv = base64_decode($encryptedParts[0]);
            if ($iv === false) {
                throw new \Exception('Invalid encryption iv');
            }
            $encrypted = base64_decode($encryptedParts[1]);
            if ($encrypted === false) {
                throw new \Exception('Invalid encrypted data');
            }
            $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
            if ($decrypted === false) {
                throw new \Exception('Cannot decrypt data');
            }
            return $decrypted;
        }
        return null;
    }
}