<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    use DefaultRender;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(Request $request)
    {
        return view('index', [
            'loggers' => $this->renderLoggers($this->request)
        ]);
    }

    public function about()
    {
        return view('about', [
            'loggers' => $this->renderLoggers($this->request)
        ]);
    }

    public function rules()
    {
        return view('rules', [
            'loggers' => $this->renderLoggers($this->request)
        ]);
    }
}
