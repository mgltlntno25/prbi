<?php

namespace App\Http\Controllers;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use ProductionEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "AbGnKOw7mQdj4DBfBvyzBuzyMKnpwbT5CBGjAi5gYphRGllGuJDd0aeRwcOHZrsc5BSibAn3qDYPmHIz";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EN07FCIRz1ZQVRbjb1l8mrG6Z17pRiTMNc29rpnni8zokmj_IHgR31COsJtJlMoS3_uTrkNAosEeWUXK";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}