<?php

namespace TomLutzenberger\GoogleTagManager;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

/**
 * Class GoogleTagManager
 *
 * @package   TomLutzenberger\GoogleTagManager
 * @copyright 2019 Tom Lutzenberger
 * @author    Tom Lutzenberger <lutzenbergertom@gmail.com>
 */
class GoogleTagManager extends Widget
{
    /**
     * @var string The id of the container
     */
    public $gtmId;


    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if (isset(Yii::$app->params['gtmId'])) {
            $this->gtmId = Yii::$app->params['gtmId'];
        }

        if (!isset($this->gtmId) || empty($this->gtmId)) {
            return '';
        }

        $view = $this->getView();
        $view->registerJs("(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{$this->gtmId}');", View::POS_HEAD);

        return Html::tag('noscript', Html::tag('iframe', '', [
            'src'    => 'https://www.googletagmanager.com/ns.html?id=' . $this->gtmId,
            'height' => '0',
            'width'  => '0',
            'style'  => 'display:none;visibility:hidden',
        ]));
    }
}
