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

        $manager = new Manager();
        $manager->addHandler(new NotifySendHandler(new ExecutableFinder()));

        $icon = '/usr/share/icons/gnome/48x48/emotes/';
        if ($result->errorCount() > 0) {
            $icon .= 'face-angry';
        } else if ($result->failureCount() > 0 ) {
            $icon .= 'face-sad';
        } else {
            $icon .= 'face-cool';
        }
        $icon .= '.png';

        $notification = new NotifySendNotification(
            "\"Codeception Tests results: ".
            $result->count(). " test where ".
            $result->failureCount()." failed, ".
            $result->errorCount()." errors, ".
            $result->skippedCount()." skyped, ".
            $result->notImplementedCount()." not implemented.\"",
            [
                '--urgency' => 'low',
                '--category' => 'testing',
                '--icon' => $icon
            ]
        );

        $manager->trigger($notification);
    }

}
