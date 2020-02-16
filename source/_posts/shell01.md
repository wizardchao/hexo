---
title: 常用Linux脚本
date: 2019-04-02 22:53:41
tags: Shell
---

> 本篇介绍一些常用脚本
> 以后会陆续更

 <!-- more -->

 ## SVN钩子
 ```
#!/bin/sh
REPOS="$1"
REV="$2"
DIR='路径地址'
export LANG=en_US.UTF-8
CURDATE='date'
echo "Code Deployed By at $CURDATE,$REPOS,$REV" >> /var/log/svn.log ## 写入日志
svn update $DIR --username 账号 --password 密码
 ```

## Mysql备份
```
#!/bin/bash
# 数据库认证
user="root"
password="PASSWORD"
host=“127.0.0.1”
db_name="DBNAME"
# 其它
backup_path="备份地址"
date=$(date +"%d-%b-%Y")
# 设置导出文件的缺省权限
umask 177
# Dump数据库到SQL文件
mysqldump --user=$user --password=$password --host=$host $db_name > $backup_path/$db_name-$date.sql
```

## iterm下服务器自动登录
```
#!/usr/bin/expect -f
set user 账号
set host IP
set password 密码
set port 22
set timeout -1

spawn ssh -p $port $user@$host
expect "*assword:*"
send "$password\r"
interact
expect eof
```