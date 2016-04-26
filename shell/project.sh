#!/bin/sh

PROJECT_ROOT=$1
echo "cd ${PROJECT_ROOT}" >> /home/vagrant/.bashrc

cd ${PROJECT_ROOT}
ant build
