<?php
/**
 * JS api
 */
use LSYS\Wechat\JS;
include_once __DIR__."/Bootstarp.php";
// 获取使用文件缓存 access
JS::set_share_access(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache"));
// 共享 jsapi ticket 缓存接口
JS::set_share_jsapi_ticket(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache",'jsapitick'));
// 共享 api ticket 缓存接口
JS::set_share_api_ticket(new LSYS\Wechat\AccessCache\Folder(__DIR__."/access_cache",'apitick'));


$js=\LSYS\Wechat\DI::get()->wechat_js();
$appid=$js->get_appid();
$url='http://baidu.com';
$signature=$js->get_jsapi_signature($url,$ticket,$time,$rand);
?>

<script type="text/javascript" src=" http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<script>
wx.config({
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?php echo $appid?>', // 必填，公众号的唯一标识
    timestamp: '<?php echo $time?>', // 必填，生成签名的时间戳
    nonceStr: '<?php echo $rand?>', // 必填，生成签名的随机串
    signature: '<?php echo $signature?>',// 必填，签名，见附录1
    jsApiList: [] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
</script>

