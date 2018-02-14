Notifier
========

This repository demonstrates the usage of Codeception Extension API.
Check it's source code to write your own extensions.

## Notification Extensions for Codeception

Extensions from this package that can be included in Codeception to receive notification of test results.

**This notifications are limited to just a few basic examples. It is recommended to get it forked and patched for your actual needs.**

Notifcation are made via [notificatior](https://github.com/namshi/notificator) library by [NAMSHI](https://github.com/namshi/).

## Installation

Install this package

```
composer require codeception/notifier --dev
```

Enable extensions in `codeception.yml` configuration:

Sample:

``` yaml
paths:
    tests: tests
    log: tests/_log
    data: tests/_data
    helpers: tests/_helpers
extensions:
    enabled:
      # enable ubuntu notifications
      - Codeception\Extension\UbuntuNotifier # extension class name
      
      # enable email notifications
      - Codeception\Extension\EmailNotifier:
          email: tests@company.com

```

## Ubuntu Notifications

Class: **Codeception\Extension\UbuntuNotifier**.

A basic `notify-send` wrapper of Notificator can be used to send notifications in Ubuntu.
Done via notificator's NotifySend handler.

Can be dynamically started (without adding to config) by providing `--ext UbuntuNotifier` option:

```
./vendor/bin/codecept run --ext UbuntuNotifier
```

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
