<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\DataRepository;
use Illuminate\Http\Request;
use App\Models\Data;
class DataController extends Controller
{
    protected $data;
    public function __construct(DataRepository $dataRepository)
    {
        $this->data=$dataRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dates=$this->data->all();
        return view('welcome',compact('dates'));
    }

    /**
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        try {
            $query = Data::whereNotNull('name');

            if (!is_null($request->name)) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            }
            if (!is_null($request->storeys)) {
                $query->where('storeys', $request->storeys);
            }
            if (!is_null($request->bathrooms)) {
                $query->where('bathrooms', $request->bathrooms);
            }

            if (!is_null($request->bedrooms)) {
                $query->where('bedrooms', $request->bedrooms);
            }

            if (!is_null($request->garages)) {
                $query->where('garages', $request->garages);
            }

            if (!is_null($request->price_from) || !is_null($request->price_to)) {
                $query->where(function ($query) use ($request) {
                    if (!is_null($request->price_from)) {
                        $query->where('price', '>=', $request->price_from);
                    }

                    if (!is_null($request->price_to)) {
                        $query->where('price', '<=', $request->price_to);
                    }
                });
            }

            $dates = $query->get();
            $jsonData['response']=true;
            $jsonData['view']= view('partials.data_response', compact('dates'))->render();
            return $jsonData;

        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
