# TimeFragment

[![Build Status](https://travis-ci.org/Luxurioust/timefragment.svg?branch=master)](https://travis-ci.org/Luxurioust/timefragment) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Luxurioust/timefragment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Luxurioust/timefragment/?branch=master) [![Join the chat at https://gitter.im/Luxurioust/timefragment](https://img.shields.io/badge/GITTER-join%20chat-green.svg)](https://gitter.im/Luxurioust/timefragment) [![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://github.com/Luxurioust/timefragment/blob/master/LICENSE)

- This project base on the Laravel Framework.
  - Route, Filter
  - Eloquent ORM, paging, searching, sorting
  - Controller, blade
  - Mail Server
  - Auth Class
  - Validator Class

- Require
  - laravel/framework
  - intervention/image
  - yzalis/identicon
  - michelf/php-markdown
  - nickcernis/html-to-markdown

- Debug
  - barryvdh/laravel-debugbar
  - five-say/vendor-cleaner

### Protect Personal Info

```
git update-index --assume-unchanged app/config/app.php
git update-index --no-assume-unchanged app/config/app.php

git update-index --assume-unchanged public/.htaccess
git update-index --no-assume-unchanged public/.htaccess

git update-index --assume-unchanged app/config/mail.php
git update-index --no-assume-unchanged app/config/mail.php

git update-index --assume-unchanged app/api/qq/comm/inc.php
git update-index --no-assume-unchanged app/api/qq/comm/inc.php

git update-index --assume-unchanged app/api/weibo/config.php
git update-index --no-assume-unchanged app/api/weibo/config.php

git update-index --assume-unchanged app/api/alipay/alipay.config.php
git update-index --no-assume-unchanged app/api/alipay/alipay.config.php
```

### Preview
![TimeFragment](/public/readme/preview.jpg "TimeFragment")

[More Info](http://xuri.me/2014/03/08/timefragment.html)

### Licenses

This program is under the terms of the MIT license. See [LICENSE](https://github.com/Luxurioust/timefragment/blob/master/LICENSE) for the full license text.