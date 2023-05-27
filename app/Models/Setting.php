<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['title', 'content', 'address'];
    protected $fillable = ['id', 'logo', 'favicon', 'facebook', 'instagram', 'phone', 'email'];
    protected $table = 'settings';


    public static function check_setting()
    {
        $settings = self::all();

        if (count($settings) < 1) {
            $data = [
                'id' => 1,
                'facebook' => 'Facebook',
                'instagram' => 'Instagram',
                'phone' => '000000000',
                'email' => 'settings@email.com',

            ];

            $data['ar']['title'] = 'مدونة إلكترونية';
            $data['en']['title'] = 'Blog';
            $data['fr']['title'] = 'Blog';


            // foreach (config('app.languages') as $key => $value) {
            //     $data[$key]['title'] = $value;
            // }


            self::create($data);
        }

        return self::first();
    }
}
