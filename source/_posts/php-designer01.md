---
title: 浅谈单例模式
date: 2019-03-27 22:27:06
top: 99
tags: Pattern
---

> 最近面试老是被提及到，所以特地准备两一下资料，写下这篇
> 因为感觉技术不是很扎实，所以只能浅谈。

 <!-- more -->

# 概念

单例模式又称为职责模式，它用来在程序中创建一个单一功能的访问点，通俗地说就是实例化出来的对象是唯一的。

# 特性

## 三私一公

1. 私有静态属性，又来储存生成的唯一对象
2. 私有构造函数
3. 私有克隆函数，防止克隆——clone
4. 公共静态方法，用来访问静态属性储存的对象，如果没有对象，则生成此单例

## instanceof

检查此变量是否为该类的对象、子类、或是实现接口

1. 一个private的__construct是必须的，单例类不能在其它类中实例化，只能被自身实例化；
2. 拥有一个保存类的实例的静态成员变量;
3. 一个静态的公共方法用于实例化这个类，并访问这个类的实例;

## 代码实现

```
class SingleInstance{
        
        private function _construct(){
            
        }
        
       private static $instance;
       
       private function _clone(){
           
       }
       public static function getInstance(){
           if(!self::$instance instanceof SingleInstance){
               self::$instance=new SingleInstance();
           }
           return self ::$instance;  
       }
      
    }
```
# 应用场景
1. 数据库的连接
2. 网站的计数器
3. 配置文件的读取
4. 应用程序的日志应用，一般都何用单例模式实现，这一般是由于共享的日志文件一直处于打开状态，因为只能有一个实例去操作，否则内容不好追加。

# 优点
1. 减少频繁创建，节省了cpu。
2. 静态对象公用，节省了内存。
3. 功能解耦，代码已维护。

# 参考链接：
1. https://blog.csdn.net/zlb_lover/article/details/80673092

2. https://segmentfault.com/a/1190000009996347