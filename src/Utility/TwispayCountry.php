<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Utility;

use Nip\Utility\Country;

class TwispayCountry
{
    /**
     * @param $name
     */
    public static function transform($name = null): string
    {
        if (empty($name)) {
            return 'US';
        }

        if (strlen($name) == 2) {
            return strtoupper($name);
        }

        $country = Country::fromName($name);
        return $country->alpha2;
    }
}