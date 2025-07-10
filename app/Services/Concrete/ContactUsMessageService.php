<?php

namespace App\Services\Concrete;

use App\Models\ContactUsMessage;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContactUsMessageService
{
    protected $model_contact_us_message;
    public function __construct()
    {
        // set the model
        $this->model_contact_us_message = new Repository(new ContactUsMessage);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_contact_us_message->getModel()::where('is_deleted', 0);
        $data = DataTables::of($model)
            ->addColumn('action', function ($item) {
                $action_column = '';
                $edit_column    = "<a class='text-success mr-2' href='contact-us-message/reply/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                $delete_column    = "<a class='text-danger mr-2' id='deleteContactUsMessage' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                // if (Auth::user()->can('contact_us_message_edit'))
                $action_column .= $edit_column;
                // if (Auth::user()->can('contact_us_message_delete'))
                $action_column .= $delete_column;

                return $action_column;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data;
    }
    // get all
    public function getAll()
    {
        return $this->model_contact_us_message->getModel()::get();
    }
    // update
    public function update($obj)
    {

        $obj['updatedby_id'] = Auth::User()->id;
        $this->model_contact_us_message->update($obj, $obj['id']);
        $saved_obj = $this->model_contact_us_message->find($obj['id']);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $contact_us_message = $this->model_contact_us_message->getModel()::find($id);

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

}
