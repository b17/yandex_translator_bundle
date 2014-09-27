Symfony 2 Yandex Translator Bundle
========================

The client for [Yandex Translator Api](http://api.yandex.ru/translate/).


Config
------

### `app/config/config.yml`

    b17_yandex_translator:
        api_key: your_api_key


Usage
---------
### `Getting text language`

    $container->get('yandex_translator')->getLanguage('Привіт, як справи?');


### `Translating simple text`
   
    $container->get('yandex_translator')->translate("Привіт, як справи?", 'ru');

### `Translating html text`

    $container->get('yandex_translator')->translate("<span>Київ</span>", 'ru', null, 'html');


