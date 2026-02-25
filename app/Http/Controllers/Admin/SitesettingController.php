<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Models\ConfigDictionary;
use App\Traits\ChecksPermission;
use Illuminate\Http\Request;

class SitesettingController extends Controller
{
    use ChecksPermission;

    protected string $permissionPrefix = 'sitesetting';

    public function index()
    {
        return view('admin.resource.create', [
            'name' => 'admin.sitesetting',
            'permissionPrefix' => 'sitesetting',
            'fields' => [
                Field::text('website_name')->label('Website Name')->value(ConfigDictionary::get('website_name'))->required(),
                Field::file('logo')->label('Logo')->accept('image/jpeg,image/png,image/jpg'),
                Field::file('meta_banner')->label('Description Image/Welcome')->accept('image/jpeg,image/png,image/jpg'),
                Field::text('phone')->label('Phone Number (Call Us)')->value(ConfigDictionary::get('phone'))->required(),
                Field::text('email')->label('Email')->value(ConfigDictionary::get('email'))->required(),
                Field::text('address')->label('Address')->value(ConfigDictionary::get('address'))->required(),
                Field::file('fav_icon')->label('Fav Icon')->accept('image/jpeg,image/png,image/jpg'),
                Field::text('fb_share_for_withdraw')->label('Link to share on facebook ')->value(ConfigDictionary::get('fb_share_for_withdraw')),
                Field::text('youtube')->label('Link youtube')->value(ConfigDictionary::get('youtube')),
                Field::text('twit')->label('Link Twit')->value(ConfigDictionary::get('twit')),
                Field::text('linkend')->label('Link linkend')->value(ConfigDictionary::get('linkend')),
                Field::text('meta_tags')->label('Meta Tags (Comma seperated) (SEO)')->value(ConfigDictionary::get('meta_tags'))->required(),
                Field::textarea('description')->label('Message Form MD')->value(ConfigDictionary::get('description'))->required()->isEditor(),
     
                Field::textarea('meta_description')->label('Company Profile')->value(ConfigDictionary::get('meta_description'))->required()->isEditor2(),
                Field::textarea('about_us')->label('About Us')->value(ConfigDictionary::get('about_us'))->required()->isEditor3(),
                Field::textarea('inquire')->label('Capability')->value(ConfigDictionary::get('inquire'))->required()->isEditor4(),
                Field::textarea('culturalactivity')->label('culturalactivity')->value(ConfigDictionary::get('culturalactivity'))->required()->isEditor5(),
                Field::textarea('mechineauto')->label('mechine automationj')->value(ConfigDictionary::get('mechineauto'))->required()->isEditor6(),
                Field::textarea('mefacturing')->label('mefacturing Process')->value(ConfigDictionary::get('mefacturing'))->required()->isEditor7(),
                Field::text('topnotice1')->label('Top Notice 1')->value(ConfigDictionary::get('topnotice1'))->required(),
                Field::text('topnotice2')->label('Top Notice 2')->value(ConfigDictionary::get('topnotice2'))->required(),
                Field::text('topnotice3')->label('Top Notice 3')->value(ConfigDictionary::get('topnotice3'))->required(),
                
            ],
            'heading' => ['index' => 'Site Setting', 'create' => 'Site Setting'],
            'buttonText' => 'Save Changes',
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'website_name' => 'required',
            'meta_tags' => 'required',
            'meta_description' => 'required',
            'logo' => 'nullable|file|mimes:jpeg,jpg,png',
            'fav_icon' => 'nullable|file|mimes:jpeg,jpg,png',
            'meta_banner' => 'nullable|file|mimes:jpeg,jpg,png',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'description' => 'required',
            'fb_share_for_withdraw' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkend' => 'nullable|url',
            'twit' => 'nullable|url',
            'topnotice1' => 'required',
            'topnotice2' => 'required',
            'topnotice3' => 'required',
            'about_us' => 'nullable',
            'inquire' => 'nullable',
            'culturalactivity' => 'nullable',
            'mechineauto' => 'nullable',
            'mefacturing' => 'nullable',


        ]);

        if ($request->hasFile('logo')) {
            if ($logo = ConfigDictionary::get('logo')) {
                Image::delete($logo);
            }
            $validated['logo'] = Image::store(
                'logo',
                'website',
                'logo.'.random_int(0, 10000).'.'.$validated['logo']->clientExtension()
            );
        }

        if ($request->hasFile('meta_banner')) {
            if ($meta_banner = ConfigDictionary::get('meta_banner')) {
                Image::delete($meta_banner);
            }
            $validated['meta_banner'] = Image::store(
                'meta_banner',
                'website',
                'banner.'.random_int(0, 10000).'.'.$validated['meta_banner']->clientExtension()
            );
        }
        if ($request->hasFile('fav_icon')) {
            if ($fav_icon = ConfigDictionary::get('fav_icon')) {
                Image::delete($fav_icon);
            }
            $validated['fav_icon'] = Image::store(
                'fav_icon',
                'website',
                'fav_icon.'.random_int(0, 10000).'.'.$validated['fav_icon']->clientExtension()
            );
        }

        return response()->report(ConfigDictionary::setMany($validated), 'Setting updated successfully');
    }
}
