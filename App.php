<?php

class App {
    public function __construct(bool $debug = false) {
        if ($debug) :
            error_reporting(-1);
            define('YII_DEBUG', true);
        endif;

        header_remove("X-Powered-By");
        require(__DIR__.'/vendor/autoload.php');
        require(__DIR__.'/vendor/yiisoft/yii2/Yii.php');

        $app = new \yii\web\Application($this->getConfig());
        $app->run();
    }

    private function getConfig() {
        $srv = yii\helpers\ArrayHelper::getValue($_SERVER, 'SERVER_NAME');
        switch (substr($srv, 0, 4) === 'www.' ? substr($srv, 4) : $srv) :
            case 'upperlimit.de':
                return $this->loadConfig('de');
            case 'upperlimit.eu':
                return $this->loadConfig('en');
        endswitch;
    }

    private function loadConfig(string $lang = null): array {
        return \yii\helpers\ArrayHelper::merge(
            ['language' => $lang],
            require(__DIR__.'/common.php'),
            require(__DIR__.'/web.php')
        );
    }
}
