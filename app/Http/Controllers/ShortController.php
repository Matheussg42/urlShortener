<?php


namespace App\Http\Controllers;
use App\Models\Short;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class ShortController
{

    public function makeShortUrl(Request $request)
    {
        $url = $request['url'];
        if(empty($url)){
            throw new Exception('URL not sent', 403);
        }

        $token = self::getSiteToken($url);
        $title = self::getSiteTitle($url);

        if(!$title){
            throw new Exception('This URL has no title', 403);
        }

        $dataObj = [
            'url' => $url ,
            'short' => $token,
            'title' =>$title
        ];

        return response()->json(Short::create($dataObj));
    }

    public function getOriginalUrl(string $short)
    {
        if(empty($short)){
            throw new Exception('Shortener not sent', 403);
        }
        $originalURL = DB::table('shorts')->where('short', $short)->pluck('url')->first();

        if(!$originalURL){
            throw new Exception('Shortener not found', 404);
        }

        DB::table('shorts')->where('short', $short)->increment('hint', 1);

        return response()->json(['site' => $originalURL], 200);
    }

    public function getPagesRank()
    {
        return response()->json(DB::table('shorts')->select('title', 'url', 'hint')->orderBy('hint', 'DESC')->take(100)->get());
    }

    static public function getSiteTitle(string $url): string
    {
        $str = file_get_contents($url);
        $title = '';

        if(strlen($str)>0){
            preg_match("/\<title\>(.*)\<\/title\>/",$str,$titleArr);
            return $titleArr[1];
        }
    }

    static public function getSiteToken(string $url): string
    {
        $urlToken = $url . "@" . date('Y-m-d H:i:s');
        return substr(md5($urlToken),0,10);
    }
}
