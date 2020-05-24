---
title: PHP中用Trait封装单例模式
date: 2020-05-24 15:15:22
top: 113
tags: Pattern
---

> 此篇为单例模式的扩展应用，配合上一篇单例模式则食用更佳
  <!-- more -->

  # 单例模式
  ## 定义
  ```
   确保某一个类只有一个实例，不能重复实例，只能它自己实例化，而且向整个系统提供这个实例
  ```

  ## 原则
 ```
私有化静态属性
私有化构造方法
私有化克隆方法
公有化静态方法
 ```

 # 封装背景
 ```
 当项目中有多个单例类，每新建一个类，都得做三私一公的定义，就显得有些做重复工作了，
 不仅仅浪费时间浪费精力，而且代码臃肿且难维护
 ```

 # trait封装单例

 ## 创建trait
 ```
 private function __construct()  
 {  
    parent::__construct();  
    // 私有化构造方法  
 }  
  
 private function __clone()  
 {  
    // 私有化克隆方法  
 }  
  
 public function __sleep()  
 {  
    //重写__sleep方法，将返回置空，防止序列化反序列化获得新的对象  
    return [];  
 }  
  
 public static function getInstance()  
 {  
    if (!isset(self::$instance)) {  
        self::$instance = new static();//这里不能new self(),self和static区别  
    }  
    return self::$instance;  
  }  
}
 ```

 ## 多继承用法
 ```
 <?php  
/**  
 * Desc: 业务类1 继承实例
 */ 
 
class YieWu1
{  
  use Singleton;  // 关键一行代码
  
  public function getInfo(){
      // 业务代码
  }
}

 ```

 ```
 <?php  
/**  
 * Desc: 业务类2 继承实例
 */ 
 
class YieWu2
{  
  use Singleton;  // 关键一行代码
  
  public function getInfo(){
      // 业务代码
  }
}
 ```

 ## 实例调用
 ```
 YieWu1::getInstance()->getInfo();
 YieWu2::getInstance()->getInfo();
 ```

 # 参考链接
 1. https://segmentfault.com/a/1190000021323559