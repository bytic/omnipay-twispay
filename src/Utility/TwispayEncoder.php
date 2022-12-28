<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Utility;

/**
 *
 */
class TwispayEncoder
{
    /**
     * Get the `jsonRequest` parameter (order parameters as JSON and base64 encoded).
     *
     * @param array $orderData The order parameters.
     *
     * @return string
     */
    public static function getBase64JsonRequest(array $orderData)
    {
        return base64_encode(json_encode($orderData));
    }

    /**
     * Get the `checksum` parameter (the checksum computed over the `jsonRequest` and base64 encoded).
     *
     * @param array $orderData The order parameters.
     * @param string $secretKey The secret key (from Twispay).
     *
     * @return string
     */
    public static function getBase64Checksum(array $orderData, string $secretKey)
    {
        $hmacSha512 = hash_hmac(/* algo */ 'sha512', json_encode($orderData), $secretKey, /* raw_output */ true);

        return base64_encode($hmacSha512);
    }
}
