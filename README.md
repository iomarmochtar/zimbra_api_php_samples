This is just a sample using zimbra API in PHP as [my previous sample (gist)](https://gist.github.com/iomarmochtar/7c2b7fc5ae11aeb0c683c52d8b25145c) is designed for Yii2.

Setup
-----

make sure you have php-cli version 7 and composer installed.

- install dependencies
```
composer install
```

- copy sample configuration and adjust with your environment.
```
cp env.sample .env
vim .env
```

Running
-------

**Note:** 
- If you want execute all the script make sure to run `create_user.php` in the first and `delete_user.php` in the last.
- Make sure the cos as set in `SAMPLE_COS` is already exists

you can run directly in command line, example:
```
php is_user_exists.php
```

