<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeControllerTest extends TestCase
{
    public function testIndex()
    {
        // Mock a request
        $request = Request::create('/');

        // Instantiate the controller
        $controller = new HomeController();

        // Call the index method
        $response = $controller->index($request);

        // Assert that the returned value is a view
        $this->assertInstanceOf(View::class, $response);

        // Assert that the view name is 'home'
        $this->assertEquals('home', $response->name());
    }
}
