#!/bin/bash

docker cp facility-mysql/database/. rhea_mysql_1:/docker-entrypoint-initdb.d
