---
title: php常见关键字
date: 2019-03-30 08:46:30
tags: keywords
---

> 本篇文章将介绍php的几个常见关键字，便于理清之间的关系。
> 后续可能会更改。

 <!-- more -->

# final
## 定义
final关键字可以加在类或者类中方法之前，但是不能使用final标识成员属性。

## 作用
1.  使用final标识的类，不能被继承。
2.  在类中使用final标识的成员方法，在子类中不能覆盖。

## 注意点
final表示为最终的意思，所以使用final关键字的类或者类中的成员方法是不能被更改的。

# static
## 定义
static关键字将类中的成员属性或者成员方法标识为静态的，static标识的成员属性属于整个类，static成员总是唯一存在的，被类的全部对象实例共享

## 作用
1. 放在函数内部修饰变量
2. 放在类里修饰属性，或方法
3. 放在类的方法里修饰变量
4. 修饰在全局作用域的变量

# const 与define
## 共同点
都用于定义常量

## 不同点
1. const用于类成员变量，一经定义不可更改，define用于全局变量，不能用于类成员变量的定义。

2. const定义的常量大型写敏感，define可通过第三个参数（为TRUE表示大小写不敏感）指定大小写是否敏感。

3. const不能在条件语句中定义常量
```
if($a> 10){
  define('LE','hello');
}
```

# 参考链接
1. https://www.cnblogs.com/tianshuowang/p/4676505.html
2. https://www.cnblogs.com/52php/p/5658168.html
3. http://www.cnblogs.com/-mrl/p/6485616.html
4. https://mp.weixin.qq.com/s/vjw3YMcL8MTKcypVj0iz-A
5. https://blog.csdn.net/m0_37082962/article/details/80854022


