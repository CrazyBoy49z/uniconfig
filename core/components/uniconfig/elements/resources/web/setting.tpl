<div class="col-sm-12 col-lg-6" style="margin-left: auto; margin-right: auto; float: none;">
  <div class="panel panel-default">

  {$_modx->runSnippet('!OfficeProfile',[
    'tplProfile' => '@FILE chunks/login/_profile.tpl',
    'profileFields' => 'phone:18,fullname,specifiedpassword,confirmpassword',
    'requiredFields' => 'phone',
    'avatarParams' => '{"w":200,"h":200,"zc":0,"bg":"ffffff","f":"jpg"}',
    'HybridAuth' => 0,
  ])}
  </div>
</div>