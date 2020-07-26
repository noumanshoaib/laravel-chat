### How to install


* clone the project
* type composer install, then create your .env, fill the database credentials as well as pusher, you have to update /resources/js/app.js too with pusher app key and cluster.. 
* enter following command

```
php artisan key:generate

//then type

php artisan config:cache

then 

php artisan migrate

then 

php artisan db:seed
```


it will generate 4 users - 2 admin and 2 client.

admins username:

admin@gmail.com

admin2@gmail.com


client usernames:

nouman@gmail.com
test_user@gmail.com 

password is  12345678 for all of them.


at the end hit

php artisan serve.


you can use my pusher keys too which is already there no need to change anything except db strings.

PUSHER_APP_ID=1043217
PUSHER_APP_KEY=c0e83590d4f9648c3ce2
PUSHER_APP_SECRET=f5830898be9f996540e7
PUSHER_APP_CLUSTER=ap2


also change broadcast driver to pusher.