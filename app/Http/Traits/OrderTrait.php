<?php

namespace App\Http\Traits;

use App\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\NoteTrait;
use App\Http\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\EmpiricalDataOrderTrait;
use App\Http\Traits\PrecticalResearchOrderTrait;
use App\Http\Traits\EducationalServicesOrderTrait;

trait OrderTrait
{
    use NoteTrait, 
        FileTrait, 
        VerificationTrait, 
        EmpiricalDataOrderTrait, 
        PrecticalResearchOrderTrait, 
        EducationalServicesOrderTrait;

    /**
     * The path to redirect users if url token is inavlid
     */
    private $redirectTo = '/order/new';

    /**
     * Order categories
     */
    private $str = ['educational' => 'services', 'empirical' => 'data/information', 'practical' => 'research'];

    /**
     * Create an array of columns and values pair of a file record to be persisted
     * 
     * @param array $file_names
     * @param int $owner_id
     * @return array
     */
    protected function getFilePayload($file_name, $order_id)
    {
        return [
                'file_name' => $file_name,
                'order_id' => $order_id
            ];
    }

    /**
     * Get the order type from the request data
     * 
     * @param array $data
     */
    protected function getOrderTypeRequest(array $data)
    {
        return array_first(explode(' ', session('order.data')['category']));
    }
    /**
     * Get the order view name
     * 
     * @param string $type
    * @return \Illuminate\Http\Response 
     */
    protected function getOrderForm($type)
    {        
        if (is_null($type)) {
            session()->forget('order');

            $this->deleteTempStorage();
            
            return view('pages.order-type');
        } else {

            session()->put(['order' => ['token' => $this->generateToken()]]);

            $array = ['extentions' => $this->document_ext];

            // variable type will either be educational, emperical or precatical
            // And the below expression will return a view with either
            // practical-order, empirical-order or educational-order
            $array['type'] = $type . ' ' . $this->str[$type];

            switch (Str::title($type)) {
                case Order::EDUCATIONAL:
                    $array['fields'] = $this->fields;
                    $array['paper_type'] = $this->paper_type;
                    break;

                case Order::EMPIRICAL:
                    $array['target'] = $this->target;
                    $array['media'] = $this->media;
                    break;

                case Order::PRACTICAL: 
                    $array['area'] = $this->area;
            }

            return view('pages.' . $type . "-order", $array);
        }
    }

    /**
     * Make order data
     * 
     * @param array $data
     * @return App\Order
     */
    protected function makeOrderData($data)
    {
        return Order::make([
            'category' => $data['category'],
            'title' => Str::title($data['title']),
            'format' => $data['format'] == "Others" ? Str::title($data['other_format']) : $data['format'],
            'pages' => $data['pages'],
            'phone' => $data['phone']
        ]);
    }

    /**
     * Get the path to redirect user
     * 
     * @return string
     */
    protected function redirectPath()
    {
        return $this->redirectTo;
    }

    /**
     * Get a validator for an incoming order request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($data)
    {
        return Validator::make($data, [
            'area' => 'sometimes|required|integer',
            'field' => 'sometimes|required|integer',
            'type' => 'sometimes|required|integer',
            'target' => 'sometimes|required|integer',
            'title' => 'required|string|max:255',
            'format' => 'required|string|max:255',
            'pages' => 'required|integer',
            'files' => 'array',
            'files.*' => 'file|mimes:jpg,jpeg,png,docx,pdf,xlsx',
            'phone' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (! preg_match('/(^([0-9]{0,1})[0-9]{10})$/', $value)) {
                        return $fail('Please enter a valid phone number');
                    }
                },
            ],
            'other_format' => function($attribute, $value, $fail) use ($data) {
                if ($data['format'] === 'Others' && is_null($value)) {
                    return $fail('Please specify other format');
                }
            }
        ]);        
    }

    /**
     * Create order record in storage
     * 
     */
    protected function saveOrder()
    {
        $data = session('order.data');

        $order = $this->makeOrderData($data);

        if (! is_null($order)) {
            try {
                DB::beginTransaction();

                $order = Auth::user()->order()->save($order);

                switch($this->getOrderTypeRequest($data))
                {
                    case Order::EDUCATIONAL:
                        $this->createEducationalData($data, $order->id);
                        break;
                    case Order::EMPIRICAL:
                        $this->createEmpiricalData($data, $order->id);
                        break;
                    case Order::PRACTICAL:
                        $this->createPracticalData($data, $order->id);
                }

                if (! is_null($data['note'])) {
                    $this->createNote($data, $order->id);
                }

                if (! is_null(session('order.filenames')[0])) {
                    $this->persistTempFiles(session('order.filenames'), $order->id, \App\File::class);
                }

                DB::commit();

                session()->forget('order');
                session()->flash('success', trans('messages.submit.success'));

                return true;

            } catch(Exception $e){
                DB::rollback();
            } 
        }

        session()->flash('error', trans('messages.submit.fail'));
        return false;
    }
}