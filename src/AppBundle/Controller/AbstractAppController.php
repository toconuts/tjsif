<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Monolog\Logger;
use AppBundle\Entity\User;
use AppBundle\Entity\Notification;

/**
 * Description of AbstractAppController
 *
 * @author toconuts <toconuts@gmail.com>
 */
abstract class AbstractAppController extends Controller
{
    public function log($message, $level, $url = null)
    {
        $this->logger($message, $level);
        
        if ($level != Logger::DEBUG) {
            $this->flash($message, $level);
        }
        
        if ($level == Logger::NOTICE) {
            $this->notice($message, $url);
        }
    }
    
    protected function notice($message, $url)
    {
        $notification = new Notification($message, $url);
        $em = $this->getDoctrine()->getManager();
        $em->persist($notification);
        $em->flush();
    }
    
    protected function flash($message, $level)
    {
        $type = null;
        
        switch ($level) {
            case Logger::DEBUG:
                $type = null;
                break;
            case Logger::INFO:
                $type = "info";
                break;
            case Logger::NOTICE:
                $type = 'success';
                break;
            case Logger::WARNING:
                $type = 'warning';
                break;
            case Logger::ERROR:
            case Logger::CRITICAL:
            case Logger::ALERT:
            case Logger::EMERGENCY:
                $type = 'danger';
                break;
        }

        if ($type) {
            $this->addFlash($type, $message);
        }
        
    }
    
    protected function logger($message, $level)
    {
        $user = $this->getUser();       
        $message = $message . ' User ID: ' . $user->getId();

        $logger = $this->get('logger');
        switch ($level) {
            case Logger::DEBUG:
                $logger->debug($message);
                break;
            case Logger::INFO:
                $logger->info($message);
                break;
            case Logger::NOTICE:
                $logger->notice($message);
                break;
            case Logger::WARNING:
                $logger->warning($message);
                break;
            case Logger::ERROR:
                $logger->error($message);
                break;
            case Logger::CRITICAL:
                $logger->critical($message);
                break;
            case Logger::ALERT:
                $logger->alert($message);
                break;
            case Logger::EMERGENCY:
                $logger->emergency($message);
                break;
        }
    }
}
