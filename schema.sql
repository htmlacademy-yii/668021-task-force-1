CREATE DATABASE taskforce
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE taskforce;

-- Таблица пользователи
CREATE TABLE users (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64),
email VARCHAR(254),
address VARCHAR(254),
avatar VARCHAR(254),
date_birthday DATETIME,
about_info TEXT,
password VARCHAR,
contact_phone VARCHAR(64),
contact_skype VARCHAR(64),
contact_other VARCHAR(64),
time_online DATETIME,
failed_tasks INT(11),
count_views INT(11)
);

-- Таблица статуса пользователя (свободен, занят и др.)
CREATE TABLE status_user (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
status VARCHAR(64),
FOREIGN KEY (user_id) REFERENCES users(id),
)

-- Таблица категорий задач
CREATE TABLE categories (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(254)
);

-- Таблица связи пользователя и категорий
CREATE TABLE categories_users (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (category_id) REFERENCES categories(id)
)

-- Таблица города
CREATE TABLE cities (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(254)
);

-- Таблица уведомлений (хранит информацию о типах уведомлений, которые нужно отсылать пользователю)
CREATE TABLE notifications_users (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
responses BOOLEAN,
messages BOOLEAN,
task_action BOOLEAN,
FOREIGN KEY (user_id) REFERENCES users(id),
);

-- Таблица задачи
CREATE TABLE tasks (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
target VARCHAR(254),
description TEXT,
files varchar(254),
price INT(11),
deadline DATETIME,
publication_time DATETIME NOT NULL DEFAULT NOW(),
FOREIGN KEY (initiator_id) REFERENCES users(id),
FOREIGN KEY (costumer_id) REFERENCES users(id),
FOREIGN KEY (location) REFERENCES cities(id),
FOREIGN KEY (status) REFERENCES status_task(id)
);

-- Таблица статусов задачи
CREATE TABLE status_task (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64);
);

-- Таблица действий над задачей
CREATE TABLE action_task (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64);
);

-- Таблица личных сообщений
CREATE TABLE messages(
id INT(11) AUTO_INCREMENT PRIMARY KEY,
message TEXT,
FOREIGN KEY (sender_id) REFERENCES users(id),
FOREIGN KEY (reciever_id) REFERENCES users(id)
);

-- Таблица отзывов
CREATE TABLE reviews(
id INT(11) AUTO_INCREMENT PRIMARY KEY,
commentary TEXT,
evaluation INT(3),
FOREIGN KEY (task_id) REFERENCES tasks(id)
);

-- Таблица откликов
CREATE TABLE responses_task (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
commentary TEXT,
initiator_price INT(11),
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (task_id) REFERENCES tasks(id)
);


/*
Классы.
По поводу классов взаимодействия, я набросал очень примерные список, возможно несколько классов нужно объедитиь в один,
либо вообще убрать:
Класс CreateAccount (участвует в процессах регистрации аккаунта, аутентификации пользователя)
Класс PublicationTask(создает задачу и проверят данные формы).
Класс Task (хранит данные о задачи, меняет статусы в зависимости от действий)
Класс Authorization (Определяет правила и права на задачу, кто может менять статусы и действия).
Класс Authentication (Аутентификация пользователя)
Класс SendNotifications (Отправка уведомлений: об изменении задачи, нового отклика, личного сообщения).
Класс AddResponse (Добавление отклика)
Класс AddReviews (Добавление отзыва)
Класс SearchAndSort(Сортировка и поиск заданий, пользователей и др.)
 */


/*
Поиск и сортировка.
1. Список всех задач.
2. Сортировка задач: по категории, дополнительно (удаленная работа, город)
3. Поиск задачи по названию, по периоду времени.
4. Список всех пользователей.
5. Сортировка пользователей: по рейтингу, числу заказов, популярности
6. Фильтр пользователей: по категории, дополнительно(свободен, занят, есть отзывы)
7. Поиск по названию пользователя.
8. Список всех откликов для одного задания.
9. Список всех отзывов для одного пользователя.
10. Список моих заданий: завершенные, новые, активные, отмененные, скрытые.


*/




