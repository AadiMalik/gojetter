<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_name',
        'tab_logo',
        'admin_panel_logo',
        'mobile_application_logo',
        'mobile_application_home_image',
        'website_logo',
        'website_page_image',
        'support_email',
        'contact_number'
    ];

    protected $appends = [
        'tab_logo_url',
        'admin_panel_logo_url',
        'mobile_application_logo_url',
        'mobile_application_home_image_url',
        'website_logo_url',
        'website_page_image_url'
    ];

    public function getTabLogoUrlAttribute()
    {
        return $this->tab_logo ? asset('storage/app/public/' . $this->tab_logo) : null;
    }

    public function getAdminPanelLogoUrlAttribute()
    {
        return $this->admin_panel_logo ? asset('storage/app/public/' . $this->admin_panel_logo) : null;
    }

    public function getMobileApplicationLogoUrlAttribute()
    {
        return $this->mobile_application_logo ? asset('storage/app/public/' . $this->mobile_application_logo) : null;
    }

    public function getMobileApplicationHomeImageUrlAttribute()
    {
        return $this->mobile_application_home_image ? asset('storage/app/public/' . $this->mobile_application_home_image) : null;
    }

    public function getWebsiteLogoUrlAttribute()
    {
        return $this->website_logo ? asset('storage/app/public/' . $this->website_logo) : null;
    }

    public function getWebsitePageImageUrlAttribute()
    {
        return $this->website_page_image ? asset('storage/app/public/' . $this->website_page_image) : null;
    }
}
