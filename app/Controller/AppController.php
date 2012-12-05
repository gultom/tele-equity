<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $components = array (
        'Session',
        'RequestHandler',
        'Auth'
    );
    
    public $helpers = array (
        'Html', 
        'Form'
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        self::getMenus();
    }
    
    public function getMenus() {
        $user = $this->Auth->user();
        $level = $user['level_id'];
        unset($user);
        
        $menus = array (
            'Home' => array (
                'controller' => 'info',
                'action' => 'home'
            ),
            'Info' => array (
                'controller' => 'info',
                'action' => 'view'
            ),
            'Customers' => array (
                'controller' => 'customers',
                'action' => 'view'
            ),
            'Monitor' => array (
                'controller' => 'dashboard',
                'action' => 'monitor'
            ),
            'Collections' => array (
                'controller' => 'collection',
                'action' => 'index'
            ),
            'Reports' => array (
                'controller' => 'report',
                'action' => 'index'
            ),
            'Salesfile' => array (
                'controller' => 'report',
                'action' => 'salesfile'
            ),
            'Users' => array (
                'controller' => 'users',
                'action' => 'view'
            ),
            'Campaigns' => array (
                'controller' => 'campaigns',
                'action' => 'view'
            )
        );
        
        switch ($level) {
            case 8: // TM Level
                unset($menus['Monitor'], $menus['Collections'], $menus['Reports'], $menus['Salesfile'], $menus['Users'], $menus['Campaigns']);
                break;
            
            case (in_array($level, array(7, 6))): // TL & SPV Level
                unset($menus['Collections'], $menus['Reports'], $menus['Salesfile'], $menus['Users'], $menus['Campaigns']);
                break;
            
            case 4: // Collection Level
                unset($menus['Monitor'], $menus['Reports'], $menus['Salesfile'], $menus['Users'], $menus['Campaigns']);
                break;
            
            case 5: // QA Level
                unset($menus['Monitor'], $menus['Collections'], $menus['Reports'], $menus['Salesfile'], $menus['Users'], $menus['Campaigns']);
                break;
        }
        $this->set('menu', $menus);
    }
}
