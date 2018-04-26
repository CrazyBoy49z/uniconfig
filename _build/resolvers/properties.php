<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */

//Параметры к сниппетам
if ($transport->xpdo) {
  $modx =& $transport->xpdo;
  switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
      /** @var modSnippet $snippet */
      if ($snippet = $modx->getObject('modSnippet', array('name' => 'Jevix'))) {
        if (!$prop_comment = $modx->getObject('modPropertySet', array('name' => 'Comment'))) {
          $prop_comment = $modx->newObject('modPropertySet');
        }
        $prop_comment->fromArray(array(
          'name' => 'Comment',
          'description' => 'Filter rules for comments',
          'properties' => array(
            'cfgAllowTagParams' => array(
              'name' => 'cfgAllowTagParams',
              'desc' => 'cfgAllowTagParams',
              'type' => 'textfield',
              'options' => array(),
              'lexicon' => 'jevix:properties',
              'area' => '',
              'value' => '{"pre":{"class":["prettyprint"]},"a":["title","href"],"img":{"0":"src","alt":"#text","1":"title","align":["right","left","center"],"width":"#int","height":"#int","hspace":"#int","vspace":"#int"}}',
            ),
            'cfgAllowTags' => array(
              'name' => 'cfgAllowTags',
              'desc' => 'cfgAllowTags',
              'type' => 'textfield',
              'options' => array(),
              'lexicon' => 'jevix:properties',
              'area' => '',
              'value' => 'a,img,i,b,u,em,strong,li,ol,ul,sup,abbr,acronym,br,pre,code,kbd,s,blockquote',
            ),
            'cfgSetTagChilds' => array(
              'name' => 'cfgSetTagChilds',
              'desc' => 'cfgSetTagChilds',
              'type' => 'textfield',
              'options' => array(),
              'lexicon' => 'jevix:properties',
              'area' => '',
              'value' => '[["ul",["li"],false,true],["ol",["li"],false,true]]',
            ),
            'cfgSetAutoReplace' => array(
              'name' => 'cfgSetAutoReplace',
              'desc' => 'cfgSetAutoReplace',
              'type' => 'textfield',
              'options' => array(),
              'lexicon' => 'jevix:properties',
              'area' => '',
              'value' => '[["+/-","(c)","(с)","(r)","(C)","(С)","(R)","<code","code>"],["±","©","©","®","©","©","®","<pre class=\\"prettyprint\\"","pre>"]]',
            ),
            'cfgSetTagShort' => array(
              'name' => 'cfgSetTagShort',
              'desc' => 'cfgSetTagShort',
              'type' => 'textfield',
              'options' => array(),
              'lexicon' => 'jevix:properties',
              'area' => '',
              'value' => 'br,img',
            ),
            'cfgSetTagPreformatted' => array(
              'name' => 'cfgSetTagPreformatted',
              'desc' => 'cfgSetTagPreformatted',
              'type' => 'textfield',
              'options' => array(),
              'lexicon' => 'jevix:properties',
              'area' => '',
              'value' => 'pre,code,kbd',
            ),
          ),
        ));
        if ($prop_comment->save() && $snippet->addPropertySet($prop_comment)) {
          $modx->log(xPDO::LOG_LEVEL_INFO,
            'Property set "Comment" for snippet <b>Jevix</b> was created');
          $success = true;
        } else {
          $modx->log(xPDO::LOG_LEVEL_ERROR,
            'Could not create property set "Comment" for <b>Jevix</b>');
          $success = false;
        }
      };

      break;
    case xPDOTransport::ACTION_UNINSTALL:
      $success = true;
      break;
  }
}
return $success;