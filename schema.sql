CREATE DATABASE taskforce
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE taskforce;

-- Таблица пользователи
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64) NOT NULL,
email VARCHAR(254) NOT NULL,
address VARCHAR(254) NOT NULL,
avatar VARCHAR(254) NULL,
birthday DATETIME NULL,
info TEXT NULL,
password VARCHAR(255) NOT NULL,
contact_phone VARCHAR(64) NULL,
contact_skype VARCHAR(64) NULL,
contact_other VARCHAR(255) NULL,
creation_time DATETIME NOT NULL DEFAULT NOW(),
last_visited_time DATETIME NOT NULL,
count_views INT NULL,
show_contacts_costumers TINYINT NULL
);


-- Таблица категорий задач
CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(254) NOT NULL,
icon VARCHAR(254) NOT NULL
);

-- Таблица связи пользователя и категорий
CREATE TABLE categories_users (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
category_id INT NULL,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Таблица города
CREATE TABLE cities (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(254) NOT NULL,
lat FLOAT NOT NULL,
long FLOAT NOT NULL
);

-- Таблица уведомлений (хранит информацию о типах уведомлений, которые нужно отсылать пользователю)
CREATE TABLE notifications_users (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
responses TINYINT NULL,
messages TINYINT NULL,
task_action TINYINT NULL,
FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Таблица статусов задачи
CREATE TABLE status_task (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64) NOT NULL
);

-- Таблица задачи
CREATE TABLE tasks (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(254) NOT NULL,
description TEXT NOT NULL,
category_id INT NOT NULL,
files VARCHAR(254) NULL,
price INT NULL,
deadline DATETIME,
creation_time DATETIME NOT NULL DEFAULT NOW(),
initiator_id INT NOT NULL,
costumer_id INT NOT NULL,
location_id INT NOT NULL,
status_id INT NOT NULL,
FOREIGN KEY (initiator_id) REFERENCES users(id),
FOREIGN KEY (costumer_id) REFERENCES users(id),
FOREIGN KEY (category_id) REFERENCES categories(id),
FOREIGN KEY (location_id) REFERENCES cities(id),
FOREIGN KEY (status_id) REFERENCES status_task(id)
);



-- Таблица действий над задачей
CREATE TABLE action_task (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(64) NOT NULL
);

-- Таблица личных сообщений
CREATE TABLE messages(
id INT AUTO_INCREMENT PRIMARY KEY,
message TEXT NOT NULL,
sender_id INT NOT NULL,
recipient_id INT NOT NULL,
FOREIGN KEY (sender_id) REFERENCES users(id),
FOREIGN KEY (recipient_id) REFERENCES users(id)
);

-- Таблица отзывов
CREATE TABLE reviews(
id INT AUTO_INCREMENT PRIMARY KEY,
creation_time DATETIME NOT NULL DEFAULT NOW(),
commentary TEXT,
evaluation TINYINT UNSIGNED,
task_id INT,
FOREIGN KEY (task_id) REFERENCES tasks(id)
);

-- Таблица откликов
CREATE TABLE responses_task (
id INT AUTO_INCREMENT PRIMARY KEY,
commentary TEXT,
initiator_price INT NULL,
user_id INT NOT NULL,
task_id INT NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (task_id) REFERENCES tasks(id)
);

CREATE UNIQUE INDEX email_index ON users(email);
CREATE INDEX name_task_index ON tasks(name);
CREATE INDEX name_user_index ON users(name);
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
