<?php

namespace App\Http\Traits;

use App\EducationalService;

trait EducationalServicesOrderTrait
{
    protected $fields = [
        'Administration', 'Art', 'Education', 'Humanities', 'Management Sciences', 'Social sciences'
    ];

    protected $paper_type = [
        'Annotated Bibliography', 'Assignment', 'Capstone Projects', 'Case Studies', 'Critical Thinking', 'Data Analysis', 'Data Gathering', 'Dissertations', 'Editing', 'Essay',  'Plagiarism', 'Presentations', 'Projects', 'Reports', 'Reviews', 'Speeches', 'Term Papers', 'Thesis',
    ];

    /**
     * Make educational services data for storage
     * 
     * @param int $order_id
     * @param array $data
     * @return App\EducationalServices
     */
    protected function createEducationalData(array $data, $order_id)
    {
        return EducationalService::create([
                'field' => $data['field'],
                'type' => $data['type'],
                'order_id' => $order_id
            ]);
    }
}