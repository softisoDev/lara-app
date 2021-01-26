<?php


namespace App\Mixins;

class  CollectionMixin
{
    public function currentLanguage()
    {
        return function () {

            return $this->map(function ($item) {

                foreach ($item->translatableAttributes as $attribute){
                    $item->$attribute = $item->currentLanguage->first()->$attribute;
                }

                return $item;
            });
        };
    }
}
