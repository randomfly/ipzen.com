<?php

namespace Ipzen\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/")
     * Homepage to the application
     */
    public function indexAction() {
        if ( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ) { 
            return $this->render('IpzenAppBundle:Default:index.html.twig', array('error' => null));
        } else {
            return $this->render('IpzenAppBundle:Security:login.html.twig', array('last_username' => "",'error' => null));
        }
    }
    /**
     * @Route("/admin")
     * Access to the administration interface
     */
    public function adminAction() {
        if ( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ) {
            return $this->render('IpzenAppBundle:Default:admin.html.twig', array('error' => null)); // needs to be done
        } else {
            return $this->render('IpzenAppBundle:Security:login.html.twig', array('last_username' => "",'error' => null));
        }
    }

    /**
     * @Route("/admin")
     * Access to the administration interface
     */
    public function profileAction() {
        if ( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ) {
            return $this->render('IpzenAppBundle:Default:profile.html.twig', array('error' => null)); // needs to be done
        } else {
            return $this->render('IpzenAppBundle:Security:login.html.twig', array('last_username' => "",'error' => null));
        }
    }

    /**
     * @Route("/whois")
     * Will lead to the basic whois search function
     * This includes the plain text format exclusively
     */
    public function whoisAction() {
        if ( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ) {
            return $this->render('IpzenAppBundle:Default:whois.html.twig', array('error' => null)); // needs to be done
        } else {
            return $this->render('IpzenAppBundle:Security:login.html.twig', array('last_username' => "",'error' => null));
        }
    }

    /**
     * @Route("/whois")
     * Will lead to the basic whois bulk search function
     * This includes various searches of availabiliity of a domain through various tlds
     * Many domains can be searched at a time (will be implemented shortly)
     */
    public function whois_bulkAction() {
        if ( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ) {
            return $this->render('IpzenAppBundle:Default:whois_bulk.html.twig', array('error' => null)); // needs to be done
        } else {
            return $this->render('IpzenAppBundle:Security:login.html.twig', array('last_username' => "",'error' => null));
        }
    }
}
