<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Repositories\MessageRepositoryInterface;
use Illuminate\Http\Request;

class MessageController extends Controller{
    protected $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository){
        $this->messageRepository = $messageRepository;
    }

    public function index(){
        $messages = $this->messageRepository->all();
        $unreaded_count = $this->messageRepository->unreaded_count();
        return view('backend.messages.index', compact('messages', 'unreaded_count'));
    }
    
    public function read(Message $message){
        $this->messageRepository->read($message->id);
        return redirect()->back();
    }
    
    public function read_all(){
        $this->messageRepository->read_all();
        return redirect()->back();
    }
    
    public function delete(Message $message){
        $this->messageRepository->delete($message->id);
        return redirect()->back();
    }
}