<?php

namespace App\Services\Concrete;

use App\Models\Setting;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;

class SettingService
{
      protected $model_setting;
      public function __construct()
      {
            // set the model
            $this->model_setting = new Repository(new Setting);
      }
      // save
      public function save($obj)
      {
            $saved_obj = $this->model_setting->getModel()::updateOrCreate(
                  ['id' => $obj['id'] ?? null],
                  $obj
            );

            if (!$saved_obj) {
                  return false;
            }

            return $saved_obj;
      }

      // get setting
      public function getSetting()
      {
            $setting = $this->model_setting->getModel()::first();

            if (!$setting)
                  return null;

            return $setting;
      }
}
