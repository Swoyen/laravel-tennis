<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\RankingResource;
use App\Http\Requests\StoreRankingRequest;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selected = array_filter(request()->only([
            'date',
            'gender',
            'type',
            'country',
        ]));

        $ranges = array_filter(request()->only([
            'ranking_range',
            'points_range',
            'age_range',
            'tournaments_range'
        ]));

        $rankings = Ranking::when(count($selected) > 0, function ($query) use ($selected){
            foreach($selected as $column=>$value){
                $query->where($column,$value);
            }
        })->when(request('search','') != '' , function ($query){
            $query->where(function ($q){
                $q->where('player', 'LIKE', '%' .request('search'). '%');
            });
        })->when(count($ranges) > 0, function($query) use ($ranges){
            foreach($ranges as $range=>$value){
                $column = Str::before($range, '_');
                $min = Str::before($value, '-');
                $max = Str::after($value, '-');

                $query->where($column, '>=', $min)
                    ->where($column, '<=', $max);
            }
        })->paginate(20);

        return RankingResource::collection($rankings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRankingRequest $request)
    {
        $ranking = Ranking::create($request->validated());
        return new RankingResource($ranking);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ranking $ranking)
    {
       return new RankingResource($ranking);
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
    public function update(Ranking $ranking, StoreRankingRequest $request)
    {
        $ranking->update($request->validated());

        return new RankingResource($ranking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ranking $ranking)
    {
        $ranking->delete();
        return response()->noContent();
    }
}
