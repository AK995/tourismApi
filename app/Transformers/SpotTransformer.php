<?php

namespace App\Transformers;

use App\Models\Spot;
use League\Fractal\TransformerAbstract;

class SpotTransformer extends TransformerAbstract{
    public function transform(Spot $spot){
        return [
            'locale_name' => $spot->locale_name,
            'spot_name' => $spot->spot_name,
            'avatar'=> $spot->avatar,
            'level' => $spot->level,
            'intro' => $spot->intro,
            'ticket_info' => $spot->ticket_info,
            'favor_policy' => $spot->favor_policy,
            'open_time' => $spot->open_time,
            'tips' => $spot->tips,
            'trans' => $spot->trans,
            'pics' => $spot->pics,
        ];
    }
}