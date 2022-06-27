#!/bin/bash

docker exec -i rhea_mysql_1 mysql -uroot -prhea1 rhea-dev < "CREATE DATABASE IF NOT EXISTS `facility-dev`;";

SCRIPT_PATH=$(dirname $(realpath -s $0))
for SQL in $SCRIPT_PATH/facility-mysql/database/*.sql; do docker exec -i rhea_mysql_1 mysql -uroot -prhea1 facility-dev < $SQL; done
