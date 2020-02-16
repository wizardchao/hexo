---
title: yii入坑
date: 2019-04-11 23:35:54
tags:
 - Yii
---


> 作为Yii正式入坑的第一篇博客，首先贴出一些配置项自认为是很有必要的。
>  本篇介绍路径选取的一些方法和Rules的一些规则。

 <!-- more -->

 ## 路径选取

 ```
 public function actionGetUrlList()
{
    echo "当前域名地址：".Yii::$app->request->hostInfo."<br>";
    echo "当前目录物理路径：".Yii::$app->basePath."<br>";  
    echo "当前项目路径：".dirname(Yii::$app->BasePath)."<br>";
    echo "当前Url: ".Yii::$app->request->url."<br>";
    echo "当前Home Url: ".Yii::$app->homeUrl."<br>";
    echo "当前return Url: ".Yii::$app->user->returnUrl."<br>";
    echo "获取当前模块ID方法：".Yii::$app->controller->module->id."<br>";
    echo "获取当前控制器的ID方法：".Yii::$app->controller->id."<br>";
    echo "获取当前action的ID方法：".Yii::$app->controller->action->id."<br>";
    echo "ip地址： ".Yii::$app->request->userIP."<br>";
}
 ```


 ## Rules

 ### required : 必须值验证属性

 ```
 [['字段名'],required,'requiredValue'=>'必填值','message'=>'提示信息']; #说明:CRequiredValidator 的别名, 确保了特性不为空. 
 ```

 ### email : 邮箱验证
 ```
 ['email', 'email']; #说明:CEmailValidator的别名,确保了特性的值是一个有效的电邮地址. 
 ```

 ### 手机号码
 ```
 [['mobile'],match,'pattern'=>  "/^1[34578]\d{9}$/",'message'=>'请填写正确的手机格式！']; 

 ```

 ### match : 正则验证

```
[['字段名'],match,'pattern'=>'正则表达式','message'=>'提示信息'];      

[['字段名'],match,'not'=>ture,'pattern'=>'正则表达式','message'=>'提示信息']; /*正则取反*/ #说明:CRegularExpressionValidator 的别名, 确保了特性匹配一个正则表达式.
```


### unique : 唯一性

```
['username', 'unique'] #说明:CUniqueValidator 的别名,确保了特性在数据表字段中是唯一的. 
```

### integer : 整数
```
['age', 'integer'];
```

### number : 数字
```
['salary', 'number'];
```

### in : 范围
```
['level', 'in', 'range' => [1, 2, 3]]; #说明:CRangeValidator 的别名,确保了特性出现在一个预订的值列表里.
```

### exist : 存在
```
['username', 'exist']; #说明:CExistValidator 的别名,确保属性值存在于指定的数据表字段中. 
```

### default : 默认值
```
['age', 'default', 'value' => null]; #说明:CDefaultValueValidator 的别名, 为特性指派了一个默认值
```

### 字段必填
```
['email', 'required']  
```

### 字符串长度
```
['email', 'string', 'min' => 3, 'max' => 20] 或 ['email', 'string', 'length' => [3, 20]] 
```

## 参考链接
1. https://blog.csdn.net/h330531987/article/details/77151843


2. https://www.cnblogs.com/huay/p/10481184.html

