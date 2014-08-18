#!/bin/bash

proj_name="PhpDemo"
current_tag="dev-0.0.1"
pack_time=`date +%Y%m%d%H%M`
pack_name="$proj_name-$current_tag-$pack_time"

echo $pack_name

#将需要打包的文件copy到pack_name目录里头
mkdir -p $pack_name/

exclude_list=('test/' 'spider/' 'pack' 'logs/*' 'cache/*')
exclude="--exclude=.* --exclude=$pack_name"
for patt in ${exclude_list[*]}; do
	exclude+=" --exclude=$patt"
done
rsync -a $exclude ./* $pack_name/

# 测试包
[[ $current_tag =~ ^dev-.* ]] && mv $pack_name/config/config.php $pack_name/config/config.php
# 正式包
[[ $current_tag =~ ^release-.* ]] && mv $pack_name/config/config-release.php $pack_name/config/config.php

cd $pack_name
tar -czf $pack_name.tgz *

cd ..
mkdir -p package
mv $pack_name/$pack_name.tgz package
rm -rf $pack_name

exit 0