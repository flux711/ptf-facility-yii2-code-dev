#!/bin/bash

sudo docker exec -i rhea_mysql_1 mysql -uroot -prhea1 rhea-dev < ./facility-mysql/database/.
