<?php

namespace App\Http\Traits;

use App\EmpiricalDatum;

trait EmpiricalDataOrderTrait
{
    protected $target = [
        'Media Trends Report', 'Media Audience Trends', 'Media Programme Content', 'Data for Media'
    ];

    protected $media = [
        'Magazines', 'Newspaper', 'New Media', 'Radio', 'Social Media', 'Television'
    ];

    /**
     * Make emperical data for storage
     * 
     * @param int $order_id
     * @param array $data
     * @return App\EmpiricalDatum
     */
    protected function createEmpiricalData(array $data, $order_id)
    {
        return EmpiricalDatum::create([
                'target' => $data['target'],
                'order_id' => $order_id
            ]);
    }
}