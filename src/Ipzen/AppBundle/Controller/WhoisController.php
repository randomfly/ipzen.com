<?php

namespace Ipzen\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class WhoisController extends Controller
{

	const COMMAND_LINE = 'whois';
	const SUPPRESS_HISTORY = '-H';
	const REGEX_REMOVE_EXTRA_LINES = '/(\r\n|\n|\t)\1+/';
	const REGEX_REMOVE_FIRST_LINE = '/^(\n)/';


	/**
	 * Will return the whois query for the resquested domain by directly using a unix command.
	 * 
     * @Route("/whois/{domain}")
     */
	public function searchAction() {

		// penser à faire des vérifs sur l'input domain
		$domain = $_POST['domain'];
		$cmd = self::COMMAND_LINE . " " . $domain . " " . self::SUPPRESS_HISTORY;
		$handle = popen($cmd, 'r');
		$return_value = "";
		while( !feof($handle) ){
			$return_value = $return_value . "\n" . fgets($handle);
			ob_flush();
			flush();
		}
		pclose($handle);
		$result = preg_replace(self::REGEX_REMOVE_EXTRA_LINES, '$1', $return_value);
		$result = '<strong><u>WHOIS RESPONSE</u> : ' . $domain . "</strong>" . nl2br($result);

		return $this->render('IpzenAppBundle:Default:whois.html.twig', array('error' => null, 'whois' => $result));;
	}
}