<?php
/**
 * ChallengeWodFixture
 *
 */
class ChallengeWodFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'challenge_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'wod_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'movement_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'value' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '8,2'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'challenge_id' => 1,
			'wod_id' => 1,
			'movement_id' => 1,
			'value' => 1,
			'created' => '2014-07-16 12:45:02'
		),
	);

}
