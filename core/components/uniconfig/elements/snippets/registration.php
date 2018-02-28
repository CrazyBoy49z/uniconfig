<?php
$lastname = trim(htmlspecialchars($_POST['lastname']));
$firstname = trim(htmlspecialchars($_POST['firstname']));
$thirdname = trim(htmlspecialchars($_POST['thirdname']));


$phone = trim(htmlspecialchars($_POST['phone']));
$phone = str_replace(' ', '', $phone);
$phone = str_replace('-', '', $phone);
$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['password']));
$password_confirm = trim(htmlspecialchars($_POST['password_confirm']));
$out = array(
  'success' => 0,
  'message' => 'Неизвестная ошибка',
);

//Обработка ошибок
if (!$lastname || !$firstname || !$password || !$email || $password_confirm) {
  $out['message'] = 'Не заполнено одно из обязательных полей';
  exit(json_encode($out));
}
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
  $out['message'] = 'E-mail адрес указан не верно!';
  exit(json_encode($out));
}
if ($password !== $password_confirm) {
  $out['message'] = 'Пароли не совпадают';
  exit(json_encode($out));
}
if(iconv_strlen($password) < 6){
  $out['message'] = 'Ваш пароль менее 6 символов';
  exit(json_encode($out));
}
$count = $modx->getCount('modUser', array('username' => $email));
if($count){
  $out['message'] = 'Пользователь с таким email уже существует';
  exit(json_encode($out));
}
$fullname = $lastname.' '.$firstname.' '.$thirdname;


//Все гуд
$user = $modx->newObject('modUser');
$user->set('username', $email);
$user->set('password', $password);
$user->set('active', false);
$user->save();

// создаем профиль
$profile = $modx->newObject('modUserProfile');
$profile->set('fullname', $fullname);
$profile->set('email', $email);
$profile->set('phone', $phone);
$user->addOne($profile);

if ($profile->save() && $user->save()) {
  $out['success'] = 1;
  $out['message'] = 'Регистрация прошла успешна, подтвердите свой E-mail';
  $groupsList = array('Users');
  $groups = array();
  foreach ($groupsList as $groupName) {
    // получаем группу по имени
    $group = $modx->getObject('modUserGroup', array('name' => $groupName));
    // создаем объект типа modUserGroupMember
    $groupMember = $modx->newObject('modUserGroupMember');
    $groupMember->set('user_group', $group->get('id'));
    $groupMember->set('role', 1); // 1 - это членство с ролью Member
    $groups[] = $groupMember;
  }
  $user->addMany($groups);
  $user->save();

  if (!_activateUser($email, $password)){
    $out['success'] = 0;
    $out['message'] = 'не удалось выполнить подтвеждение e-mail';
  }
  exit(json_encode($out));
}
/**
 * SendEmail to User
 *
 * @param $msg
 * @param $to
 * @param $subject
 * @param $tpl
 *
 * @return boolean
 */
function sendEmail($msg, $to, $subject , $tpl) {
  global $modx;
  $to = str_replace(' ', '', $to);
  $to = explode(',',$to);
  $from = $modx->getOption('emailsender');
  $project_name = $modx->getOption('site_name');
  $pdo = $modx->getService('pdoTools');
  $modx->getService('mail', 'mail.modPHPMailer');
  $modx->mail->set(modMail::MAIL_FROM, $from);
  $modx->mail->set(modMail::MAIL_FROM_NAME, $project_name);
  foreach ($to as $item) {
    $modx->mail->address('to', $item);
  }
  $modx->mail->set(modMail::MAIL_SUBJECT, $subject);
  $modx->mail->set(modMail::MAIL_BODY, $pdo->getChunk($tpl, array(
    'data' => $msg
  )));
  $modx->mail->setHTML(true);
  if (!$modx->mail->send()) {
    $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$modx->mail->mailer->ErrorInfo);
    return false;
  }
  $modx->mail->reset();
  return true;
}


/**
 * Send activation link for existing user
 *
 * @param $email
 * @param $password
 * @param $tpl
 *
 * @return boolean
 */
function _activateUser($email = '', $password = '', $tpl){
//Дописать функцию активации E-mail
  /** @var modUser $user */
  $q = $this->modx->newQuery('modUser');
  $q->innerJoin('modUserProfile', 'Profile');
  if (!empty($email)) {
    $q->where(array('modUser.username' => $email, 'OR:Profile.email:=' => $email));
  }
}

exit(json_encode($out));
