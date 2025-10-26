<?php

namespace App\Services;
use App\Models\URLModel;
use App\Http\Requests\URLRequest;
use App\Models\VisitModel;
use Illuminate\Support\Str;

class URLService
{
    public function store(string $original_url, $user){
        $link = new URLModel();
        $link->original_url = $original_url;
        $link->short_url = Str::random(6);
        $link->user_id = $user->id;
        $link->save();

        return $link->short_url;
    }
    public function show(string $short_url){
        $link = URLModel::where('short_url', $short_url)->first();

        if(!$link){
            abort(404);
        }

        $user_data = VisitModel::create([
            'url_id' => $link->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'visited_at' => now(),
        ]);

        return [
            'original_url' => $link->original_url,
            'user_data' => $user_data,
            ];
    }
}
