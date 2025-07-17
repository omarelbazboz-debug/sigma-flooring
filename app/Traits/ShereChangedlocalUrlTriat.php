<?php

namespace App\Traits;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

 trait ShereChangedlocalUrlTriat {
    public function shereAltLangUrlAndAltLangTitle(){
        $segmentsModel = config('segmentsmodels.segments') ;
        $currentLocale = app()->getLocale(); // get current local
        $aimLang = $currentLocale === 'en' ? 'ar' : 'en' ;
        $url = LaravelLocalization::getLocalizedURL($aimLang, null, [], true);
        // to ensure the  default lang is hiden
        if(config('laravellocalization.hideDefaultLocaleInURL')){
            $defaultLocale = config('app.locale'); // get default local
            $segmentStatus = ($currentLocale === $defaultLocale) ;
            $segmentModel = $segmentStatus ? request()->segment(1) : request()->segment(2) ; // get segment based loacl  ;
            $currentLink =  $segmentStatus ? request()->segment(2) : request()->segment(3) ;
        }else{
            $segmentModel =  request()->segment(2) ;
            $currentLink =  request()->segment(3) ;
        }

        if (key_exists($segmentModel,$segmentsModel)) {
            $model = $segmentsModel[$segmentModel] ;
            $link = app($model)->where('link_ar' , $currentLink)->orWhere('link_en',$currentLink)->first() ;
            $url = str_replace($currentLink , $link->{'link_'.$aimLang},$url) ;

         }

        view()->share([
            'altLangLink' =>$url,
            'altLangTitle' => LaravelLocalization::getSupportedLocales()[$aimLang]['native'] ?? $aimLang,

        ]);
    }
 }
