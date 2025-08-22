<?php

namespace App\Services\Concrete;

use App\Models\SocialMedia;
use App\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SocialMediaService
{
      protected $model_social_media;
      public function __construct()
      {
            // set the model
            $this->model_social_media = new Repository(new SocialMedia);
      }

      public function getSource()
      {
            $model = $this->model_social_media->getModel()::where('is_deleted', 0);
            $data = DataTables::of($model)
                  ->addColumn('icon', function ($item) {
                        return '<img src="storage/app/public/' . $item->icon . '" style="width:20px;" />';
                  })
                  ->addColumn('is_active', function ($item) {
                        if ($item->is_active == 1) {
                              $active = '<label class="switch pr-5 switch-primary mr-3"><input type="checkbox" checked="checked" id="active" data-id="' . $item->id . '"><span class="slider"></span></label>';
                        } else {
                              $active = '<label class="switch pr-5 switch-primary mr-3"><input type="checkbox" id="active" data-id="' . $item->id . '"><span class="slider"></span></label>';
                        }
                        return $active;
                  })
                  ->addColumn('action', function ($item) {
                        $action_column = '';
                        $edit_column    = "<a class='text-success mr-2' href='social-media/edit/" . $item->id . "'><i title='Add' class='nav-icon mr-2 fa fa-edit'></i>Edit</a>";
                        $delete_column    = "<a class='text-danger mr-2' id='deleteSocialMedia' href='javascript:void(0)' data-toggle='tooltip'  data-id='" . $item->id . "' data-original-title='delete'><i title='Delete' class='nav-icon mr-2 fa fa-trash'></i>Delete</a>";
                        if (Auth::user()->can('social_media_edit'))
                        $action_column .= $edit_column;
                        if (Auth::user()->can('social_media_delete'))
                        $action_column .= $delete_column;

                        return $action_column;
                  })
                  ->rawColumns(['icon', 'is_active', 'action'])
                  ->make(true);
            return $data;
      }
      // get all
      public function getAll()
      {
            return $this->model_social_media->getModel()::where('is_deleted', 0)->get()->map(function ($item) {
                  $item->icon = url('storage/app/public/' . $item->icon);
                  return $item;
            });
      }
      // save
      public function save($obj)
      {

            if ($obj['id'] != null && $obj['id'] != '') {
                  $obj['updatedby_id'] = Auth::User()->id;
                  $this->model_social_media->update($obj, $obj['id']);
                  $saved_obj = $this->model_social_media->find($obj['id']);
            } else {
                  $obj['createdby_id'] = Auth::User()->id;
                  $saved_obj = $this->model_social_media->create($obj);
            }

            if (!$saved_obj)
                  return false;

            return $saved_obj;
      }

      // get by id
      public function getById($id)
      {
            $social_media = $this->model_social_media->getModel()::find($id);

            if (!$social_media)
                  return false;

            return $social_media;
      }
      public function statusById($id)
      {
            $social_media = $this->model_social_media->getModel()::find($id);
            if ($social_media->is_active == 1) {
                  $social_media->is_active = 0;
            } else {

                  $social_media->is_active = 1;
            }
            $social_media->update();
            if (!$social_media)
                  return false;

            return $social_media;
      }

      // delete by id
      public function deleteById($id)
      {
            $social_media = $this->model_social_media->getModel()::find($id);
            $social_media->is_deleted = 1;
            $social_media->deletedby_id = Auth::user()->id;
            $social_media->date_deleted = Carbon::now();
            $social_media->update();

            if (!$social_media)
                  return false;

            return $social_media;
      }
}
