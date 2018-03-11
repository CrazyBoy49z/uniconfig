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
  'initials' => [
    'file' => 'initials',
    'description' => 'Инициалы пользователя',
    'properties' => [
      'fullname' => [
        'type' => 'textfield',
        'value' => '',
      ],
    ],
  ],
  'avatar' => [
    'file' => 'avatar',
    'description' => 'Аватарка пользователя',
    'properties' => [
      'size' => [
        'type' => 'textfield',
        'value' => '100',
      ],
      'no_pic' => [
        'type' => 'textfield',
        'value' => '',
      ],
    ],
  ],
];