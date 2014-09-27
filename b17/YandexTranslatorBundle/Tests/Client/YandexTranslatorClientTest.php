<?php

namespace b17\YandexTranslatorBundle\Tests\Client;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class YandexTranslatorClientTest extends WebTestCase
{
    public function getTranslator()
    {
        static::bootKernel();
        return self::$kernel->getContainer()
            ->get('yandex_translator');
    }

    public function testGetLanguage()
    {
        $this->assertEquals('uk', $this->getTranslator()->getLanguage('Привіт, як справи?'));
        $this->assertEquals('ru', $this->getTranslator()->getLanguage('Привет, как дела?'));
    }

    public function testTranslate()
    {
        $this->assertEquals('Привет, как дела?', $this->getTranslator()->translate("Привіт, як справи?", 'ru'));
        $this->assertEquals('<span>Киев</span>', $this->getTranslator()->translate("<span>Київ</span>", 'ru', 'uk', 'html'));
    }
}