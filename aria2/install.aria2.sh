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
wget 
wget
wget
wget 

# 增加执行权限
chmod +x clean.sh
chmod +x delete.sh
chmod +x aa
cp aa /usr/sbin