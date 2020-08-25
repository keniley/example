<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface DatatableInterface
{
    public function datatable(Request $request): array;
}

