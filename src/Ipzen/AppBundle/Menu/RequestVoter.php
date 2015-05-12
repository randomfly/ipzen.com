<?php

namespace Ipzen\AppBundle\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * A voter is a special element that will detect which item from the menu was selected and display a slight change to help user navigation
 * @note : In this case the relevant button will remain active until next action on the menu is performed
 */
class RequestVoter implements VoterInterface {

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function matchItem(ItemInterface $item)
    {
    	if ($item->getUri() === $this->container->get('request')->getRequestUri()) {
    		// URL's completely match
            return true;
        } else if($item->getUri() !== $this->container->get('request')->getBaseUrl().'/' && (substr($this->container->get('request')->getRequestUri(), 0, strlen($item->getUri())) === $item->getUri())) {
        	// URL isn't just "/" and the first part of the URL match
	    	return true;
    	}
        return null;
    }

}