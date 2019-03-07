<?php
namespace LSYS\Wechat;
/**
 * @method \LSYS\Wechat\Sns wechatSNS($config=null)
 * @method \LSYS\Wechat\JS wechatJs($config=null)
 * @method \LSYS\Wechat\Card wechatCard($config=null)
 * @method \LSYS\Wechat\AutoReply wechatAutoReply($config=null)
 * @method \LSYS\Wechat\KF wechatKF($config=null)
 * @method \LSYS\Wechat\Mass wechatMass($config=null)
 * @method \LSYS\Wechat\Media wechatMedia($config=null)
 * @method \LSYS\Wechat\Menu wechatMenu($config=null)
 * @method \LSYS\Wechat\Msg wechatMsg($config=null)
 * @method \LSYS\Wechat\QrCode wechatQrCode($config=null)
 * @method \LSYS\Wechat\TplMsg wechatTplMsg($config=null)
 * @method \LSYS\Wechat\User wechatUser($config=null)
 * @method \LSYS\Wechat\Utils wechatUtils($config=null)
 */
class DI extends \LSYS\DI{
    /**
     *
     * @var string default config
     */
    public static $config = 'wechat_mp.default';
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        !isset($di->wechatSNS)&&$di->wechatSNS(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Sns($config);
            })
        );
        !isset($di->wechatJs)&&$di->wechatJs(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\JS($config);
            })
        );
        !isset($di->wechatCard)&&$di->wechatCard(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Card($config);
            })
        );
        !isset($di->wechatAutoReply)&&$di->wechatAutoReply(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\AutoReply($config);
            })
        );
        !isset($di->wechatKF)&&$di->wechatKF(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\KF($config);
            })
        );
        !isset($di->wechatMass)&&$di->wechatMass(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Mass($config);
            })
        );
        !isset($di->wechatMedia)&&$di->wechatMedia(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Media($config);
            })
        );
        !isset($di->wechatMenu)&&$di->wechatMenu(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Menu($config);
            })
        );
        !isset($di->wechatMsg)&&$di->wechatMsg(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Msg($config);
            })
        );
        !isset($di->wechatQrCode)&&$di->wechatQrCode(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Qrcode($config);
            })
        );
        !isset($di->wechatTplMsg)&&$di->wechatTplMsg(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\TplMsg($config);
            })
        );
        !isset($di->wechatUser)&&$di->wechatUser(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\User($config);
            })
        );
        !isset($di->wechatUtils)&&$di->wechatUtils(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Utils($config);
            })
        );
        return $di;
    }
}