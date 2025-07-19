<?php

namespace App\Services\Concrete;

use App\Mail\ReplyContactUs;
use App\Models\ContactUsMessage;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class ContactUsMessageService
{
    protected $model_contact_us_message;
    public function __construct()
    {
        // set the model
        $this->model_contact_us_message = new Repository(new ContactUsMessage);
    }
    //data
    public function getAll()
    {
        return $this->model_contact_us_message->getModel()::where('is_deleted', 0)
            ->where('parent_id', null)
            ->orderBy('is_read', 'ASC')
            ->orderBy('created_at')
            ->get();
    }
    // save
    public function save($obj)
    {

        $saved_obj = $this->model_contact_us_message->create($obj);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }
    // reply
    public function reply($obj)
    {

        $obj['createdby_id'] = Auth::User()->id;
        $saved_obj = $this->model_contact_us_message->create($obj);

        if (!$saved_obj)
            return false;

        $parent = $this->getById($obj['parent_id']);
        $detail = [
            "user_name" => $parent->name,
            "user_email" => $parent->email,
            "message" => $parent->message,
            "reply" => $obj['message']
        ];
        Mail::to($detail['user_email'])->send(new ReplyContactUs($detail));

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $contact_us_message = $this->model_contact_us_message->getModel()::with(['replies', 'user'])->find($id);

        if (!$contact_us_message)
            return false;

        return $contact_us_message;
    }

    // delete by id
    public function deleteById($id)
    {
        $contact_us_message = $this->model_contact_us_message->getModel()::find($id);
        $contact_us_message->is_deleted = 1;
        $contact_us_message->deletedby_id = Auth::user()->id;
        $contact_us_message->date_deleted = Carbon::now();
        $contact_us_message->update();

        if (!$contact_us_message)
            return false;

        return $contact_us_message;
    }

    // is read by id
    public function readById($id)
    {
        $contact_us_message = $this->model_contact_us_message->getModel()::find($id);
        $contact_us_message->is_read = 1;
        $contact_us_message->updatedby_id = Auth::user()->id;
        $contact_us_message->updated_at = Carbon::now();
        $contact_us_message->update();

        if (!$contact_us_message)
            return false;

        return $contact_us_message;
    }
}
