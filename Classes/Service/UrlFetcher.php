<?php

namespace KERN23\XmlXpath\Service;

class UrlFetcher {

    /**
     * Loads JSON Date from an external Source
     */
    public static function getUrl($url) {
        // Initialize
        $ch = curl_init();

        // Options
        curl_setopt($ch, CURLOPT_URL, $url); // URL
        curl_setopt($ch, CURLOPT_USERAGENT, 'NnHshPersonendaten/1.0'); // User-Agent
        curl_setopt($ch, CURLOPT_HEADER, 0); // Return Headers
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return Data or send it to the browser
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Request Timeout
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8'); // Encoding
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        // Execute
        $output = curl_exec($ch);

        // Close Connection
        curl_close($ch);

        // return result
        return $output;
    }
}