<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Utility;

/**
 *
 */
class TwispayTransactionMode
{
    // “auth” (only reserve the requested amount),

    // “authAndCapture” (also sends a settlement request),
    public const AUTH_AND_CAPTURE = 'authAndCapture';

    // “credit”
}
