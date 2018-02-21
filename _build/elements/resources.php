<?php

return [
    'web' => [
        'index' => [
        	  'id'      => 1,
            'pagetitle' => 'Home',
            'template' => 1,
            'hidemenu' => false,
        ],
        'service' => [
            'pagetitle' => 'Service',
            'template' => 0,
            'hidemenu' => true,
            'published' => false,
            'resources' => [
                '404' => [
                    'pagetitle' => 'Ошибка 404 - Страница не найдена',
                    'template' => 1,
                    'hidemenu' => true,
                    'uri' => '404',
                    'uri_override' => true,
                ],
                '403' => [
                    'pagetitle' => 'Ошибка 403 - отказано в доступе',
                    'template' => 0,
                    'hidemenu' => true,
	                  'menutitle' => '403',
                    'uri' => '403',
                    'uri_override' => true,
                ],
            ],
        ],
	      'login' => [
	      	'pagetitle' => 'Login',
		      'template' => 0,
		      'hidemenu' => true,
		      'published' => false,
		      'resources' => [
		      	'authorization' => [
		      		'pagetitle' => 'Авторизация',
				      'longtitle' => 'Авторизация пользователя',
				      'template' => 2,
				      'hidemenu' => true,
				      'uri' => 'authorization',
				      'uri_override' => true,
			      ],
		      ],
	      ],
    ],
];