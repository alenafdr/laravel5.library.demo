<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiV1BooksInHandControllerTest extends TestCase
{
    /**
     * Статистика: Тест на роутинг, ответ 'success' должен быть true 
     *
     * @return void
     */
    public function testStatisticsSuccess()
    {
      $response = $this->call('GET', 'api/v1/books-in-hands/statistics');
      $content = json_decode($response->getContent(), true);
      $this->assertTrue($content['success']);
    }
    
    /**
     * Статистика: Количество записей ответа должно совпадать с количеством пользователей
     * Косвенное тестирование на group by
     * @return void
     */
    public function testStatisticsCount()
    {
      $response = $this->call('GET', 'api/v1/books-in-hands/statistics');
      $content = json_decode($response->getContent(), true);
      $this->assertTrue(App\Models\User::count() === count($content['data']));
    }
    
    /**
     * Статистика: Тест на сортировку по убыванию
     * 
     * @return void
     */
    public function testStatisticsOrder()
    {
      $response = $this->call('GET', 'api/v1/books-in-hands/statistics');
      $content = json_decode($response->getContent(), true);
      
      $count = App\Models\BooksInHand::count(); // Изначально счетчик макимальный
      $test  = true;
      foreach($content['data'] as $item) {
        if ($count < $item['count']) {
          $test = false;
        } 
        $count = $item['count'];
      }
      
      $this->assertTrue($test);
    }
    
    
    /**
     * Создание записи журнала выдачи книг
     *
     * @return void
     */
    public function testStoreFirstSuccess()
    {
      $user_id = App\Models\User::first()->id;
      $book_unit_id = App\Models\BookUnit::first()->id;
      
      App\Models\BooksInHand::where('book_unit_id', '=', $book_unit_id)
                            ->where('user_id', '=', $user_id)
                            ->delete();
      
      $response = $this->call('POST', 'api/v1/books-in-hands', [
        'user_id'      => $user_id,
        'book_unit_id' => $book_unit_id
      ]);
      $content = json_decode($response->getContent(), true);
      $this->assertTrue($content['success']);
    }
    
    /**
     * Создание записи журнала выдачи книг
     * Попытка повторного создания
     * @return void
     */
    public function testStoreSecondSuccess()
    {
      $user_id = App\Models\User::first()->id;
      $book_unit_id = App\Models\BookUnit::first()->id;
      
      $response = $this->call('POST', 'api/v1/books-in-hands', [
        'user_id'      => $user_id,
        'book_unit_id' => $book_unit_id
      ]);
      $content = json_decode($response->getContent(), true);
      $this->assertTrue(!$content['success']);
    }
    
    /**
     * Создание записи журнала выдачи книг
     * Попытка создания записи с заведомо "плохими входными данными" 
     * @return void
     */
    public function testStoreBadRequest1()
    {
      $user_id = App\Models\User::first()->id;
      //$book_unit_id = App\Models\BookUnit::first()->id;
      
      $response = $this->call('POST', 'api/v1/books-in-hands', [
        'user_id'      => $user_id,
        //'book_unit_id' => $book_unit_id
      ]);
      $content = json_decode($response->getContent(), true);
      $this->assertTrue(!$content['success']);
    }
  
    /**
     * Создание записи журнала выдачи книг
     * Попытка создания записи с заведомо "плохими входными данными" 
     * @return void
     */
    public function testStoreBadRequest2()
    {
      //$user_id = App\Models\User::first()->id;
      $book_unit_id = App\Models\BookUnit::first()->id;

      $response = $this->call('POST', 'api/v1/books-in-hands', [
        //'user_id'      => $user_id,
        'book_unit_id' => $book_unit_id
      ]);
      $content = json_decode($response->getContent(), true);
      $this->assertTrue(!$content['success']);
    }
    
    /**
     * Создание записи журнала выдачи книг
     * Попытка создания записи с заведомо "плохими входными данными" 
     * @return void
     */
    public function testStoreBadRequest3()
    {
      //$user_id = App\Models\User::first()->id;
      $book_unit_id = App\Models\BookUnit::first()->id;
      
      $response = $this->call('POST', 'api/v1/books-in-hands', [
        'user_id'      => 987654321,
        'book_unit_id' => $book_unit_id
      ]);
      $content = json_decode($response->getContent(), true);
      $this->assertTrue(!$content['success']);
    }
    
    /**
     * Создание записи журнала выдачи книг
     * Попытка создания записи с заведомо "плохими входными данными" 
     * @return void
     */
    public function testStoreBadRequest4()
    {
      $user_id = App\Models\User::first()->id;
      //$book_unit_id = App\Models\BookUnit::first()->id;
      
      $response = $this->call('POST', 'api/v1/books-in-hands', [
        'user_id'      => $user_id,
        'book_unit_id' => 987654321
      ]);
      $content = json_decode($response->getContent(), true);
      $this->assertTrue(!$content['success']);
    }
}
