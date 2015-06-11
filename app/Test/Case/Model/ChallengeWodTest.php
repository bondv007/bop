<?php
App::uses('ChallengeWod', 'Model');

/**
 * ChallengeWod Test Case
 *
 */
class ChallengeWodTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.challenge_wod'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ChallengeWod = ClassRegistry::init('ChallengeWod');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ChallengeWod);

		parent::tearDown();
	}

}
