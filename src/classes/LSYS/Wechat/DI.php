<?php
namespace LSYS\Wechat;
/**
 * @method \LSYS\Wechat\Sns wechat_sns($config=null)
 * @method \LSYS\Wechat\JS wechat_js($config=null)
 * @method \LSYS\Wechat\Card wechat_card($config=null)
 * @method \LSYS\Wechat\AutoReply wechat_auto_reply($config=null)
 * @method \LSYS\Wechat\KF wechat_kf($config=null)
 * @method \LSYS\Wechat\Mass wechat_mass($config=null)
 * @method \LSYS\Wechat\Media wechat_media($config=null)
 * @method \LSYS\Wechat\Menu wechat_menu($config=null)
 * @method \LSYS\Wechat\Msg wechat_msg($config=null)
 * @method \LSYS\Wechat\Qrcode wechat_qrcode($config=null)
 * @method \LSYS\Wechat\TplMsg wechat_tplmsg($config=null)
 * @method \LSYS\Wechat\User wechat_user($config=null)
 * @method \LSYS\Wechat\Utils wechat_utils($config=null)
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
        !isset($di->wechat_sns)&&$di->wechat_sns(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Sns($config);
            })
        );
        !isset($di->wechat_js)&&$di->wechat_js(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\JS($config);
            })
        );
        !isset($di->wechat_card)&&$di->wechat_card(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Card($config);
            })
        );
        !isset($di->wechat_auto_reply)&&$di->wechat_auto_reply(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\AutoReply($config);
            })
        );
        !isset($di->wechat_kf)&&$di->wechat_kf(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\KF($config);
            })
        );
        !isset($di->wechat_mass)&&$di->wechat_mass(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Mass($config);
            })
        );
        !isset($di->wechat_media)&&$di->wechat_media(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Media($config);
            })
        );
        !isset($di->wechat_menu)&&$di->wechat_menu(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Menu($config);
            })
        );
        !isset($di->wechat_msg)&&$di->wechat_msg(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Msg($config);
            })
        );
        !isset($di->wechat_qrcode)&&$di->wechat_qrcode(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Qrcode($config);
            })
        );
        !isset($di->wechat_tplmsg)&&$di->wechat_tplmsg(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\TplMsg($config);
            })
        );
        !isset($di->wechat_qrcode)&&$di->wechat_qrcode(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\Qrcode($config);
            })
        );
        !isset($di->wechat_user)&&$di->wechat_user(
            new \LSYS\DI\ShareCallback(function($config=null){
                return $config?$config:self::$config;
            },function($config=null){
                $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
                return new \LSYS\Wechat\User($config);
            })
        );
        !isset($di->wechat_utils)&&$di->wechat_utils(
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