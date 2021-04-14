<?php
declare(strict_types=1);
use \PHPUnit\Framework\TestCase;

/**
*  Corresponding Class to test Query class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class ClientTest extends TestCase{

  /**
  * Just check if the Query has no syntax error
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError() {

		$var = new Gist\Analytics\Client([
			'api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiemFjQGdpc3QtYXBwcy5jb20iLCJhY2NvdW50Ijo2LCJzZWNyZXQiOiJhcGlfc2VjXzIzRFRJYzRvY1hyT1kxMTZlczBqYys3WTNBYzMifQ.Nd39KMURWhxZUjA5c1UPWuWKb-oXPOvSKn6QJ1AZGLw',
			'sandbox' => true
		]);

		$this->assertTrue(is_object($var));

		unset($var);

  }

  /**
  * Just check if the Query has no syntax error
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testMethod1() {

		$var = new Gist\Analytics\Client([
			'api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiemFjQGdpc3QtYXBwcy5jb20iLCJhY2NvdW50Ijo2LCJzZWNyZXQiOiJhcGlfc2VjXzIzRFRJYzRvY1hyT1kxMTZlczBqYys3WTNBYzMifQ.Nd39KMURWhxZUjA5c1UPWuWKb-oXPOvSKn6QJ1AZGLw',
			'sandbox' => true
		]);

		$req = $var->createRequest("query");

		$d1 = new \DateTime();
		$d2 = new \DateTime();

    $req
    ->addName('test')
    ->addStartDate($d1->format('c'))
    ->addEndDate($d2->format('c'))
    ->addQuery([])
    ->addMeta([])
    ->addFormat("default")
    ;

		$this->assertTrue(is_object($req));

		unset($var);

		unset($req);

		unset($d1);

		unset($d2);

  }

}
