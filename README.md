1. don't change init.php,run it just one time.
2. each directory denotes a table,write each operation in one file,such deleteToy.php.
3. create a new operation,only need to change $sql string sentence and console string after first $echo. 


### Email Server Configuration

A temp Google Mail account is registered for this project:

- Address: fly.group.cityu@gmail.com
- Password: nysqkbxyscfzktvu
- SMTP host: smtp.gmail.com
- SMTP Secure Protocol: tls
- SMTP port: 587

Normally, you do not have to modify these configurations. To use email services, you have to install a 3rd party library named `PHPMailer`.

First you need to install the php package manager `composer` in your OS(use homebrew for macOS, apt for linux, etc)：

```bash
$ brew install composer
```

and then use `composer` to install:

```bash
$ composer require phpmailer/phpmailer
```

In `utils/mail.php`, some functions are implemented to send emails to a specific user with specific content/subject. To use these functions, add:

```php
require 'utils/mail.php';
```

at the beginning. An example is shown below:

```php
<?php
...
    # send your own email
    $to = 'yongze_yang@outlook.com';
    $subject = 'your title here';
    $body = 'your content here';
    sendEmail($to, $subject, $body);
    # or send predefined email
    sendVerficationEmailCode('yongze_yang@outlook.com', 123456);
    sendWelcomeEmail('yongze_yang@outlook.com');
?>
```