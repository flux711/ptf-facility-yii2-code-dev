#!/bin/bash

docker cp facility-mysql/database/*.sql rhea_mysql_1:/docker-entrypoint-initdb.d
