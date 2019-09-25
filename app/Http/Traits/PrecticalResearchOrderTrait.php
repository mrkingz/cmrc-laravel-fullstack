<?php

namespace App\Http\Traits;

use App\PracticalResearch;

trait PrecticalResearchOrderTrait
{
    protected $area = [
        'Advertising', 'Customer', 'Democracy', 'Marketing', 'Media', 'Product', 'Social sciences', 'Public Opinion', 'Survey'
    ];

    /**
     * Make practical research data for storage
     * 
     * @param int $order_id
     * @param array $data
     * @return App\PracticalResearch
     */
    protected function createPracticalData(array $data, $order_id)
    {
        return PracticalResearch::create([
                'area' => $data['area'],
                'order_id' => $order_id
            ]);
    }
}