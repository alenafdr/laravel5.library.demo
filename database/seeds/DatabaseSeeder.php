<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Book;
use App\Models\BookUnit;
use App\Models\BooksInHand;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        
        $this->call(BooksTableSeeder::class);
        
        $this->call(BookUnitsTableSeeder::class);
        
        $this->call(BooksInHandsTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * UsersTable
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();
      
      User::create([
        'email' => 'ivanov@mail.ru',
        'name' => 'Ivanov',
        'password' => bcrypt('123456')
      ]);
      
      User::create([
        'email' => 'petrov@mail.ru',
        'name' => 'Petrov',
        'password' => bcrypt('123456')
      ]);
      
      User::create([
        'email' => 'sidorov@mail.ru',
        'name' => 'Sidorov',
        'password' => bcrypt('123456')
      ]);
      
      User::create([
        'email' => 'smirnoff@mail.ru',
        'name' => 'Smirnoff',
        'password' => bcrypt('123456')
      ]);
    }
}

class BooksTableSeeder extends Seeder
{
    /**
     * BooksTable
     * @return void
     */
    public function run()
    {
      DB::table('books')->delete();
      
      Book::create([
        'name' => 'Java 8. Полное руководство',
        'autor' => 'Герберт Шилдт',
        'description' => 'Книга Java 8. Полное руководство является исчерпывающим руководством по программированию на языке Java.  В этом справочном пособии, полностью обновленном с учетом последней версии Java SE 8, поясняется, как разрабатывать, компилировать, отлаживать и выполнять программы на языке программирования Java.'
      ]);
      
      Book::create([
        'name' => 'Глубина',
        'autor' => 'Сергей Лукьяненко',
        'description' => 'Знаменитый цикл мастера отечественной фантастики Сергея Лукьяненко, получивший культовый статус благодаря динамичному сюжету, уникальной авторской манере повествования и пророческому посылу: величайшее чудо, созданное человечеством, может оказаться как даром, так и проклятием, если использовать его бездумно. Итак, добро пожаловать в виртуальный город Диптаун - столицу киберреальности!'
      ]);
      
      Book::create([
        'name' => 'Искатели неба',
        'autor' => 'Сергей Лукьяненко',
        'description' => 'Земля, которая не знает железа. Здесь люди ездят на лошадях и в экипажах, не пользуются электричеством и почти не знают огнестрельного оружия, - а авиаторы поднимают в воздух деревянные планеры.'
      ]);
      
      Book::create([
        'name' => 'Спектр',
        'autor' => 'Сергей Лукьяненко',
        'description' => 'Действие происходит примерно в 2018 году. За 10 лет до описываемых событий на Землю прибыли пришельцы, называющие себя ключниками.'
      ]);
      
      Book::create([
        'name' => 'Понедельник начинается в субботу',
        'autor' => 'братья Стругацкие',
        'description' => 'Повесть состоит из трёх частей: «Суета вокруг дивана», «Суета сует», «Всяческая суета».'
      ]);
    }
}

class BookUnitsTableSeeder extends Seeder
{
    /**
     * BookUnitsTable
     * @return void
     */
    public function run()
    {
      DB::table('book_units')->delete();
      
      BookUnit::create(['barcode' => '00000001', 'book_id' => 1]);
      BookUnit::create(['barcode' => '00000002', 'book_id' => 2]);
      BookUnit::create(['barcode' => '00000003', 'book_id' => 3]);
      BookUnit::create(['barcode' => '00000004', 'book_id' => 4]);
      BookUnit::create(['barcode' => '00000005', 'book_id' => 5]);
      
      BookUnit::create(['barcode' => '00000006', 'book_id' => 1]);
      BookUnit::create(['barcode' => '00000007', 'book_id' => 2]);
      BookUnit::create(['barcode' => '00000008', 'book_id' => 3]);
      BookUnit::create(['barcode' => '00000009', 'book_id' => 4]);
      BookUnit::create(['barcode' => '00000010', 'book_id' => 5]);
      
      BookUnit::create(['barcode' => '00000011', 'book_id' => 1]);
      BookUnit::create(['barcode' => '00000012', 'book_id' => 2]);
      BookUnit::create(['barcode' => '00000013', 'book_id' => 3]);
      BookUnit::create(['barcode' => '00000014', 'book_id' => 4]);
      BookUnit::create(['barcode' => '00000015', 'book_id' => 5]);
      
    }
}

class BooksInHandsTableSeeder extends Seeder
{
    /**
     * BooksInHandsTable
     * @return void
     */
    public function run()
    {
      DB::table('books_in_hands')->delete();
      
      BooksInHand::create(['book_unit_id' => 1, 'user_id' => 1, 'take_at' => '2017-01-01 10:13:24', 'return_at' => '2017-01-02 16:13:24']);
      BooksInHand::create(['book_unit_id' => 2, 'user_id' => 1, 'take_at' => '2017-01-02 10:13:24', 'return_at' => '2017-01-03 16:13:24']);
      BooksInHand::create(['book_unit_id' => 3, 'user_id' => 1, 'take_at' => '2017-01-03 10:13:24', 'return_at' => '2017-01-04 16:13:24']);
      BooksInHand::create(['book_unit_id' => 4, 'user_id' => 1, 'take_at' => '2017-01-04 10:13:24']);
      BooksInHand::create(['book_unit_id' => 5, 'user_id' => 1, 'take_at' => '2017-01-05 10:13:24']);

      BooksInHand::create(['book_unit_id' => 6, 'user_id' => 2, 'take_at' => '2017-01-01 10:13:24', 'return_at' => '2017-01-02 16:13:24']);
      BooksInHand::create(['book_unit_id' => 7, 'user_id' => 2, 'take_at' => '2017-01-02 10:13:24', 'return_at' => '2017-01-03 16:13:24']);
      BooksInHand::create(['book_unit_id' => 8, 'user_id' => 2, 'take_at' => '2017-01-03 10:13:24']);
      
      BooksInHand::create(['book_unit_id' => 12, 'user_id' => 3, 'take_at' => '2017-01-04 10:13:24']);
      BooksInHand::create(['book_unit_id' => 13, 'user_id' => 3, 'take_at' => '2017-01-05 10:13:24']);
      
      BooksInHand::create(['book_unit_id' => 1,  'user_id' => 4, 'take_at' => '2017-01-10 10:13:24', 'return_at' => '2017-01-11 16:13:24']);
      BooksInHand::create(['book_unit_id' => 2,  'user_id' => 4, 'take_at' => '2017-01-11 10:13:24', 'return_at' => '2017-01-12 16:13:24']);
      BooksInHand::create(['book_unit_id' => 3,  'user_id' => 4, 'take_at' => '2017-01-12 10:13:24', 'return_at' => '2017-01-13 16:13:24']);
      BooksInHand::create(['book_unit_id' => 9,  'user_id' => 4, 'take_at' => '2017-01-13 10:13:24', 'return_at' => '2017-01-14 16:13:24']);
      BooksInHand::create(['book_unit_id' => 10, 'user_id' => 4, 'take_at' => '2017-01-14 10:13:24', 'return_at' => '2017-01-15 16:13:24']);

    }
}