FROM mysql:8.0.18

ENV MYSQL_DATABASE facility-dev

COPY ./database/*.sql /docker-entrypoint-initdb.d/
