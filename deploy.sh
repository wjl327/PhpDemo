#!/bin/bash

deploy_dir=$HOME/testing/PhpDemo
exclude_list=('test/' 'spider/' 'pack' 'logs/*' 'cache/*' 'deploy.sh')
exclude="--exclude=.*"
for patt in ${exclude_list[*]}; do
        exclude+=" --exclude=$patt"
done

mkdir -p $deploy_dir
rsync -a $exclude ./* $deploy_dir/
echo $deploy_dir
