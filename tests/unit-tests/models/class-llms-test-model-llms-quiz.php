<?php
/**
 * Tests for LifterLMS Quiz Model
 *
 * @package  LifterLMS_Tests/Models
 *
 * @group post_models
 * @group quizzes
 * @group quiz
 *
 * @since 3.16.0
 */
class LLMS_Test_LLMS_Quiz extends LLMS_PostModelUnitTestCase {

	/**
	 * class name for the model being tested by the class
	 *
	 * @var  string
	 */
	protected $class_name = 'LLMS_Quiz';

	/**
	 * db post type of the model being tested
	 *
	 * @var  string
	 */
	protected $post_type = 'llms_quiz';

	/**
	 * Get properties, used by test_getters_setters
	 *
	 * This should match, exactly, the object's $properties array.
	 *
	 * @since 3.16.0
	 *
	 * @return string[]
	 */
	protected function get_properties() {
		return array(
			'lesson_id' => 'absint',
		);
	}

	/**
	 * Get data to fill a create post with
	 *
	 * This is used by test_getters_setters.
	 *
	 * @since 3.16.0
	 *
	 * @return array
	 */
	protected function get_data() {
		return array(
			'lesson_id' => 123,
		);
	}


	/**
	 * Test the create_question() method.
	 *
	 * @since 3.16.0
	 *
	 * @return void
	 */
	public function test_create_question() {

		$this->create( 'test title' );
		$this->assertTrue( is_numeric( $this->obj->questions()->create_question() ) );

	}

	/**
	 * Test the delete_question() method.
	 *
	 * @since 3.16.0
	 *
	 * @return void
	 */
	public function test_delete_question() {

		$this->create( 'test title' );
		$qid = $this->obj->questions()->create_question();
		$this->assertTrue( $this->obj->questions()->delete_question( $qid ) );

		// belongs to another quiz, can't delete
		$this->create( 'second question' );
		$this->assertFalse( $this->obj->questions()->delete_question( $qid ) );

		// doesn't exist
		$this->assertFalse( $this->obj->questions()->delete_question( 999999999 ) );

	}

	/**
	 * Test the get_question() method.
	 *
	 * @since 3.16.0
	 *
	 * @return void
	 */
	public function test_get_question() {

		$this->create( 'test title' );
		$qid = $this->obj->questions()->create_question();
		$this->assertTrue( is_a( $this->obj->questions()->get_question( $qid ), 'LLMS_Question' ) );

		// question doesn't belong to quiz so it should return false
		$this->create( 'second question' );
		$this->assertFalse( $this->obj->questions()->get_question( $qid ) );

		// question doesn't exist
		$this->assertFalse( $this->obj->questions()->get_question( 9999999 ) );

	}

	/**
	 * Test the get_questions() method.
	 *
	 * @since 3.16.0
	 *
	 * @return void
	 */
	public function test_get_questions() {

		$this->create( 'test title' );
		$i = 1;
		while( $i <= 3 ) {
			$this->obj->questions()->create_question();
			$i++;
		}

		// check default 'questions'
		$questions = $this->obj->get_questions();
		$this->assertEquals( 3, count( $questions ) );
		foreach ( $questions as $question ) {
			$this->assertInstanceOf( 'LLMS_Question', $question );
		}

		// check posts return
		$questions = $this->obj->get_questions( 'posts' );
		$this->assertEquals( 3, count( $questions ) );
		foreach ( $questions as $question ) {
			$this->assertInstanceOf( 'WP_Post', $question );
		}

		// check id return
		$questions = $this->obj->get_questions( 'ids' );
		$this->assertEquals( 3, count( $questions ) );
		foreach ( $questions as $question ) {
			$this->assertTrue( is_numeric( $question ) );
		}

	}

	/**
	 * Test the update_question() method.
	 *
	 * @since 3.16.0
	 *
	 * @return void
	 */
	public function test_update_question() {

		$this->create( 'test title' );

		// create when no id supplied
		$id = $this->obj->questions()->update_question();
		$this->assertTrue( is_numeric( $id ) );

		// update should return it's own id
		$this->assertEquals( $id, $this->obj->questions()->update_question( array( 'id' => $id ) ) );

		// can't update from another quiz
		$this->create( 'second question' );
		$this->assertFalse( $this->obj->questions()->update_question( array( 'id' => $id ) ) );

	}

}
