#!/usr/bin/env bash
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH
set -euxo pipefail

# 安装 aria2
yum update -y && yum install aria2 -y

# 创建 aria2 配置文件目录
mkdir -p /root/.aria2 && cd /root/.aria2

# 新建 aria2 会话文件以及日志文件
touch aria2.session aria2.log

# 下载配置文件
wget https://cdn.jsdelivr.net/gh/Ryanjiena/Blog@master/aria2/aa
wget https://cdn.jsdelivr.net/gh/Ryanjiena/Blog@master/aria2/aria2.conf
wget https://cdn.jsdelivr.net/gh/Ryanjiena/Blog@master/aria2/clean.sh
wget https://cdn.jsdelivr.net/gh/Ryanjiena/Blog@master/aria2/delete.sh
wget https://cdn.jsdelivr.net/gh/Ryanjiena/Blog@master/aria2/dht.dat
wget https://cdn.jsdelivr.net/gh/Ryanjiena/Blog@master/aria2/dht6.dat

# 增加执行权限
chmod +x clean.sh
chmod +x delete.sh
chmod +x aa
cp aa /usr/sbin