---
title: yii导出Excel
date: 2019-04-16 22:34:58
tags:
 - Yii
---

> 尝试了一下用yii导出，真的特别方便，所以特地介绍一下
> 需要用composer

<!-- more -->

# 项目根目录下运行
```
composer require --prefer-dist moonlandsoft/yii2-phpexcel 
```
# controller下

  ```
  use moonland\phpexccel\Excel;
  ```
  ```
  Excel::export([
    'models' => $result,
    'fileName'=> 'file',
    'columns' => ['id','name'],
    'headers'=> [
     'id'=> '编号‘,
     'name' => '名字',
    ]
  ]);
  ```

  