## Devel docker image

**Project setup**

Set up variables in .env file. 

Place to /etc/hosts (replace $APP_HOST with value from .env): 
```
127.0.0.1 $APP_HOST.dev static.$APP_HOST.dev
```

### First run
All commands are expecting to start from this (./docker) directory as root directory:

**Build images**: 
```
docker-compose build
docker-compose up --no-start
```

**Install nodejs modules**: 
```
env $(cat .env | xargs) bash -c 'docker-compose run --rm --entrypoint npm "$IMAGE_NAME-node" install'
```

**Apply security fixes to modules (if you want)**: 
```
env $(cat .env | xargs) bash -c 'docker-compose run --rm --entrypoint npm "$IMAGE_NAME-node" audit fix'
```

**Start containers**:
```
docker-compose up -d
```

**Init composer**:
```
env $(cat .env | xargs) bash -c 'docker-compose exec -w /local/www $IMAGE_NAME composer install'
```

**Run initial migrations**: 
```
env $(cat .env | xargs) bash -c 'docker-compose exec -w /local/www $IMAGE_NAME php artisan migrate:refresh --seed'
```

**HTTPS**:

App is generating self-signed SSL certificate. You can do any of these steps:
1. Add CA cert docker/ssl/CA/ca.pem as thrusted to your system/browser
2. Open app page in a browser, oped details, select certificate and set it as thrusted
3. Replace CA cert in docker/ssl/CA to your own and rebuild Nginx image

## Usage
All commands are expecting to start from this (./docker) directory as root directory:

**Run detached**: docker-compose up -d

**Stop**: docker-compose stop

**Start again**: docker-compose start

## Email testing
SMTP service available on host mail:25 in the container.

Web UI available on 127.0.0.1:1080

## Troubleshooting

If you have problems with node container start - remove www/node_modules directory if exists and follow "Install node modules" step.