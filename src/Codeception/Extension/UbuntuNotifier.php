<?php
namespace Codeception\Extension;

use Namshi\Notificator\Notification\Handler\NotifySend as NotifySendHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;
use Symfony\Component\Process\ExecutableFinder;

class UbuntuNotifier extends \Codeception\Platform\Extension {

    static $events = array('result.print.after' => 'notify');

    function notify($event)
    {
        $result = $event->getResult();
        $failed = $result->failureCount() or $result->errorCount();

        $manager = new Manager();
        $manager->addHandler(new NotifySendHandler(new ExecutableFinder()));

        $notification = new NotifySendNotification("Codeception Tests " .($failed ? "FAILED" : "PASSED"));

        $manager->trigger($notification);

    }

}
