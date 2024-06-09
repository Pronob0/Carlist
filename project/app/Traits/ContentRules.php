<?php

namespace App\Traits;

trait ContentRules {
   
    public $commonRules = [
        'title'              => 'required',
        'heading'            => 'required',
        'sub_heading'        => 'required'
    ];

    public function hero()
    {
        return [
            'title'         => 'required',
            'color_title'   => 'required',
            'sub_heading'   => 'required',
            'background'    => 'image|mimes:jpg,jpeg,png|max:2048',
            'image'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'background_size' => 'required_with:background',
            'image_size'    => 'required_with:image'
        ];
    }

    public function categories(){
        return [
            'title'         => 'required',
            'color_title'         => 'required',
            'sub_heading'    => 'required',
        ];
    }

    public function login()
    {
        return [
            'title'         => 'required',
            'image'         => 'image|mimes:jpg,jpeg,png|max:2048',
            
        ];
    }

    public function register()
    {
        return [
            'title'         => 'required',
            'image'         => 'image|mimes:jpg,jpeg,png|max:2048',
            
        ];
    }

    public function vendor()
    {
        return [
            
            'heading'       => 'required',
            'description'  => 'required',
            'image'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'image_size'    => 'required_with:image'
        ];
    }



    public function service()
    {
        return $this->commonRules;
    }
    public function service_subcontent()
    {
        return [
            'icon'               => 'required',
            'title'              => 'required',
            'details'            => 'required'
        ];
    }


    public function how_subcontent()
    {
        return [
            'icon'               => 'required',
            'title'              => 'required',
            'details'            => 'required'
        ];
    }
    public function counter()
    {
        return [
            'title'              => 'required',
            'heading'            => 'required',
            'sub_heading'        => 'required',
            'button_name'        => 'required',
            'button_url'         => 'required',
        ];
    }

    public function counter_subcontent()
    {
        return [
            'image'              => 'image|mimes:jpg,jpeg,png,PNG|max:2048',
            'image_size'         => 'required_with:image',
            'title'              => 'required',
            'counter'            => 'required'
        ];
    }

    public function about()
    {
         return [
            
            'heading'            => 'required',
            'sub_heading'        => 'required'
        ];
    }

    public function about_subcontent()
    {
        return [
            'image'              => 'image|mimes:jpg,jpeg,png,PNG|max:2048',
            'image_size'         => 'required_with:image',
            'title'              => 'required',
            'number'            => 'required',
        ];
    }



    public function feature_subcontent()
    {
        return [
            'image'              => 'image|mimes:jpg,jpeg,png,PNG|max:2048',
            'image_size'         => 'required_with:image',
            'title'              => 'required',
            'details'            => 'required'
        ];
    }

    public function faq()
    {
        return $this->commonRules;
    }

    public function faq_subcontent()
    {
        return [
            'question'           => 'required',
            'answer'             => 'required'
        ];
    }

    public function testimonial()
    {
        return $this->commonRules;
    }

    

    public function testimonial_subcontent()
    {
        return [
            'image'              => 'image|mimes:jpg,jpeg,png,PNG|max:2048',
            'image_size'         => 'required_with:image',
            'name'               => 'required',
            'quote'              => 'required',
            'designation'        => 'required',
            'title'              => 'required',
            'star'               => 'required'

        ];
    }

    public function partner(){
        return $this->commonRules;
    }

    public function partner_subcontent()
    {
        return [
            'image'              => 'image|mimes:jpg,jpeg,png,PNG|max:2048',
            'image_size'         => 'required_with:image',
        ];
    }

    public function blog()
    {
         return $this->commonRules;
    }

    public function sponsor()
    {
        return $this->commonRules;
    }


    public function social_subcontent()
    {
        return [
            'icon'               => 'required',
            'url'                => 'required',
        ];
    }
    public function policies_subcontent()
    {
        return [
            'lang'               => 'required',
            'title'              => 'required',
            'description'        => 'required',
        ];
    }

    public function contact()
    {
        return [
            'title'              => 'required',
            'heading'            => 'required',
            'sub_heading'        => 'required',
            'phone'              => 'required',
            'email'              => 'required',
            'address'            => 'required',
            'map_link'           => 'required'
       ];
    }

}
