---
title: ubuntu安装nginx
date: 2019-04-17 09:26:14
tags: nginx
---

> 一直想尝试下Nginx,看了下网上骚操作也是蛮多的，特地记下来

 <!-- more -->

# 更新源
  ```
sudo apt-add-repository ppa:nginx/stable
sudo apt-add-repository ppa:ondrej/php
sudo apt update
  ```

  如果提示apt-add-repository找不到可以
  ```
  apt-get install python-software-properties
  apt-get install software-properties-common
  ```

# nginx
## 安装
```
sudo apt install nginx
```
## 启动
### 测试配置
```
nginx -t
```
### 重启
```
nginx -s reload
```
如果报错
```
nginx -c /etc/nginx/nginx.conf
```

## php-fpm7.0
```
sudo apt install php7.0-fpm
service php7.0-fpm restart
```


# 参考链接
1. https://www.cnblogs.com/ddling/p/5906109.html