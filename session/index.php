<?
# Управление сеансами

#### Создание и(или) доступ к сессии

session_start();

#### Запись в сессионную переменную

$_SESSION['name'] = 'John';

#### Чтение из сессионной переменной

echo $_SESSION['name'];

#### Очистка сессионных переменных

session_destroy();

#### Принудительное удаление сессионной cookie

setcookie(session_name(), session_id(), time()-3600);

#Дополнительные параметры сеанса

// session.auto_start = 0
ini_set('session.name', 'PHPSESSID');
ini_set('session.save_path', '');
ini_set('session.gc_maxlifetime', '1440');
ini_set('session.cookie_lifetime', '0');
ini_set('session.cookie_httponly', '');
ini_set('session.cookie_path', '/');
?>