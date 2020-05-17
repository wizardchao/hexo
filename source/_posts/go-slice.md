---
title: slice切片
date: 2020-05-17 23:00:33
tags: GO
top: 1004
---

> 环境为ubuntu16
> 此篇介绍切片的定义与用法

 <!-- more -->

 # 定义
 ```
 切片（slice）是对数组一个连续片段的引用（该数组我们称之为相关数组，通常是匿名的），所以切片是一个引用类型（因此更类似于 C/C++ 中的数组类型，或者 Python 中的 list 类型）。这个片段可以是整个数组，或者是由起始和终止索引标识的一些项的子集。需要注意的是，终止索引标识的项不包括在切片内。切片提供了一个相关数组的动态窗口。
 ```

 ##  长度与容量
 ```
 长度：len()
 容量：cap() //它等于切片从第一个元素开始，到相关数组末尾的元素个数。如果 s 是一个切片，cap(s) 就是从 s[0] 到数组末尾的数组长度
 ```
 ## 优点
 ```
 切片是引用，所以它们不需要使用额外的内存并且比使用数组更有效率
 ```

 # 格式
 ```
 var a [10]int  //定义一个数字
 var s []int = a[0:4] //切片
 fmt.Println(s)  //[0，0，0，0]

 var a[]=int{0,1,2}
 ```

 # make操作
 ```
 s :=make([]int,0,5)  //长度为0，容量为5的切片
 s :=make([],5)  //长度容量都为5的切片
 ```
 # append方法
 ```
 s := make([]int, 4)
 s = append(s, 4)
 ```

 # 参考文档
 1. https://juejin.im/post/5ec085eff265da7bca5008bf?utm_source=gold_browser_extension
 2. https://learnku.com/docs/the-way-to-go/72-slice/3613