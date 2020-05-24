---
title: php设计模式 异刃连击之三连
date: 2020-05-24 14:57:08
top: 112
tags: Pattern
---

> 本篇将介绍单例模式，工厂模式及注册树模式三者的结合
> 希望看完能有所成长

  <!-- more -->

  # 注册树模式
```
简单地说就是通过将对象实例注册到一棵全局的对象树上，
需要的时候从对象树上采摘的模式设计方法，单例模式解决的是如何在整个项目中创建唯一对象
实例的问题，工厂模式解决的是如何不通过new建立实例对象的方法，为了更好的管理以及扩展项
目，我们可以把工厂生产的对象注册到一个静态变量里，需要用的使用直接使用即可，提高了使用
对象的方便程度。
```
  # 实现

  ```
<?php
//创建单例
class Single{
    public $hash;
    static protected $ins=null;
    final protected function __construct(){
        $this->hash=rand(1,9999);
    }

    static public function getInstance(){
        if (self::$ins instanceof self) {
            return self::$ins;
        }
        self::$ins=new self();
        return self::$ins;
    } 
}

//工厂模式
class RandFactory{
    public static function factory(){
        return Single::getInstance();
    }
}

//注册树
class Register{
    protected static $objects;
    public static function set($alias,$object){
        self::$objects[$alias]=$object;
    }
    public static function get($alias){
        return self::$objects[$alias];
    }
    public static function _unset($alias){
        unset(self::$objects[$alias]);
    }
}

Register::set('rand',RandFactory::factory());

$object=Register::get('rand');

print_r($object);
  ```

# 参考链接
1. https://www.cnblogs.com/DeanChopper/p/4767181.html
2. https://blog.csdn.net/yilukuangpao/article/details/89317853
