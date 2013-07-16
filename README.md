Notifier
========

Notification Extension for Codeception

Sample extensions that can be included in Codeception >= 1.6.4 to notify of tests result.
Uses [notificatior](https://github.com/namshi/notificator) library by NAMSHI.

## Installation

1. Install [Codeception](http://codeception.com) via Composer
2. Install this repo via Composer
2. Edit `codeception.yml`
3. Add: `extensions: [EmailNotifier, UbuntuNotifier]` into it.

## Ubuntu Notifications

A basic `notify-send` wrapper of Notificator can be used to send notifications in Ubuntu.
Please see `UbuntuNotifier` class If you are running tests on your Ubuntu machine.

## Email Notification

Unlike Ubuntu Notification this extension also takes a parameter from config `codeception.yml`:

``` yaml

extensions: [EmailNotifier]
EmailNotifier: 
  address: tests@company.com

```

This will be used to send notifications.