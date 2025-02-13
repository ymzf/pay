# 一鸣支付


## 安装要求

PHP 5.6.0 及更高版本

## Composer

您可以通过 [Composer](http://getcomposer.org/) 安装绑定。运行以下命令：

```bash
composer require ymzf/pay
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once 'vendor/autoload.php';
```

## 手动安装

如果您不想使用 Composer，可以下载最新版本。然后单独使用 `Api.php`

```php
require_once '..../Api.php';
```

## 依赖

The bindings require the following extensions in order to work properly:

-   [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer
-   [`json`](https://secure.php.net/manual/en/book.json.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## 使用示例

一般用法

```php
$app_id = "应用ID";
$apiKey = "应用密钥";
$api = new Api($app_id, $apiKey);
$orderInfo = [
    'channel_id' => '通道ID',
    'merchant_order_no' => date('YmdHis') . mt_rand(1000, 9999), //商户订单号
    'order_amount' => '20.00', // 订单金额
    'return_url' => 'http://www.ymzf.org/return', // 同步回调地址
    'notify_url' => 'http://www.ymzf.org/notify', // 异步回调地址
];

### 创建订单
$result = $api->createOrder($orderInfo);

### 查询订单
$result = $api->queryOrder('系统订单号');


```
