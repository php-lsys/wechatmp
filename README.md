#微信公众号接口

> 开发本接口原因,网上没找到优雅的微信开源的接口代码,现存总有这些问题:使用方式不明朗,或加载过多废代码,或莫名其妙的一个接口实现还要依赖一个框架的脑残实现,或无法优雅的兼容的全局的access共享,综合以上原因,实现以下此代码

> access 本地存放以实现以下方式存放,可自行实现,access超时会自动更新,支持在后台进程长时间运行调用
	
	"lsys/wechatmp-accesscache-memcache":"~2.0.0",
	"lsys/wechatmp-accesscache-memcached":"~2.0.0",
	"lsys/wechatmp-accesscache-redis":"~2.0.0"

> 本接口未包含微信支付.需要支付接口 请使用 https://github.com/php-lsys/paygateway

> 具体使用参考 dome 目录下示例,基本每个接口都有示例

> composer require lsys/wechatmp

> 已封装接口列表,备注:消息体已统一封装,方便调用

	1. 客服
	2. JSAPI
	3. 素材管理
	4. 菜单
	5. 微信登录[包括开放平台扫码登录]
	6. 二维码生成
	7. 模板消息
	8. 自动回复设置
	9. 用户管理
	10. 群发消息
	11. 卡券生成核销 [仅接入特殊票券:会议门票,景点门票,电影票,飞机票.其他卡券没实现,因为要关联门店API或暂时用不到...]
	12. 短链接生成
	13. 语义接口


