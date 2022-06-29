<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Parser;

use App\{User, Model};

class UserTest extends TestCase
{

  protected $model;

  public function setUp(): void
  {
   $this->pdo = new \PDO('sqlite::memory:');
   $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

   $this->pdo->exec(
       "CREATE TABLE IF NOT EXISTS user
       (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       username VARCHAR( 225 ),
       createdAt DATETIME
       )
       "
   );

   $this->model = new Model($this->pdo);
   $parser =  new Parser;
   $users = $parser->parse(file_get_contents(__DIR__ . '/_data/seed.yml'))['users'];
   $this->model->hydrate($users);
  }

  /**
   * @test count method insert
   */
  public function testSeedsCreate()
  {
    $this->assertEquals(11, count($this->model));
  }

  /**
   * @test save method insert
   */
  public function testInsertSave()
  {
    $user = new User;
    $user->username = 'Phil';
    $user->createdAt = (new DateTime)->format('Y-m-d h:m:s') ;
    $this->model->save($user);

    $users = $this->model->all() ;
    $userLast = array_pop($users);
    $this->assertEquals($userLast->id, $this->model->lastId());
  }

  /**
   * @test save method update
   */
  public function testUpdateSave()
  {
    $user = new User;
    $user->username = 'Galois';
    $user->id = 1;
    $this->model->update($user);

    $userOne = $this->model->find(1);

    $this->assertEquals($userOne->username,'Galois' );
  }

  /**
   * @test delete resource by id
   */
  public function testDelete()
  {
    $this->model->delete(1);

    $this->assertTrue($this->model->find(1) ===false );
  }
}
