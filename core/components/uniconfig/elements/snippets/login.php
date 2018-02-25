<?php
$email = $_POST['email'];
$password = $_POST['password'];
$remember = $_POST['remember'];
if (empty($email)) {
	return $AjaxForm->error('Ошибки в форме', array(
		'email' => 'Вы не заполнили E-mail'
	));
}
if (empty($password)) {
	return $AjaxForm->error('Ошибки в форме', array(
		'password' => 'Вы не заполнили пароль'
	));
}
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$count = $modx->getCount('modUser', array('username' => $email));
	if($count == 0) {
		return $AjaxForm->error('Пользователь не найден');
	}
	$resp = $modx->runProcessor('/security/login', array(
		'username' => $email,
		'password' => $password,
		'rememberme' => $remember,
	));
	if($resp->isError()) {
		return $AjaxForm->error('Неправильно введен пароль');
	};
  return $AjaxForm->success('Вы успешно авторизованы');
} else{
	return $AjaxForm->error('Ошибки в форме', array(
		'email' => 'E-mail адрес указан не верно!'
	));
}

