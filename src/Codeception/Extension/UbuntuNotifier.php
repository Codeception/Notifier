<?php
require_once __DIR__.'/../../../vendor/autoload.php';

namespace Codeception\Extension;

use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;

class UbuntuNotifier extends Codeception\Platform\Extension {

  static $events = ['result.print.after' => 'notify'];

  function notify($event)
  {
    $result = $event->getResult();
    $failed = $result->failureCount() or $result->errorCount();

    $handler = new NotifySendHandler();
    // create the manager and assign the handler to it
    $manager = new Manager();
    $manager->addHandler($handler);

    if ($failed) {      
      $notification = new NotifySendNotification("Codeception\nTests failed");
    } else {
      $notification = new NotifySendNotification("Codeception\nTests passed");
    }
    //  trigger the notification
    $manager->trigger($notification);

  }

}