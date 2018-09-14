<?php

namespace App\Http\Controllers;

use App\CardPr\Business\Letter;
use App\CardPr\Table\Message;
use App\CardPr\Table\Obtain;
use App\Jobs\StoreLetter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messaging.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messaging.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messageData = json_decode($request->message, true);

        $content = $messageData['content'];
        $author = $messageData['author'];

        $letter = new Letter($content, $author);

        $job = new StoreLetter($letter);
        dispatch($job);

        $response = (new Response())->setStatusCode(200);

        return $response;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time = time();

        $obtain = intval(Obtain::all('obtain_at')->first()->obtain_at);

        Obtain::query()->update(array('obtain_at' => $time));

        $messageList = Message::query()
            ->where('created_at', '>', '?')
            ->orderByDesc('created_at')
            ->setBindings([$obtain])
            ->get(['content', 'author', 'created_at'])->toArray();

        $body = json_encode($messageList);

        $response = (new Response())->setStatusCode(200)->setContent($body);
        return $response;
    }
}
