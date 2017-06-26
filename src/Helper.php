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
    
}