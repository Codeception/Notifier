Notifier
========

This repository demonstrates the usage of Codeception Extension API.
Check it's source code to write your own extensions.

## Notification Extensions for Codeception

Extensions from this package that can be included in Codeception >= 1.6.4 to receive notification of test results.
**This notifications are limited to just a few basic examples. It is recommended to get it forked and patched for your actual needs.**

Notifcation are made via [notificatior](https://github.com/namshi/notificator) library by [NAMSHI](https://github.com/namshi/).

## Installation

1. Install [Codeception](http://codeception.com) via Composer
2. Add  `codeception/notifier: "*"` to your `composer.json`
3. Run `composer install`.
4. Include extensions into `codeception.yml` configuration:

Sample:

``` yaml
paths:
    tests: tests
    log: tests/_log
    data: tests/_data
    helpers: tests/_helpers
extensions:
    enabled:
      - Codeception\Extension\UbuntuNotifier # extension class name
      - Codeception\Extension\EmailNotifier
    config:
      Codeception\Extension\EmailNotifier: # per extension config
          email: tests@company.com

```

## Ubuntu Notifications

Class: **Codeception\Extension\UbuntuNotifier**.

A basic `notify-send` wrapper of Notificator can be used to send notifications in Ubuntu.
Done via notificator's NotifySend handler.

## Email Notification

Class: **Codeception\Extension\EmailNotifier**

Unlike Ubuntu Notification this extension also takes extra parameter from config `codeception.yml`:

``` yaml

extensions:
  - Codeception\Extension\EmailNotifier:
      address: tests@company.com  

```

This email will be used to send notifications.

-----
