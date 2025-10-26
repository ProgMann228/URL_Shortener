<?php

namespace App\Http\Controllers;

use App\Http\Requests\URLRequest;
use App\Models\URLModel;
use App\Services\URLService;
use Illuminate\Http\Request;

class URLController extends Controller
{
    //свойство класса контроллера - просто переменная внутри объекта контроллера
    protected $service;
    public function __construct(URLService $url_service){
        //кладем объект сервиса в это свойство объекта контроллера
        $this->service = $url_service;
    }

    public function store(URLRequest $request){
        $original_url = $request->validated()['original_url'];
        $user = $request->user;
        $short_url = $this->service->store($original_url,$user);

        return response()->json([
            'original_url' => $original_url,
            'short_url' => $short_url,
        ]);
    }
    public function show(string $short_url){
        $data = $this->service->show($short_url);

        return response()->json([
            'redirect_to' => $data['original_url'],
            'user_data: ' => [
                'ip_address' => $data['user_data']->ip,
                'user_agent' => $data['user_data']->user_agent,
                'visited_at' => $data['user_data']->visited_at,
            ]
        ]);
    }
}
