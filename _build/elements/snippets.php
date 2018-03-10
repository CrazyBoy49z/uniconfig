<?php

return [
  'uniConfig' => [
    'file' => 'uniconfig',
    'description' => 'uniConfig snippet to list items',
    'properties' => [
      'tpl' => [
        'type' => 'textfield',
        'value' => 'tpl.uniConfig.item',
      ],
      'sortby' => [
        'type' => 'textfield',
        'value' => 'name',
      ],
      'sortdir' => [
        'type' => 'list',
        'options' => [
          ['text' => 'ASC', 'value' => 'ASC'],
          ['text' => 'DESC', 'value' => 'DESC'],
        ],
        'value' => 'ASC',
      ],
      'limit' => [
        'type' => 'numberfield',
        'value' => 10,
      ],
      'outputSeparator' => [
        'type' => 'textfield',
        'value' => "\n",
      ],
      'toPlaceholder' => [
        'type' => 'combo-boolean',
        'value' => false,
      ],
    ],
  ],
  'homeredirect' => [
    'file' => 'homeredirect',
    'description' => 'If the user is authorized, redirects to the personal account'
  ],
  'login' => [
    'file' => 'login',
    'description' => 'Авторизация пользователя',
  ],
  'registration' => [
    'file' => 'registration',
    'description' => 'Регистрация пользователя',
    'properties' => [
      'tplActivate' => [
        'type' => 'textfield',
        'value' => '@FILE chunks/login/_activateEmail.tpl',
      ],
      'activationResourceId' => [
        'type' => 'textfield',
        'value' => '',
      ]
    ],
  ],
  'initials' => [
    'file' => 'initials',
    'properties' => [
      'fullname' => [
        'type' => 'textfield',
        'value' => '',
      ],
    ],
  ],
];