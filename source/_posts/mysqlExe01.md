---
title: 牛客网SQL练习（一）
date: 2019-02-23 20:17:05
tags: Mysql
---

> 最近感觉Mysql这块有点薄弱，正好牛客网上有这方面的练习，所以拿来练练。

> 此为第一篇。
<!-- more -->

## 查找最晚入职员工的所有信息

### 题目描述
```
CREATE TABLE `employees` (
`emp_no` int(11) NOT NULL,
`birth_date` date NOT NULL,
`first_name` varchar(14) NOT NULL,
`last_name` varchar(16) NOT NULL,
`gender` char(1) NOT NULL,
`hire_date` date NOT NULL,
PRIMARY KEY (`emp_no`));
```

### 标准输出
  ```
  emp_no | birth_date | first_name | last_name | gender | hire_date
  ```

### 解答
```
select `emp_no`,`birth_date`,`first_name`,`last_name`,`gender`,`hire_date` from `employees` order by `hire_date` desc limit 1;
```
### 题目链接
```
https://www.nowcoder.com/practice/218ae58dfdcd4af195fff264e062138f?tpId=82&tqId=29753&tPage=1&rp=&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 查找入职员工时间排名倒数第三的员工所有信息

### 题目描述

```
CREATE TABLE `employees` (
`emp_no` int(11) NOT NULL,
`birth_date` date NOT NULL,
`first_name` varchar(14) NOT NULL,
`last_name` varchar(16) NOT NULL,
`gender` char(1) NOT NULL,
`hire_date` date NOT NULL,
PRIMARY KEY (`emp_no`));
```

### 标准输出

  ```
  emp_no | birth_date | first_name | last_name | gender | hire_date
  ```

### 解答

```
select `emp_no`,`birth_date`,`first_name`,`last_name`,`gender`,`hire_date` from `employees` order by `hire_date` desc limit 2,1;
```

### 题目链接
```
https://www.nowcoder.com/practice/ec1ca44c62c14ceb990c3c40def1ec6c?tpId=82&tqId=29754&tPage=1&rp=&ru=%2Fta%2Fsql&qru=%2Fta%2Fsql%2Fquestion-ranking
```


## 查找各个部门当前(to_date='9999-01-01')领导当前薪水详情以及其对应部门编号dept_no
### 题目描述
```
CREATE TABLE `dept_manager` (
`dept_no` char(4) NOT NULL,
`emp_no` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));
CREATE TABLE `salaries` (
`emp_no` int(11) NOT NULL,
`salary` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`from_date`));
```

### 标准输出
```
emp_no | salary | from_date | to_date | dept_no
```

### 解答

> select s.`emp_no`,s.`salary`,s.`from_date`,s.`to_date`,d.`dept_no`
>  from `salaries` s inner join `dept_manager` d 
> on d.`emp_no` = s.`emp_no`
>  where d.`to_date` ='9999-01-01' and s.`to_date` ='9999-01-01';

### 题目链接
```
https://www.nowcoder.com/practice/c63c5b54d86e4c6d880e4834bfd70c3b?tpId=82&tqId=29755&tPage=1&rp=&ru=/ta/sql&qru=/ta/sql/question-ranking
```


## 查找所有已经分配部门的员工的last_name和first_name

### 题目描述

```
CREATE TABLE `dept_emp` (
`emp_no` int(11) NOT NULL,
`dept_no` char(4) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));
CREATE TABLE `employees` (
`emp_no` int(11) NOT NULL,
`birth_date` date NOT NULL,
`first_name` varchar(14) NOT NULL,
`last_name` varchar(16) NOT NULL,
`gender` char(1) NOT NULL,
`hire_date` date NOT NULL,
PRIMARY KEY (`emp_no`));
```

### 标准输出
```
last_name | first_name | dept_no
```

### 解答
> select e.`last_name`,e.`first_name`,d.`dept_no`
> from `employees` e
> inner join `dept_emp` d 
> on e.`emp_no` = d.`emp_no`;


### 题目链接
```
https://www.nowcoder.com/practice/6d35b1cd593545ab985a68cd86f28671?tpId=82&tqId=29756&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 查找所有员工的last_name和first_name以及对应部门编号

