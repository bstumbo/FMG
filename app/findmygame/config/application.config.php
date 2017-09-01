<?php
/**
 * Configuration file generated by ZFTool
 * The previous configuration file is stored in application.config.old
 *
 * @see https://github.com/zendframework/ZFTool
 */
return array(
    'modules' => array(
        'Application',
        'GameManager',
        'ZfcBase',
        'ZfcUser',
        'DoctrineModule',
        'DoctrineMongoODMModule',
        'ZfcUserDoctrineMongoODM',
        'GoogleMapsTools',
        'Googleanalytics',
        
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
           'GoogleMapsTools' => './vendor/sgoranov/google-maps-tools',
           'ZfcUserDoctrineMongoODM' => './vendor/ZfUserDoctrineMongoODM',
           'Googleanalytics' => './vendor/netzfabrik/googleanalytics'
        ),
        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    ),
);
