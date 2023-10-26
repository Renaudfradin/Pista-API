<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\Category;

/**
* @OA\Delete(
*     path="/api/category/{id}",
*     summary="Category delete",
*     tags={"Category"},
*     security={{"bearerAuth":{}}},
*     @OA\Parameter(
*         name="",
*         in="query",
*         description="User Id",
*         required=true,
*         @OA\Schema(type="string")
*     ),
*     @OA\Response(response="200", description="Category delete"),
* )
*/

class CategoryController extends Controller
{
    public function destroy(Category $id)
    {
        $id->delete();

        return response()->json([
            'message' => 'Category delete'
        ], 200);
    }
}