### 题目描述
```
CREATE TABLE `dept_emp` (
`emp_no` int(11) NOT NULL,
`dept_no` char(4) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));
CREATE TABLE `employees` (
`emp_no` int(11) NOT NULL,
`birth_date` date NOT NULL,
`first_name` varchar(14) NOT NULL,
`last_name` varchar(16) NOT NULL,
`gender` char(1) NOT NULL,
`hire_date` date NOT NULL,
PRIMARY KEY (`emp_no`));
```

### 标准输出
```
last_name | first_name | dept_no
```

### 解答

> select e.`last_name`,e.`first_name`,d.`dept_no`
>  from `employees` e 
> left join `dept_emp` d 
> on d.`emp_no` = e.`emp_no`;

### 题目链接
```
https://www.nowcoder.com/practice/dbfafafb2ee2482aa390645abd4463bf?tpId=82&tqId=29757&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 查找所有员工入职时候的薪水情况，给出emp_no以及salary， 并按照emp_no进行逆序

### 题目描述
```
CREATE TABLE `employees` (
`emp_no` int(11) NOT NULL,
`birth_date` date NOT NULL,
`first_name` varchar(14) NOT NULL,
`last_name` varchar(16) NOT NULL,
`gender` char(1) NOT NULL,
`hire_date` date NOT NULL,
PRIMARY KEY (`emp_no`));
CREATE TABLE `salaries` (
`emp_no` int(11) NOT NULL,
`salary` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`from_date`));
```
### 标准输出
```
emp_no | salary
```

### 解答
> select e.`emp_no`,s.`salary` from `employees` e 
> left join `salaries` s on s.`emp_no` = e.`emp_no` 
> where e.`hire_date` = s.`from_date` 
> order by e.`emp_no` desc;


### 题目链接
```
https://www.nowcoder.com/practice/23142e7a23e4480781a3b978b5e0f33a?tpId=82&tqId=29758&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 查找薪水涨幅超过15次的员工号emp_no以及其对应的涨幅次数t

### 题目描述
```
CREATE TABLE `salaries` (
`emp_no` int(11) NOT NULL,
`salary` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`from_date`));
```

### 标准输出
```
emp_no |  t
```

### 解答
> select `emp_no`, count(`emp_no`) as `t` 
> from `salaries` 
> group by `emp_no` 
> having t >=15;


### 题目链接
```
https://www.nowcoder.com/practice/23142e7a23e4480781a3b978b5e0f33a?tpId=82&tqId=29758&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```


## 找出所有员工当前(to_date='9999-01-01')具体的薪水salary情况，对于相同的薪水只显示一次,并按照逆序显示

### 题目描述
```
CREATE TABLE `salaries` (
`emp_no` int(11) NOT NULL,
`salary` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`from_date`));
```

### 标准输出
```
slary
```

### 解答
> select distinct `salary` from `salaries` 
>  where `to_date` ='9999-01-01' 
> order by `salary` desc;


### 题目链接
```
https://www.nowcoder.com/practice/ae51e6d057c94f6d891735a48d1c2397?tpId=82&tqId=29760&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```


## 获取所有部门当前manager的当前薪水情况，给出dept_no, emp_no以及salary，当前表示to_date='9999-01-01'

### 题目描述
```
CREATE TABLE `dept_manager` (
`dept_no` char(4) NOT NULL,
`emp_no` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));
CREATE TABLE `salaries` (
`emp_no` int(11) NOT NULL,
`salary` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`from_date`));
```

### 标准输出
```
dept_no | emp_no | salary
```

### 解答
> select d.`dept_no`,d.`emp_no`,s.`salary` 
> from `dept_manager` d 
> left join `salaries` s on s.`emp_no` = d.`emp_no` 
>  where s.`to_date`='9999-01-01' and d.`to_date` ='9999-01-01';

