<?php
if ($modx->context->key != 'mgr') {
  switch ($modx->event->name) {
    // Событие перед регистрацией пользователя
    case 'OnBeforeUserFormSave':
      if ($_POST['action'] == 'auth/formRegister'){
        if (empty($_POST['fullname'])) {
          $modx->event->output('Укажите Ф.И.О.');
          break;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $modx->event->output('E-mail адрес указан не верно!');
          break;
        }
        $user->Profile->set('fullname', $_POST['fullname']);
        break;
      }
  }
}