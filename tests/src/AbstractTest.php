<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use function is_array;

/**
 * Class AbstractTest.
 */
abstract class AbstractTest extends TestCase
{
    protected $object;

    protected function createHttpRequestFromFixtures($fixtures = null)
    {
        if (null === $fixtures) {
            return HttpRequest::createFromGlobals();
        }
        if (is_array($fixtures)) {
            $data = $fixtures;
        } else {
            if (!file_exists($fixtures)) {
                throw new Exception('File not found: ' . $fixtures);
            }
            $data = require $fixtures;
        }

        return new HttpRequest(
            $data['get'] ?? [],
            $data['post'] ?? [],
            $data['attributes'] ?? [],
        );
    }
}
