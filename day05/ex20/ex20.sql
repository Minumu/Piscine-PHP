SELECT `film`.`id_genre`,
		`genre`.`name` AS 'name_genre',
		`distrib`.`id_distrib`,
		`distrib`.`name` AS 'name_distrib',
		`film`.`title` AS 'title_film'
FROM `film`, `genre`, `distrib`
WHERE `film`.`id_genre` = `genre`.`id_genre` AND `film`.`id_distrib` = `distrib`.`id_distrib`
AND `film`.`id_genre` BETWEEN '4' AND '8';