### 题目链接
```
https://www.nowcoder.com/practice/4c8b4a10ca5b44189e411107e1d8bec1?tpId=82&tqId=29761&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 获取所有非manager的员工emp_no
### 题目描述
```
CREATE TABLE `dept_manager` (
`dept_no` char(4) NOT NULL,
`emp_no` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));
CREATE TABLE `employees` (
`emp_no` int(11) NOT NULL,
`birth_date` date NOT NULL,
`first_name` varchar(14) NOT NULL,
`last_name` varchar(16) NOT NULL,
`gender` char(1) NOT NULL,
`hire_date` date NOT NULL,
PRIMARY KEY (`emp_no`));
```
### 标准输出
```
emp_no
```
### 解答

> select `emp_no` from `employees`
> where `emp_no` not in 
> (select `emp_no` from `dept_manager`);


### 题目链接
```
https://www.nowcoder.com/practice/32c53d06443346f4a2f2ca733c19660c?tpId=82&tqId=29762&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 获取所有员工当前的manager
### 题目描述
```
获取所有员工当前的manager，如果当前的manager是自己的话结果不显示，当前表示to_date='9999-01-01'。
结果第一列给出当前员工的emp_no,第二列给出其manager对应的manager_no。

CREATE TABLE `dept_emp` (
`emp_no` int(11) NOT NULL,
`dept_no` char(4) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));
CREATE TABLE `dept_manager` (
`dept_no` char(4) NOT NULL,
`emp_no` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));
```

### 标准输出
```
emp_no | manager_no
```

### 解答
> select e.`emp_no`,m.`emp_no` as `manager_no` from `dept_emp` e 
> inner join `dept_manager` m on e.`dept_no` = m.`dept_no` 
> where m.`to_date` = '9999-01-01' and e.`emp_no` <>  m.`emp_no`; 


### 题目链接
```
https://www.nowcoder.com/practice/e50d92b8673a440ebdf3a517b5b37d62?tpId=82&tqId=29763&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 获取所有部门中当前员工薪水最高的相关信息
### 题目描述
```
CREATE TABLE `dept_emp` (
`emp_no` int(11) NOT NULL,
`dept_no` char(4) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`dept_no`));

CREATE TABLE `salaries` (
`emp_no` int(11) NOT NULL,
`salary` int(11) NOT NULL,
`from_date` date NOT NULL,
`to_date` date NOT NULL,
PRIMARY KEY (`emp_no`,`from_date`));
```

### 标准输出
```
dept_no | emp_no | salary
```

### 解答

> select d.`dept_no`,s.`emp_no`,max(s.`salary`)
> from `salaries` s 
> inner join `dept_emp` d 
> on d.`emp_no` = s.`emp_no` 
> where d.to_date='9999-01-01' and s.to_date='9999-01-01' 
> group by d.dept_no; 


### 题目链接
```
https://www.nowcoder.com/practice/4a052e3e1df5435880d4353eb18a91c6?tpId=82&tqId=29764&rp=0&ru=%2Fta%2Fsql&qru=%2Fta%2Fsql%2Fquestion-ranking&tPage=1
```

## 从titles表获取按照title进行分组
### 题目描述
```
CREATE TABLE IF NOT EXISTS "titles" (
`emp_no` int(11) NOT NULL,
`title` varchar(50) NOT NULL,
`from_date` date NOT NULL,
`to_date` date DEFAULT NULL);
```
### 标准输出
```
title
```

### 解答

> select title ,count(title) as t from titles 
> group by title 
> having t >=2;


### 题目链接
```
https://www.nowcoder.com/practice/72ca694734294dc78f513e147da7821e?tpId=82&tqId=29765&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```

## 从titles表获取按照title进行分组，每组个数大于等于2，给出title以及对应的数目t。注意对于重复的emp_no进行忽略。

### 题目描述
```
CREATE TABLE IF NOT EXISTS "titles" (
`emp_no` int(11) NOT NULL,
`title` varchar(50) NOT NULL,
`from_date` date NOT NULL,
`to_date` date DEFAULT NULL);
```
### 标准输出
```
title | t
```
### 解答

> select title,count(DISTINCT emp_no) as t from titles
> group by title having t>=2;

### 题目链接
```
https://www.nowcoder.com/practice/c59b452f420c47f48d9c86d69efdff20?tpId=82&tqId=29766&rp=0&ru=/ta/sql&qru=/ta/sql/question-ranking
```