<?php

return [
	'friendly_urls' => [
		'key' => 'friendly_urls',
		'xtype' => 'combo-boolean',
		'value' => true,
		'area' => 'furls',
		'namespace' => 'core',
	],
	'link_tag_scheme' => [
		'key' => 'link_tag_scheme',
		'xtype' => 'textfield',
		'value' => 'abs',
		'area' => 'site',
		'namespace' => 'core',
	],
	'pdotools_elements_path' => [
		'key' => 'pdotools_elements_path',
		'xtype' => 'textfield',
		'value' => '{base_path}uniConfig/core/components/uniconfig/elements/',
		'area' => 'pdotools_main',
		'namespace' => 'pdotools',
	],
	'fenom_parser' => [
		'key' => 'pdotools_fenom_parser',
		'xtype' => 'combo-boolean',
		'value' => true,
		'area' => 'pdotools_main',
		'namespace' => 'pdotools',
	],
  'error_page' => [
    'key' => 'error_page',
    'xtype' => 'textfield',
    'value' => '4',
    'area' => 'site',
    'namespace' => 'core',
  ],
  'unauthorized_page' => [
    'key' => 'unauthorized_page',
    'xtype' => 'textfield',
    'value' => '6',
    'area' => 'site',
    'namespace' => 'core',
  ],
  'uniconfig_assets_path' =>[
    'key' => 'uniconfig_assets_path',
    'xtype' => 'textfield',
    'value' => '{base_path}uniConfig/assets/components/uniconfig/',
    'area' => 'uni_setting',
    'namespace' => 'uniconfig',
  ],
  'uniconfig_assets_url' => [
    'key' => 'uniconfig_assets_url',
    'xtype' => 'textfield',
    'value' => 'uniConfig/assets/components/uniconfig/',
    'area' => 'uni_setting',
    'namespace' => 'uniconfig',
  ],
  'uniconfig_core_path' => [
    'key' => 'uniconfig_core_path',
    'xtype' => 'textfield',
    'value' => '{base_path}uniConfig/core/components/uniconfig/',
    'area' => 'uni_setting',
    'namespace' => 'uniconfig',
  ],

];