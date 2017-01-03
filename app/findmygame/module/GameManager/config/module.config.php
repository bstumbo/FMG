<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

 namespace GameManager;


return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'findmygame' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/games',
                    'defaults' => array(
                        '__NAMESPACE__' => 'GameManager\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller][/:action][/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                'search' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/search',
                            'defaults' => array(
                                'action' => 'search',
                            )
                        ),
                        'may_terminate' => true,
                    ),
                'edit' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/edit',
                            'defaults' => array(
                                'action' => 'edit',
                            )
                        ),
                        'may_terminate' => true,
                    ),
                 'view' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/view',
                            'defaults' => array(
                                'action' => 'view',
                            )
                        ),
                        'may_terminate' => true,
                    ),
                 'delete' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/delete',
                            'defaults' => array(
                                'action' => 'delete',
                            )
                        ),
                        'may_terminate' => true,
                    ),
                 'manage' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/manage',
                            'defaults' => array(
                                'action' => 'manage',
                            )
                        ),
                        'may_terminate' => true,
                    ),
                 'viewindi' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/viewindi',
                            'defaults' => array(
                                'action' => 'viewindi',
                            )
                        ),
                        'may_terminate' => true,
                    ),
                 'paginatior' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[page/:page]',
                            'defaults' => array(
                                'page' => '[0-9]*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        
    ),
    'controllers' => array(
        'invokables' => array(
            'GameManager\Controller\Index' => 'GameManager\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
           'result-partial' => __DIR__ . '/../view/game-manager/index/partials/result-partial.phtml',
           'search' => __DIR__ . '/../view/layouts/game-layout_search.phtml',
           'games' => __DIR__ . '/../view/layouts/game-layout_home.phtml',
           'viewindi' => __DIR__ . '/../view/layouts/game-layout_search.phtml',
           'edit' => __DIR__ . '/../view/layouts/game-layout.phtml',
           'delete' => __DIR__ . '/../view/layouts/game-layout.phtml',
           'view' => __DIR__ . '/../view/layouts/game-layout.phtml',
           'manage' => __DIR__ . '/../view/layouts/game-layout.phtml',
           'layout/layout' => __DIR__ . '/../view/layouts/game-layout.phtml',
        ),
        'template_path_stack' => array(
           'grace-drops' => __DIR__ . '/../view',
            'findmygame' =>  __DIR__ . '/../view',
        ),
        'strategies' => array (
            'ViewJsonStrategy'
        ),
        'display_exceptions' => true,
    ),
);
