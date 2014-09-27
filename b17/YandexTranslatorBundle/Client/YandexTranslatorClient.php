<?php

namespace b17\YandexTranslatorBundle\Client;

use b17\YandexTranslatorBundle\Exception\ApiCallException;
use Buzz\Browser;
use Buzz\Client\Curl;

class YandexTranslatorClient
{
    private $apiKey;

    private $browser;

    public function __construct($apiKey, $client = null)
    {
        $this->apiKey = $apiKey;
        $this->browser = new Browser($client ? :  new Curl());
    }

    protected function call($url)
    {
        $response = $this->browser->get($url);
        if (!$response->isSuccessful()) {
            throw new ApiCallException($response, $response->getStatusCode());
        }

        return json_decode($response->getContent());
    }

    public function getLanguage($text)
    {
        $url = 'https://translate.yandex.net/api/v1.5/tr.json/detect?' . http_build_query(array(
                'key'  => $this->apiKey,
                'text' => $text
            ));

        $response = $this->call($url);

        return $response->lang;
    }


    public function translate($text, $targetLang, $sourceLang = null, $format = 'plain')
    {
        $lang = null === $sourceLang ? $targetLang : $sourceLang . "-" . $targetLang;

        $url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?' . http_build_query(array(
                'key'    => $this->apiKey,
                'text'   => $text,
                'lang'   => $lang,
                'format' => $format
            ));

        $response = $this->call($url);

        return $response->text[0];
    }
} 