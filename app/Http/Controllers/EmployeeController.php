<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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

    public function addEmployee(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'nullable|url',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'division' => 'required|uuid|exists:divisions,id',
                'position' => 'required|string|max:255',

            ]);

            Employee::create([
                'id' => Str::uuid(),
                'image' => $validatedData['image'],
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'division_id' => $validatedData['division'],
                'position' => $validatedData['position'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee added successfully',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add employee',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateEmployee(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'image' => 'nullable|url',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'division' => 'required|uuid|exists:divisions,id',
                'position' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $employee = Employee::findOrFail($id);

            $employee->update([
                'image' => $request->image,
                'name' => $request->name,
                'phone' => $request->phone,
                'division_id' => $request->division,
                'position' => $request->position,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee updated successfully',
            ]);

        } catch (\Exception $e) {
            // Handle error
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating employee',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
