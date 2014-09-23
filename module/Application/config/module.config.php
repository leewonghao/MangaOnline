<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'thongtintruyen' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/thongtintruyen[/:id][/:Tentruyen].html',
            				'defaults' => array(
            						'controller' => 'Application\Controller\Thongtintruyen',
            						'action'     => 'index',
            						'id'         => '[0-9]+',
            						'Tentruyen' => '[a-zA-Z][a-zA-Z0-9_-]',
            				),
            		),
            ),
            'viewtruyen' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/viewtruyen[/:id][/:Tenchapter].html',
            				'defaults' => array(
            						'controller' => 'Application\Controller\Viewtruyen',
            						'action'     => 'index',
            						'id'         => '[0-9]+',
            						'Tenchapter' => '[a-zA-Z][a-zA-Z0-9_-]',
            				),
            		),
            ),
            'danhsach' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/danhsach',
            				'defaults' => array(
            						'controller' => 'Application\Controller\danhsach',
            						'action'     => 'index',
            						'id'         => '[0-9]+',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'paginator' => array(
            						'type' => 'segment',
            						'options' => array(
            								'route' => '/[page-:page]',
            								'defaults' => array(
            										'page' => 1,
            								),
            						),
            				),
            		),
            ),
            'theloai' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/theloai[/:id][/:Tenloai].html',
            				'defaults' => array(
            						'controller' => 'Application\Controller\theloai',
            						'action'     => 'index',
            						'id'         => '[0-9]+',
            						'Tenloai' => '[a-zA-Z][a-zA-Z0-9_-]',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'paginator' => array(
            						'type' => 'segment',
            						'options' => array(
            								'route' => '/[page-:page]',
            								'defaults' => array(
            										'page' => 1,
            								),
            						),
            				),
            		),
            ),
            'xemnhieu' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/xemnhieu',
            				'defaults' => array(
            						'controller' => 'Application\Controller\xemnhieu',
            						'action'     => 'index',
            						'id'         => '[0-9]+',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'paginator' => array(
            						'type' => 'segment',
            						'options' => array(
            								'route' => '/[page-:page]',
            								'defaults' => array(
            										'page' => 1,
            								),
            						),
            				),
            		),
            ),
            'timkiem' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/timkiem',
            				'defaults' => array(
            						'controller' => 'Application\Controller\timkiem',
            						'action'     => 'index',
            				),
            		),
            ),
            'tacgia' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/tacgia[/:id][/:Tentacgia].html',
            				'defaults' => array(
            						'controller' => 'Application\Controller\tacgia',
            						'action'     => 'index',
            						'id'         => '[a-zA-Z][a-zA-Z0-9_-]*',
            						'Tentacgia' => '[a-zA-Z][a-zA-Z0-9_-]',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'paginator' => array(
            						'type' => 'segment',
            						'options' => array(
            								'route' => '/[page-:page]',
            								'defaults' => array(
            										'page' => 1,
            								),
            						),
            				),
            		),
            ),
            'nhomdich' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/nhomdich[/:id].html',
            				'defaults' => array(
            						'controller' => 'Application\Controller\nhomdich',
            						'action'     => 'index',
            						'id'         => '[a-zA-Z][a-zA-Z0-9_-]*',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'paginator' => array(
            						'type' => 'segment',
            						'options' => array(
            								'route' => '/[page-:page]',
            								'defaults' => array(
            										'page' => 1,
            								),
            						),
            				),
            		),
            ),
            'moinhat' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/moinhat',
            				'defaults' => array(
            						'controller' => 'Application\Controller\moinhat',
            						'action'     => 'index',
            						'id'         => '[a-zA-Z][a-zA-Z0-9_-]*',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'paginator' => array(
            						'type' => 'segment',
            						'options' => array(
            								'route' => '/[page-:page]',
            								'defaults' => array(
            										'page' => 1,
            								),
            						),
            				),
            		),
            ),
            'decu' => array(
            		'type' => 'segment',
            		'options' => array(
            				'route'    => '/decu',
            				'defaults' => array(
            						'controller' => 'Application\Controller\decu',
            						'action'     => 'index',
            						'id'         => '[a-zA-Z][a-zA-Z0-9_-]*',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'paginator' => array(
            						'type' => 'segment',
            						'options' => array(
            								'route' => '/[page-:page]',
            								'defaults' => array(
            										'page' => 1,
            								),
            						),
            				),
            		),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/application[/:action]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'id'         => '[0-9]+',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Thongtintruyen' => 'Application\Controller\ThongtintruyenController',
            'Application\Controller\Viewtruyen' => 'Application\Controller\ViewtruyenController',
            'Application\Controller\Danhsach' => 'Application\Controller\DanhsachController',
            'Application\Controller\Theloai' => 'Application\Controller\TheloaiController',
            'Application\Controller\Xemnhieu' => 'Application\Controller\XemnhieuController',
            'Application\Controller\Timkiem' => 'Application\Controller\TimkiemController',
            'Application\Controller\tacgia' => 'Application\Controller\TacgiaController',
            'Application\Controller\nhomdich' => 'Application\Controller\NhomdichController',
            'Application\Controller\moinhat' => 'Application\Controller\MoinhatController',      
            'Application\Controller\decu' => 'Application\Controller\DecuController',     
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
           'application' => __DIR__ . '/../view',
        ),
    ),
);
