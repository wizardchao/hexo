---
title: php7dockerfile制作
date: 2020-02-18 23:07:47
tags: docker
top: 1002
---

> 本文将介绍php7.4在apache下的搭建工作及dockerfile编写

 <!-- more -->

 # dockerfile制作
 ## dockerfile内容

 ```
 #基于ubuntu镜像
FROM ubuntu

#维护人的信息
MAINTAINER The ubuntu Project <kevin@wizarchao.com.cn>

#安装apt软件包
RUN apt-get update -y
RUN apt-get install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php 
CMD []
RUN apt-get update -y
RUN apt-get install php7.4 php7.4-fpm php7.4-mysql php7.4-gd php7.4-mbstring php7.4-curl php7.4-zip -y
RUN apt install libapache2-mod-php7.4 -y
RUN a2enmod php7.4
RUN apt-get install wget -y
RUN wget https://getcomposer.org/composer.phar
RUN mv composer.phar composer
RUN chmod +x composer
RUN  apt-get install sudo -y
RUN sudo mv composer /usr/local/bin 

RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
RUN apt-get install apache2 -y 
RUN apt-get install vim -y
#复制该脚本至镜像中，并修改其权限
ADD install.sh /install.sh
RUN chmod 775 /install.sh

#开启80端口
EXPOSE 80

#当启动容器时执行的脚本文件
CMD ["./install.sh"]
 ```

 ## install.sh
```
#!/bin/bash
service apache2 start
php -v
/bin/bash	
```
## 运行命令
```
docker build -t apache .
```
# docker-compose
## 文件内容
```
version: '3.0'
services:
 apache:
    image: "demo"
    tty: true
    ports:
     - "8777:80"
    volumes:
     - /Users/wanchao/docker:/var/www/html
```
## 运行命令
```
docker-compose up -d
```
# 参考链接
1. https://segmentfault.com/a/1190000018210280
2. https://blog.csdn.net/qq_35049196/article/details/79038189


