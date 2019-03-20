---
title: twig模版应用
date: 2019-03-20 12:00:15
tags: template
---

> 在框架中view层多用模板显示，之前用原生的不太简洁，效率有点低。
> 本篇介绍twig模板的应用。

 <!-- more -->


 ## 模板安装
 ### composer

 我所用的就是这种

 ```
 composer require twig/twig:~1.0
 ```

 ### git安装

 ```
git clone git://github.com/twigphp/Twig.git
cd Twig 
composer install
 ```

##  应用

### template

在相应位置下简历templates文件夹

```
mkdir templates && cd templates && touch TwigTemplate.php
```

在TwigTemplate.php新建类

```
class TwigTemplate
{
    public $view;

    public $data;

    public $twig;

    public $path = APPLICATION_PATH . '/modules/www/views/';

    /**
     * Twig constructor.
     * @param $view
     * @param $data
     */
    public function __construct($view, $data)
    {
      if($GLOBALS['basePathName']){
        $this->path=$GLOBALS['basePathName'];
      }
        $loader = new Twig_Loader_Filesystem($this->path);
        $this->twig = new Twig_Environment($loader, array(
            'cache' => APPLICATION_PATH . '/../cache/views/',
            'debug' => true
        ));

        $this->view = $view;
        $this->data = $data;

    }

    /**
     * @param $view
     * @param array $data
     * @return Twig
     */
    public static function render($view, $data = array())
    {

        return new TwigTemplate($view, $data);

    }

    public function __destruct()
    {
        $this->twig->display($this->view, $this->data);
    }
}
```

## 实现


### Controller层

```
$data=array(
  'test' => 'hello!',
);
 return   TwigTemplate::render('index.html',$data);
```

### View层

```
{{ test }}  //页面显示 hello
```

## 参考链接
1. https://www.kancloud.cn/yunye/twig-cn/159457
2. https://www.cnblogs.com/evai/p/6244043.html