<?php
namespace Codeception\Extension;

require_once __DIR__.'/../../../vendor/autoload.php';

use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;

class UbuntuNotifier extends \Codeception\Platform\Extension {

    static $events = array('result.print.after' => 'notify');

    function notify($event)
    {
        $result = $event->getResult();
        $failed = $result->failureCount() or $result->errorCount();

        $manager = new Manager();
        $manager->addHandler(new NotifySendHandler());

        if ($failed) {      
          $notification = new NotifySendNotification("Codeception Tests FAILED");
        } else {
          $notification = new NotifySendNotification("Codeception Tests PASSED");
        }

        $manager->trigger($notification);

    }

}