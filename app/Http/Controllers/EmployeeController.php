<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Employee::with('division');

            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('division_id')) {
                $query->where('division_id', 'like', '%' . $request->division_id . '%');
            }

            $employees = $query->paginate(5);

            $formattedEmployees = $employees->map(function ($employees) {
                return [
                    'id' => $employees->id,
                    'image' => $employees->image,
                    'name' => $employees->name,
                    'phone' => $employees->phone,
                    'division' => [
                        'id' => $employees->division->id,
                        'name' => $employees->division->name,
                    ],
                    'position' => $employees->position,
                ];
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Employee retrieved successfully',
                'data' => [
                    'employees' => $formattedEmployees,
                ],
                'pagination' => [
                    'current_page' => $employees->currentPage(),
                    'per_page' => $employees->perPage(),
                    'total' => $employees->total(),
                    'last_page' => $employees->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve employees',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
