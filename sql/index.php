<?
# Основные манипуляции с данными

#### Выборка данных

SELECT name FROM teachers


SELECT name, addr, city
 FROM teachers
 ORDER BY name
 
 
SELECT title
 FROM courses
 WHERE length > 30
 
 
SELECT *
 FROM courses
 WHERE length > 30
 AND title LIKE 'Web%'
 
 
SELECT DISTINCT length
 FROM courses


#### Объединение таблиц

SELECT t.name, t.code, l.course
 FROM teachers t
 INNER JOIN lessons l ON t.id = l.tid
 
 
SELECT t.name, t.code, l.course
 FROM teachers t
 LEFT OUTER JOIN lessons l ON t.id = l.tid


#### Вставка новой записи

INSERT INTO courses
 VALUES (NULL, 'PHP', '…', 40)


INSERT INTO courses(title, length)
 VALUES ('PHP', 40)


#### Удаление записи

DELETE FROM lessons
 WHERE date = '2014-06-11'


#### Изменение записи

UPDATE teachers
 SET
  zarplata = zarplata * 2,
  premia = premia * 10
 WHERE name LIKE 'Иванов%'
  OR name LIKE 'Петров%'
  OR name LIKE 'Сидоров%'
  
  
UPDATE teachers
 SET
  zarplata = zarplata * 2,
  premia = premia * 10
 WHERE name IN
  ('Иванов', 'Петров', 'Сидоров')
  
  
#### Создание базы данных

CREATE DATABASE news


#### Создание таблицы и полей (СУБД MySQL диалект)

CREATE TABLE items (
 id int NOT NULL auto_increment,
 title varchar(255) NOT NULL default '',
 description varchar(255) NOT NULL default '',
 content text,
 author varchar(50) NOT NULL default '',
 pubdate timestamp NOT NULL default '',
PRIMARY KEY (id)
)
?>