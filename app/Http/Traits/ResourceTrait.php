<?php

namespace App\Http\Traits;

use Image;
use Purifier;
use App\Resource;
use App\ResourceFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

trait ResourceTrait {

    use FileTrait;

    /**
     * Instance of resource
     */
    protected $resource;

    /**
     * 
     */
    protected function findResourceByTitle($title)
    {
        // We don't want to query our database twice
        return $this->resource = $this->getModelName()::where(
                'title', 
                'LIKE', 
                "%{$this->cleanTitle($title)}%"
            )->first();

    }

    /**
     * Get the Eloquent model name
     * 
     * @return string the model name
     */
    protected function getModelName() {
        return Resource::class;
    }

    /**
     * Get resources from storage
     * 
     * @param string $type 
     * @return 
     * 
     */
    protected function getResources($type = 'all')
    {
        return $this->getModelName()::where('published_at', null)
                            ->orderBy('updated_at', 'desc')
                            //->with('resourceFiles')
                            ->paginate(5);
                            
    }

    public function searchPublication(Request $request)
    {
        return response()->json(
            $this->getModelName()::where('title', 'LIKE', "%{$request['query']}%")->get(['title'])
        );
    }
    
    /**
     * Get a validator for an incoming order request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Find resource with the title
        $title = $this->findResourceByTitle($this->cleanTitle($data['title']))['title'];

        return Validator::make($data, [
            'title' => [
                'required', 'string', 'max:255', 
                function($attribute, $value, $fail) use ($data, $title) {
                    if (! is_null($title)) {
                        return $fail('Sorry, '. $attribute . ' has been used');
                    }
                    
                }],

            'publication' => [function($attribute, $value, $fail) {
                                if (is_null($value)) {
                                    return $fail('Publication cannot be empty!');
                                }
                            }, 'string'],

            'paid' => 'required|string|max:5'

            // 'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png',
            //             function($attribute, $value, $fail) use ($request) {
            //                 if (! $request->has('display')) {
            //                   return  $fail('Sorry, file display option was not selected');
            //                 }
            //             }]
        ]);
    }

    /**
     * Replace multiple white space with a signle white  space
     * 
     * @param string $title
     * @return string
     */
    protected function cleanTitle($title)
    {
        return preg_replace('/\s+/', ' ', $title);
    }



    public function upload(Request $request) 
    {
        $image = $request->file('file');
        // $filename = $image->getClientOriginalName();
        // $location = //public_path('images' . DIRECTORY_SEPARATOR . $filename);
        // Image::make($image)->resize(600, 400)->save($location);
         return response()->json([
             'location' => asset('storage/' .  $this->uploadEmbeddedFile($image))
         ]);  
       // return $this->uploadEmbeddedFile($image);
    }

    /**
     * Save publication to storage
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function saveResource(Request $request)
    {
        $data = $this->validator($request->all())->validate();
        try {
            DB::beginTransaction();

            $resource = $this->getModelName()::create([
                            'title' => $this->cleanTitle($data['title']),
                            'publication' => $data['publication'],
                            'paid' => $data['paid']
                        ]);
            
            if (! is_null($resource) && $request->hasFile('file')) {

                // Save uploaded resource(s) 
                $this->saveFilesPermanently(
                    $request->only('file'), $resource->id, ResourceFile::class
                );
            }

            DB::commit();

            return true;
        }
        catch(Exception $e) {
            DB::rollback();
        }

        return false;
    }

    /**
     * Create an array of columns and values pair of a file record to be persisted
     * 
     * @param array $file_name
     * @param int resource_id
     * @return array
     */
    protected function getFilePayload($file_name, $resource_id)
    {
        return [
                'file_name' => $file_name,
                'resource_id' => $resource_id,
            ];
    }

    protected function showUploadForm(Request $request)
    {
        $request->validate([
            'type' => ['required']
        ]);

        return redirect(url()->current() . '/' . Str::lower($request['type']));
    }
}