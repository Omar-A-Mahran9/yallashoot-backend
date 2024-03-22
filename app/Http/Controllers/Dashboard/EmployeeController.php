<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\StoreEmployeeRequest;
use App\Http\Requests\Dashboard\UpdateEmployeeRequest;
use App\Rules\NotNumbersOnly;
use App\Rules\PasswordValidate;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_employees');

        if ($request->ajax())
        {
            $data = getModelData(model: new Employee());
      
             return response()->json($data);
        }

        return view('dashboard.employees.index');
    }

    public function create()
    {
        $this->authorize('create_employees');
        $roles = Role::select('id', 'name_' . getLocale())->get();

        return view('dashboard.employees.create', compact('roles'));
    }


    public function show(Employee $employee)
    {
        $this->authorize('show_employees');

        $roles = Role::select('id', 'name_' . getLocale())->get();

        return view('dashboard.employees.show', compact('employee', 'roles'));
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update_employees');

        $roles = Role::select('id', 'name_' . getLocale())->get();

        return view('dashboard.employees.edit', compact('employee', 'roles'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('create_employees');
        $data = $request->validated();
        // $data['password'] = $request['phone'];
        $data['phone']      = convertArabicNumbers($data['phone']);
        $request->merge(['phone' => $data['phone']]);
        $request->validate([
            'phone' => [
                'required',
                'numeric',
                 Rule::unique('employees', 'phone'),
            ]]);
        $employee           = Employee::create($data);
        $rolesAndDefaultOne = array_merge($request['roles'], ["2"]);
        $employee->roles()->attach($rolesAndDefaultOne);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->authorize('update_employees');
        $data          = $request->validated();
        $data['phone'] = convertArabicNumbers($data['phone']);
        $request->merge(['phone' => $data['phone']]);
        $request->validate([
            'phone' => [
                 'numeric',
                Rule::unique('employees', 'phone')->ignore($employee->id),
            ],
        ]);
        $employee->update($data);
        $rolesAndDefaultOne = array_merge($request['roles'], ["2"]);
        // dd($rolesAndDefaultOne);
        $employee->roles()->sync($rolesAndDefaultOne);
    }


    public function destroy(Request $request, Employee $employee)
    {
        $this->authorize('delete_employees');

        if ($request->ajax())
        {
            $employee->delete();
        }
    }

    public function updateProfile(Request $request)
    {
         $data = $request->validate([
            'name' => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'phone' => ['required', 'numeric', 'unique:employees,phone,' . auth()->id(),'regex:/^((\+|00)966|0)?5[0-9]{8}$/'],
            'email' => ['required', 'string', "email", 'unique:employees,email,' . auth()->id()],
        ]);
        $data['phone'] = convertArabicNumbers($data['phone']);
        $request->merge(['phone' => $data['phone']]);
        $request->validate([
            'phone' => [
                 Rule::unique('employees', 'phone')->ignore( auth()->id()),
            ]]);
            

        auth()->user()->update($data);

    }
    public function updatePassword(Request $request)
    {

        $data = $request->validate([
            'password' => ['nullable','exclude_if:password,null','string','min:8','max:255',new PasswordValidate(),'confirmed'],
            'password_confirmation' => ['nullable','exclude_if:password_confirmation,null','same:password'],
        ]);
        auth()->user()->update($data);
    }

}
