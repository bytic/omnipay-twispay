<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay;

use Paytic\Omnipay\Twispay\Utility\TwispayDecoder;
use function is_array;
use const SORT_STRING;

/**
 * Class Helper.
 */
class Helper
{
    /**
     * @return string
     */
    public static function generateChecksum(array $data, string $key)
    {
        unset($data['checksum']);
        self::recursiveKeySort($data);
        $query = http_build_query($data);
        $encoded = hash_hmac('sha512', $query, $key, true);

        return base64_encode($encoded);
    }

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
     * @return string|null
     *
     * @deprecated use TwispayDecoder::decrypt
     */
    public static function decrypt(string $encrypted, $key)
    {
        return TwispayDecoder::decrypt($encrypted, $key);
    }
}
