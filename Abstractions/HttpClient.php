<?php

declare(strict_types=1);

namespace Abstractions;

require_once 'Core/functions.php';

final class HttpClient {

    public function __construct(
        public string $url
    ) {
    }

    public function post($data): string|bool {

        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
