INSERT INTO auto (id, `name`, mark, `number`, state) VALUES
(1, 'Audi', 'Q8', 'A765KE33', 1),
(2, 'Audi', 'TT', 'Б537РТ55', 1),
(3, 'BMW', 'THE7', 'Р345ЕО43', 1);

INSERT INTO department (id, addr) VALUES
(1, 'Lenina 1'),
(2, 'Pushkina 2');

INSERT INTO `user` (id, `name`, surname, patronymic) VALUES
(1, 'Александр', 'Морозов', 'Николаевич'),
(2, 'Аркадий', 'Мешков', 'Валентинович');

INSERT INTO history (id, user_id, auto_id, took, gave, department_from, department_to) VALUES
(1, 1, 1, '2019-01-02 00:00:00', '2019-01-02 00:02:00', 1, 1),
(2, 1, 1, '2019-02-01 00:00:00', '2019-02-03 00:00:00', 1, 2),
(4, 2, 3, '2019-01-02 00:00:00', '2019-01-03 01:00:00', 1, 1);