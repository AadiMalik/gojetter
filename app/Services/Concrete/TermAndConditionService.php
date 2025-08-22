<?php

namespace App\Services\Concrete;

use App\Models\TermAndCondition;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TermAndConditionService
{
    protected $model_term;
    public function __construct()
    {
        // set the model
        $this->model_term = new Repository(new TermAndCondition);
    }
    //Bead type
    public function getSource()
    {
        $model = $this->model_term->getModel()::query();
        $data = DataTables::of($model)
            ->addColumn('action', function ($item) {
                $action_column = '';
                $edit_column    = "<a class='text-success mr-2' href='terms/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                if (Auth::user()->can('term_and_condition_edit'))
                $action_column .= $edit_column;

                return $action_column;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data;
    }
    // get latest
    public function getLatest()
    {
        return $this->model_term->getModel()::orderBy('created_at','DESC')->first();
    }
    // update
    public function update($obj)
    {

        $obj['updatedby_id'] = Auth::User()->id;
        $this->model_term->update($obj, $obj['id']);
        $saved_obj = $this->model_term->find($obj['id']);

        if (!$saved_obj)
            return false;

        return $saved_obj;
    }

    // get by id
    public function getById($id)
    {
        $terms = $this->model_term->getModel()::find($id);

        if (!$terms)
            return false;

        return $terms;
    }

}
