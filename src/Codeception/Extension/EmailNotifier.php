<?php
namespace Codeception\Extension;

use Namshi\Notificator\Notification\Handler\Email as EmailHandler;
use Namshi\Notificator\Manager;
use Namshi\Notificator\Notification\Email\EmailNotificationInterface;
use Namshi\Notificator\Notification\Email\EmailNotification;
use Namshi\Notificator\Notification\NotifySend\NotifySendNotification;
use Namshi\Notificator\NotificationInterface;

class SimpleEmailHandler extends EmailHandler
{    
    public function handle(NotificationInterface $notification)
    {
        mail($notification->getRecipientAddress(), $notification->subject, $notification->body);
    }
}

class SimpleEmailNotification extends EmailNotification implements EmailNotificationInterface
{
    public $subject;
    public $body;
    
    public function __construct($recipientAddress, $subject, $body, array $parameters = array())
    {
        parent::__construct($recipientAddress, $parameters);
        
        $this->subject  = $subject;
        $this->body     = $body;
    }
}

class EmailNotifier extends \Codeception\Platform\Extension {

  static $events = array('result.print.after' => 'notify');

  function notify($event)
  {
    $result = $event->getResult();
    $failed = $result->failureCount() or $result->errorCount();

    // print_r($this->config);
    if (!isset($this->config['email'])) 
      throw new \Codeception\Exception\Extension(__CLASS__, 'email option is required');
    $email = $this->config['email'];

    $status = $failed ? 'FAILED' : 'PASSED';
    $print = $event->getPrinter()->printResult($result);

    // create the manager and assign the handler to it
    $manager = new Manager();
    $manager->addHandler(new SimpleEmailHandler());
    $notification = new SimpleEmailNotification($email, "Codeception tests $status", $print);

    $manager->trigger($notification);
  }
}  
