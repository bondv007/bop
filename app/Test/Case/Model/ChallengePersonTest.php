<?php
App::uses('ChallengePerson', 'Model');

/**
 * ChallengePerson Test Case
 *
 */
class ChallengePersonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.challenge_person'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ChallengePerson = ClassRegistry::init('ChallengePerson');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ChallengePerson);

		parent::tearDown();
	}

}
