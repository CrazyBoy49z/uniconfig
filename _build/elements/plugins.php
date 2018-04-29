<?php

return [
  'uniConfig' => [
    'file' => 'uniconfig',
    'description' => '',
    'events' => [
      'OnMODXInit' => [],
      'OnHandleRequest' => [],
      'pdoToolsOnFenomInit' => [],
      'OnWebPageInit' => [],
      'OnPageNotFound' => [],
    ],
  ],
  'office_registration' => [
    'file' => 'office_registration',
    'description' => 'Кастомная проверка при регистрации',
    'events' => [
      'OnBeforeUserFormSave' => [],
    ],
  ],
];