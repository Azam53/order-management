<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
       // test to check whether the user was registered or not
       $this->seeInDatabase('users', ['email' => 'azam@gmail.com']);
     
       // test to check if the login page appears properly
       $this->visit('/login')
             ->see('Login');

      // test to successfully login and see the secure landing page. 
        $this->visit('/login')
         ->type('azam@gmail.com', 'email')
         ->type('1234567', 'password')
         ->press('Login')
         ->seePageIs('/order');

      // test to check search work properly on the dashboard
        $this->visit('/order')
	 ->type('Pepsi', 'search_term')
	 ->press('Search')
	 ->seePageIs('/search?duration=all&search_term=Pepsi');
    
      
     // test to check search edit work properly or not on dashboard
          $this->visit('/order')
           ->press('Edit')
           ->seePageIs('/order/7/edit');
     
     // test to check search edit work properly or not on dashboard
          $this->visit('/product/create')
           ->type('test product','p_name')
           ->type('test_type','type')
           ->type('3','price')
           ->seePageIs('/product/create');
       //  $this->seeInDatabase('product', ['p_name' => 'test product']);
      
    }
}
