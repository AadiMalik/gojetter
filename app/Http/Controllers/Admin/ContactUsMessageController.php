<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\ContactUsMessageService;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ContactUsMessageController extends Controller
{
    use ResponseAPI;
    protected $contact_us_message;

    public function __construct(ContactUsMessageService $contact_us_message)
    {
        $this->contact_us_message = $contact_us_message;
    }
    public function index()
    {
        // abort_if(Gate::denies('contact_us_message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $messages = $this->contact_us_message->getAll();
        return view('contact_us_message.index', compact('messages'));
    }

    public function show($id)
    {
        // abort_if(Gate::denies('contact_us_message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // try {
        $message = $this->contact_us_message->getById($id);
        $contact_us_message = [
            'id' => $message->id,
            'sender_name' => $message->name,
            'subject' => $message->subject,
            'body' => $message->message,
            'date' => $message->created_at->format('d M, Y'),
            'avatar' => asset('public/dist-assets/images/faces/1.jpg'),
            'replies' => optional($message->replies)->map(function ($reply) {
                return [
                    'sender_name' => $reply->name,
                    'body' => $reply->message,
                    'date' => $reply->created_at->format('d M Y H:i'),
                ];
            })
        ];
        return  $this->success(
            $contact_us_message,
            ResponseMessage::SUCCESS,
            false
        );
        // } catch (Exception $e) {
        //     return $this->error(ResponseMessage::ERROR);
        // }
    }

    public function reply(Request $request)
    {
        // abort_if(Gate::denies('contact_us_message_reply'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'parent_id' => 'required|exists:contact_us_messages,id',
            'reply' => 'required|string|max:5000',
        ]);
        // try {
            $user = Auth::user();
            $data = [
                'name'          => $user->name ?? '',
                'email'         => $user->email ?? '',
                'phone'         => $user->phone ?? '',
                'subject'       => 'Reply',
                'message'       => $request->reply ?? '',
                'type'          => 'reply',
                'parent_id'     => $request->parent_id,
                'user_id'       => $user->id,
                'is_read'       => 1,
                'createdby_id'  => $user->id
            ];
            $contact_us_message = $this->contact_us_message->reply($data);
            return $this->success(
                $contact_us_message,
                ResponseMessage::EMAIL_SENT,
                true
            );
        // } catch (Exception $e) {
        //     return $this->error(ResponseMessage::ERROR);
        // }
    }

    public function destroy($id)
    {
        // abort_if(Gate::denies('contact_us_message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $contact_us_message = $this->contact_us_message->deleteById($id);
            return $this->success(
                $contact_us_message,
                ResponseMessage::DELETE,
                true
            );
        } catch (Exception $e) {
            return $this->error(ResponseMessage::ERROR);
        }
    }

    public function markAsRead($message_id)
    {
        $contact_us_message = $this->contact_us_message->readById($message_id);
        return $this->success(
            $contact_us_message,
            ResponseMessage::SUCCESS,
            false
        );
    }
}
