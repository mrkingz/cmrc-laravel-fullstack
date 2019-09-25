<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ResourceTrait;

class ResourcesController extends Controller
{

    use ResourceTrait;

    public function __construct()
    {
        $this->middleware(['auth'])->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.resources')
                ->withResources($this->getResources());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        return is_null($type)
            ? view('pages.resource-type')
            : view('pages.new-' . ($type === 'article' ? $type : 'multimedia'))
                ->with(['type'=> $type, 'extentions' => $this->document_ext]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ($response = $this->saveResource($request))
            ? $request->session()->flash('success', trans('messages.submit.success'))
            : $request->session()->flash('error', trans('messages.submit.fail'));

        return response()->json(['success' => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.resource')->withResource(
            $this->getModelName()::findOrFail($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->getModelName()::destroy($id);
        return response()->json([
                'success' => $response ? true : false
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
