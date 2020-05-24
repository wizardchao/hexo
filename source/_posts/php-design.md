---
title: php设计模式之观察者模式
date: 2020-05-24 14:19:00
top: 111
tags: Pattern
---


> 定义： 当一个对象的状态发生改变时，依赖他的对象会全部收到通知，并自动更新
> 场景:一个事件发生后,要执行一连串更新操作.
  <!-- more -->

# 优点
```
观察者模式更多体现了两个独立的类利用接口完成一件本应该很复杂的事情。不利用主题类的话，我们还需要不断循环创建实例，执行操作。而现在只需要创建实例就好，执行操作的事儿只需要调用一次通知的方法就好啦
```

# 代码
```
/**
 * 事件产生类
 * Class EventGenerator
 */
abstract class EventGenerator
{
    private $ObServers = [];

    //增加观察者
    public function add(ObServer $ObServer)
    {
        $this->ObServers[] = $ObServer;
    }

    //事件通知
    public function notify()
    {
        foreach ($this->ObServers as $ObServer) {
            $ObServer->update();
        }
    }

}

/**
 * 观察者接口类
 * Interface ObServer
 */
interface ObServer
{
    public function update($event_info = null);
}

/**
 * 观察者1
 */
class ObServer1 implements ObServer
{
    public function update($event_info = null)
    {
        echo "观察者1 收到执行通知 执行完毕！\n";
    }
}

/**
 * 观察者2
 */
class ObServer2 implements ObServer
{
    public function update($event_info = null)
    {
        echo "观察者2 收到执行通知 执行完毕！\n";
    }
}

/**
 * 事件
 * Class Event
 */
class Event extends EventGenerator
{
    /**
     * 触发事件
     */
    public function trigger()
    {
        //通知观察者
        $this->notify();
    }
}

//创建一个事件
$event = new Event();
//为事件增加旁观者
$event->add(new ObServer1());
$event->add(new ObServer2());
//执行事件 通知旁观者
$event->trigger();
```

# spl扩展

 ## 示意图

<img src="https://img-blog.csdn.net/20180916211836377?watermark/2/text/aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3poYW5nX3JlZmVyZWU=/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70" />

  ##  用于观察者设计模式的3个SPL接口/类
```
SplSubject
SplObserver
SplObjectStorage
```
 ## 实现
 ```

<?php

class Article implements SplSubject{

    public $has_update;
    public $has_comments;

    protected $observers = null;

    public function __construct(){

        $this->observers = new SplObjectStorage();

    }

    public function has_update($updated = false,$comments = true){

        $this->has_update = $updated;
        $this->has_comments = $comments;
        $this->notify();

    }
    //绑定观察者
    public function attach(SplObserver $observer){

        $this->observers->attach($observer);

    }
    //解除观察者
    public function detach(SplObserver $observer){

        $this->observers->detach($observer);

    }
    //发送通知
    public function notify(){

        $this->observers->rewind();
        //当前迭代项无效终止循环，也可以写成foreach
        // while($this->observers->valid()){

        //     $observer = $this->observers->current();
        //     $observer->update($this);
        //     $this->observers->next();  //指针往后移

        // }
        // 
        foreach($this->observers as $observer){

            $observer->update($this);

        }

    }

}


class ContentUpdateSubscribe implements SplObserver{

    public function update(SplSubject $subject){

        if($subject->has_update){

            echo "您订阅的文章有新动态哦<br/>";

        }

    }

}


class CommentsUpdateSubscribe implements SplObserver{

    public function update(SplSubject $subject){

        if($subject->has_comments){

            echo "您关注的文章有新评论哦<br/>";

        }

    }

}

$article_1 = new Article();
$article_1->attach(new ContentUpdateSubscribe());
$article_1->attach(new CommentsUpdateSubscribe());
$article_1->has_update(true,true);
 ```

 # 个人理解
 ```
 观察者模式的顺序为创建事件，为事件添加观察者，然后执行事件并通知旁观者，注意观察者不止一位，其核心在于把观察者从主体中分离开来，当主体知道事件发生时，观察需要被通知到，同时我们也不想把主体和观察者之间的关系写死。
 ```
# 参考链接
1.https://www.cnblogs.com/onephp/p/6108344.html
2.https://learnku.com/docs/php-design-patterns/2018/Observer/1513
3.https://blog.csdn.net/zhang_referee/article/details/82729540
