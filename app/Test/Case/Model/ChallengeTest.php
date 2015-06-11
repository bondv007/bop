<?php
App::uses('Challenge', 'Model');

/**
 * Challenge Test Case
 *
 */
class ChallengeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.challenge'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Challenge = ClassRegistry::init('Challenge');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Challenge);

		parent::tearDown();
	}

}
