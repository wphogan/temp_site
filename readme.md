#Basic WordPress / PhpMyAdmin / MariaDB Docker setup 

### https://www.digitalocean.com/community/tutorials/how-to-install-wordpress-and-phpmyadmin-with-docker-compose-on-ubuntu-14-04

### Commands:
Stop containers:
`docker-compose stop`

Detached continer:
`docker-compose up -d`

Update container locally
`docker pull wphogan/docker-wordpress-wpcli-xdebug`

Access bash of container:
`docker exec -it wp-wpcli-xdebug  bash`

Kill all containers:
`docker kill $(docker ps -q)`

Remove all containers:
`docker rm $(docker ps -a -q)`

Remove all docker images: 
` docker rmi $(docker images -q)`

Fresh start: kill and remove EVERYTHING 
`docker kill $(docker ps -q) && docker rm $(docker ps -a -q) && docker rmi $(docker images -q)`

Stop specific container:

```
docker pull mysql
docker stop my-mysql-container
docker rm my-mysql-container
docker run --name=my-mysql-container --restart=always \
  -e MYSQL_ROOT_PASSWORD=mypwd -v /my/data/dir:/var/lib/mysql -d mysql
  ```

Show running containers:
`docker ps`

Show all containers:
`docker ps -a`

Enter a container:
`docker exec -it my-app-container-id bash`

Note: for wp-cli to work, must have wp-su.sh file in the root dir of Dockerfile (local-side, not docker-side)