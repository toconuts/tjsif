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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of MemberController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member")
 */
class MemberController extends Controller
{
    /**
     * @Route("", name="member_index")
     */
    public function indexAction()
    {
//TODO: paesonary notification
        /*$this->addFlash(
                'danger',
                'Conglats! After login, you can access TJ-SIF 2016 member\'s site.'
        );*/
        
        return $this->render(
            'member/index.html.twig'
        );
    }
}
