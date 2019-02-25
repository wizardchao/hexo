---
title: 中国银行支付接入（一）网页支付
date: 2018-12-29 17:35:07
tags:
 - PAY
---

> 类似银联支付，不过没有支付demo,只能用真实数据，以下代码也是我经过多次整合的结果，
> 当中也是走了相当一大段弯路。

<!-- more -->

## 准备工作
第一步当然是先去阅读文档，不过在手机端一打开满满45页的内容让我有点懵，所幸得到了部门经理的许可下开始研究网页支付的流程

## 制作签名

   官方文档中是用java制作的签名，过程相当繁琐，没有用php的，上网随便一查，发现最牛逼的一种方法是在nginx下用tomcat转发，不管怎么说，这种方法也是相当6的存在。还好，百度到多年前的一种方法。

### 证书转化

   要用php加密中国银行的签名就必须要用到函数openssl_pkcs7_sign()，用这个函数就必须用到pem文件，所以文件格式必须转化，参见下方链接中的证书格式转化pdf，下载Win32OpenSSL0_9_8l_95895，(win32和win64应该是能够兼容的）  ，然后一步一步操作，操作在pdf会详细叙述，所以此处省略。

### 加密

    
```php
  /**
   * 原始签名
   * @param $orderNo  订单号
   * @param $orderTime 订单时间
   * @param $curCode 币种
   * @param $orderAmount 订单金额
   * @param $merchantNo 商户号
   * @param $mchCustIp  订单IP
   * @return mixed
   */
     public function dealSignData($orderNo, $orderTime, $curCode, $orderAmount, $merchantNo, $mchCustIp)
    {
      $originalSignData = $orderNo . '|' . $orderTime . '|' . $curCode . '|' $orderAmount . '|' . $merchantNo;
      $originalSignData = $mchCustIp ? $originalSignData . '|' . $mchCustIp :     $originalSignData;
      $signData = $this->makeSign($originalSignData);
      return $signData; 
    }
```

```php
 /**
  * 加密
  * @param $signData
  * @return mixed
  */
    public function makeSign($sign_word)
    {
        //将签名的原数据，写进文件中
        $fp = fopen(BASE_PATH . "/boc/source.txt", "w");
        fwrite($fp, $sign_word);
        fclose($fp);

        $source = BASE_PATH . "/boc/source.txt";//签名的原文
        $signed = BASE_PATH . "/boc/signed.txt";//签名的结果
        $signcert = BASE_PATH . "/boc/demo.pem";

        //openssl_pkcs7_sign 函数只识别.pem 的证书,先要用openSSL 将pfx 格式转化为pem
        openssl_pkcs7_sign($source, $signed, file_get_contents($signcert), file_get_contents($signcert), NULL, PKCS7_NOATTR);

        $fp = fopen(BASE_PATH . "/boc/signed.txt", "r");
        $long = filesize(BASE_PATH . "/boc/signed.txt");
        $data = fread($fp, $long);

        fclose($fp);
//从得到的签名结果中截取出，与中行提供的签名 类似的一部分
        $data = substr($data, 187, -1);
        return $data;
    }
```
### 提交
提交至：https://ebspay.boc.cn/PGWPortal/RecvOrder.do，在里面附加一个回调地址

## 下载链接

1. http://cloud.wizardchao.com.cn/index.php/s/5NLyFjf7Eogx79q
