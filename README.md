<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Tech Assignment Setup Instructions

---

### Requirements

| Stack | Minimum Version |
|-------|-----------------|
| PHP   | 8.0             |

### Setup guide
- Clone the project and move to the directory
```console
foo@bar:~$ git clone https://github.com/nnikolaishvili/Recruitment.git Recruitment
foo@bar:~$ cd Recruitment
```
- Install dependencies
```console
foo@bar:~/Recruitment composer install
```
- Copy .env.example file into .env
```console
foo@bar:~/Recruitment cp .env.example .env
```
- Generate the application key
```console
foo@bar:~/Recruitment php artisan key:generate
```
- Install npm & compile the assets
```console
foo@bar:~/Recruitment npm install
foo@bar:~/Recruitment npm run dev
```
- Link the storage
```console
foo@bar:~/Recruitment php artisan storage:link
```
- Run migrations & seed the tables
```console
foo@bar:~/Recruitment php artisan migrate --seed
```

For running the server you can use the command
```console
foo@bar:~/Recruitment php artisan serve
```
### User's credentials that you can use to authenticate
| Email       | Password    |
|-------------|-------------|
| hr@test.com | password123 |

