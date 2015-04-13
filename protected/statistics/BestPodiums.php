<?php

class BestPodiums extends Statistics {

	public static function build($statistic, $page = 1) {
		$eventId = $statistic['eventId'];
		$type = self::getType($eventId);
		$command = Yii::app()->wcaDb->createCommand();
		$command->select(array(
			'r.competitionId',
			'r.eventId',
			'r.roundId',
			self::getSelectSum($eventId, $type),
			'c.cellName',
			'c.year',
			'c.month',
			'c.day',
		))
		->from('Results r')
		->leftJoin('Competitions c', 'r.competitionId=c.id')
		->where('r.eventId=:eventId', array(
			':eventId'=>$eventId,
		))
		->andWhere('r.roundId IN ("c", "f")')
		->andWhere('r.pos IN (1,2,3)')
		->andWhere('c.countryId="China"')
		->andWhere("r.{$type} > 0");
		$cmd = clone $command;
		$command->group('r.competitionId')
		->order('sum ASC')
		->having('count(DISTINCT pos)=3')
		->limit(self::$limit)
		->offset(($page - 1) * self::$limit);
		$columns = array(
			array(
				'header'=>'Yii::t("common", "Competition")',
				'value'=>'CHtml::link(ActiveRecord::getModelAttributeValue($data, "name"), $data["url"])',
				'type'=>'raw',
			),
			array(
				'header'=>'Yii::t("Competition", "Date")',
				'value'=>'$data["date"]',
				'type'=>'raw',
			),
			array(
				'header'=>'Yii::t("statistics", "Sum")',
				'value'=>'CHtml::tag("b", array(), $data["formatedSum"])',
				'type'=>'raw',
			),
			array(
				'header'=>'Yii::t("statistics", "First")',
				'value'=>self::makePosValue('first'),
				'type'=>'raw',
			),
			array(
				'header'=>'',
				'value'=>'Results::formatTime($data["first"][0]["average"], $data["eventId"])',
			),
			array(
				'header'=>'Yii::t("statistics", "Second")',
				'value'=>self::makePosValue('second'),
				'type'=>'raw',
			),
			array(
				'header'=>'',
				'value'=>'Results::formatTime($data["second"][0]["average"], $data["eventId"])',
			),
			array(
				'header'=>'Yii::t("statistics", "Third")',
				'value'=>self::makePosValue('third'),
				'type'=>'raw',
			),
			array(
				'header'=>'',
				'value'=>'Results::formatTime($data["third"][0]["average"], $data["eventId"])',
			),
		);
		$rows = array();
		foreach ($command->queryAll() as $row) {
			$row = self::getCompetition($row);
			$row["first"] = self::getPodiumsAverage($row['competitionId'], $eventId, $row['roundId'], 1, $type);
			$row["second"] = self::getPodiumsAverage($row['competitionId'], $eventId, $row['roundId'], 2, $type);
			$row["third"] = self::getPodiumsAverage($row['competitionId'], $eventId, $row['roundId'], 3, $type);
			$row['formatedSum'] = self::formatSum($row);
			$row['date'] = sprintf("%d-%02d-%02d", $row['year'], $row['month'], $row['day']);
			$rows[] = $row;
		}
		$statistic['count'] = $cmd->select('count(DISTINCT r.competitionId) AS count')->queryScalar();
		$statistic['rank'] = ($page - 1) * self::$limit;
		$statistic['rankKey'] = 'sum';
		return self::makeStatisticsData($statistic, $columns, $rows);
	}

	private static function getSelectSum($eventId, $type) {
		if ($eventId === '333fm') {
			return "sum(DISTINCT CASE WHEN c.year<2014 THEN best*100 ELSE (CASE WHEN average=0 THEN best*100 ELSE average END) END) AS sum";
		} else {
			return "sum(DISTINCT r.{$type}) AS sum";
		}
	}

	private static function formatSum($row) {
		switch ($row['eventId']) {
			case '333mbf':
				return array_sum(array_map(function($row) {
					$result = $row[0]['average'];
					$difference = 99 - substr($result, 0, 2);
					return $difference;
				}, array($row['first'], $row['second'], $row['third'])));
			case '333fm':
				return $row['sum'] / 100;
			default:
				return Results::formatTime($row['sum'], $row['eventId']);
		}
	}

	private static function makePosValue($pos) {
		return 'implode(" / ", array_map(function($row) {
			return Persons::getLinkByNameNId($row["personName"], $row["personId"]);
		}, $data["' . $pos . '"]))';
	}

	private static function getType($eventId) {
		if (in_array($eventId, array('333fm', '333bf', '444bf', '555bf', '333mbf'))) {
			return 'best';
		}
		return 'average';
	}

	private static function getPodiumsAverage($competitionId, $eventId, $roundId, $pos, $type) {
		if ($eventId === '333fm') {
			$type = 'CASE WHEN year<2014 THEN best ELSE (CASE WHEN average=0 THEN best ELSE average END) END';
		}
		return Yii::app()->wcaDb->createCommand()
		->select("personId, personName, {$type} AS average")
		->from('Results r')
		->leftJoin('Competitions c', 'r.competitionId=c.id')
		->where("competitionId='{$competitionId}'")
		->andWhere("eventId='{$eventId}'")
		->andWhere("roundId='{$roundId}'")
		->andWhere("pos={$pos}")
		->queryAll();
	}
}
