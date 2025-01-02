<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Division::query();

            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            $divisions = $query->paginate(5);

            return response()->json([
                'status' => 'success',
                'message' => 'Division retrieved successfully',
                'data' => [
                    'divisions' => $divisions->items(),
                ],
                'pagination' => [
                    'current_page' => $divisions->currentPage(),
                    'per_page' => $divisions->perPage(),
                    'total' => $divisions->total(),
                    'last_page' => $divisions->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve divisions',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
