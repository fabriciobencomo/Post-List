<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use App\Http\Requests\RepositoryRequest;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $repositories = $request->user()->repositories;

        return view('repositories.index', compact('repositories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repositories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepositoryRequest $request)
    {
        $request->user()->repositories()->create($request->all());

        return redirect()->route('repositories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository)
    {
        $this->authorize('view', $repository);

        return view('repositories.show', compact('repository'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository)
    {
        $this->authorize('view', $repository);

        return view('repositories.edit', compact('repository'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RepositoryRequest $request, Repository $repository)
    {
        $this->authorize('update', $repository);

        $repository->update($request->all());

        return redirect()->route('repositories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository)
    {
        $this->authorize('delete', $repository);

        $repository->delete();

        return redirect()->route('repositories.index');
    }
}
