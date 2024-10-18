<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePropRequest;
use App\Models\Prop;

final class PropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prop $prop): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prop $prop): void
    {
        //
    }
}
