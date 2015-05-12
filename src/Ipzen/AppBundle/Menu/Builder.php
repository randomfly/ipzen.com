<?php 

namespace Ipzen\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        // Homepage Menu item
        $menu->addChild('Home', array('route' => 'ipzen_app_homepage'))
            ->setAttribute('icon', 'icon-home');

        // Admin interface Menu item
        $menu->addChild('admin', array('route' => 'ipzen_app_admin'))
            ->setAttribute('icon', 'icon-key');
            
        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->addChild('User', array('label' => 'Account'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'icon-user');

        $menu['User']->addChild('Edit profile', array('route' => 'ipzen_app_profile'))
            ->setAttribute('icon', 'icon-edit');
        $menu['User']->addChild('Logout', array('route' => 'ipzen_app_logout'));

        return $menu;
    }

    public function whoisMenu(FactoryInterface $factory, array $options) {

        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->addChild('Whois', array('label' => 'Whois'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'icon-search');

        $menu['Whois']->addChild('Simple search', array('route' => 'ipzen_app_whois'));

        $menu['Whois']->addChild('Multiple search', array('route' => 'ipzen_app_whois_bulk'));

        return $menu;

    } 
}