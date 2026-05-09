<?php

require_once APP_PATH . '/models/Property.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('pages/home', [
            'title' => 'Memon Estate | Luxury Real Estate in Karachi',
            'properties' => Property::featured(),
        ]);
    }
}
