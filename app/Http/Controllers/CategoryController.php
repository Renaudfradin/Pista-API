<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function destroy(Category $id)
    {
        $id->delete();

        return response()->json([
            'message' => 'Todoliste delete'
        ], 200);
    }
}
