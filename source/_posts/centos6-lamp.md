---
title: Centos6.8搭建lamp环境
date: 2019-01-23 15:10:32
tags:
 - Centos
 - LAMP
---

> Centos6.8也是服务器标配，这里重点介绍怎样搭建lamp环境的步骤。
> 老规矩，有空再更！

<!-- more -->

## Apache

### 安装

```
sudo yum install httpd -y
```

### 开启

```
service httpd start
```

## PHP

### 更新源

```
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm
```

### 安装扩展

```
yum  install epel-release
yum install libmcrypt libmcrypt-devel mcrypt mhash
```

### 安装PHP7.0

```
yum -y install php70w php70w-fpm php70w-mysql php70w-mbstring php70w-mcrypt php70w-gd php70w-imap php70w-ldap php70w-odbc php70w-pear php70w-xml php70w-xmlrpc php70w-pdo php70w-apcu php70w-pecl-redis php70w-pecl-memcached php70w-devel
```

### 查看版本及扩展
```
php -v
php -m
```

## mysql

### 下载源文件

```
wget https://dev.mysql.com/get/mysql57-community-release-el6-9.noarch.rpm
```

### 配置rpm
```
rpm -Uvh mysql57-community-release-el6-9.noarch.rpm 
```

或者(推荐)

```
yum localinstall -y mysql57-community-release-el6-9.noarch.rpm   
```

### 安装
```
yum install mysql-community-server
```

### 开启

```
service mysqld start
```

### 查看密码

```
grep 'temporary password' /var/log/mysqld.log
```

### 修改

```
mysql -u root -p
//输入密码
 ALTER USER 'root'@'localhost' IDENTIFIED BY 'MyNewPass4!';
```

## 后续
重启apache,lamp环境即安装完毕，后续服务器端口开放等不再涉及，以上命令均在centos6.8上测试通过！

参考链接：
1. https://www.cnblogs.com/yoke/p/7257184.html
2. https://www.cnblogs.com/jimboi/p/6405560.html


