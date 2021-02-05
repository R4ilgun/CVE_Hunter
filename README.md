# CVE_Hunter
A system to get CVE_POC from Github.

当时写的用python通过GitHub的api获取CVE的POC，然后php+mysql呈现出来。

前端用的是layui，后端其实没什么功能- -，写的着实比较垃圾...

需要注意几个问题:

1.login.php中判断登录，因为我比较懒，不想对username做过滤就直接判断是否为指定用户名，不是的话就exit()了。
2.数据库存在两个表，一个是cve_github存放POC的主要信息，另一个是user表，存放用户的主要信息。
![image](https://github.com/R4ilgun/CVE_Hunter/blob/main/readme_image/database_table.png)
