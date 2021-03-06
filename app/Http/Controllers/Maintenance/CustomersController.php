<?php

namespace App\Http\Controllers\Maintenance;

use DB;
use Validator;
use App\Person;
use App\Category;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{

    public $viewBasePath = 'admin.maintenance';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->ajax() ) {
            $customers = Person::customer()->get();
            return datatables($customers)->toJson();
        }
        return view( $this->viewBasePath . '.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = vehicle::all();
        return view( $this->viewBasePath . '.customer.create')
                ->with('vehicles', $vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastname = filter_var($request->get('lastname'), FILTER_SANITIZE_STRING);
        $firstname = filter_var($request->get('firstname'), FILTER_SANITIZE_STRING);
        $middlename = filter_var($request->get('middlename'), FILTER_SANITIZE_STRING);
        $street = filter_var($request->get('street'), FILTER_SANITIZE_STRING);
        $barangay = filter_var($request->get('barangay'), FILTER_SANITIZE_STRING);
        $city = filter_var($request->get('city'), FILTER_SANITIZE_STRING);
        $birthdate = filter_var($request->get('birthdate'), FILTER_SANITIZE_STRING);
        $contact = filter_var($request->get('contact'), FILTER_SANITIZE_STRING);
        $email = filter_var($request->get('email'), FILTER_SANITIZE_STRING);
        $type = filter_var($request->get('type'), FILTER_SANITIZE_STRING);
        $customer = new Person;

        $validator = Validator::make( $request->all(), $customer->customerRules());
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $customer->lastname = $lastname;
        $customer->firstname = $firstname;
        $customer->middlename = $middlename;
        $customer->barangay = $barangay;
        $customer->city = $city;
        $customer->street = $street;
        $customer->birthdate = $birthdate;
        $customer->contact = $contact;
        $customer->email = $email;
        $cutomer->type = $type;

        DB::beginTransaction();
        $customer->save();
        $customer->vehicles()->attach($plate_number);
        DB::commit();

		session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'You have created a user information',
            'type' => 'success'
        ]);

        return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $customer = Person::customer()->where('id', '=', $id)->first();

        return view( $this->viewBasePath . '.customer.show')
                ->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $mechanic = Person::mechanic()->where('id', '=', $id)->first();

        $categories = Category::all();
        return view( $this->viewBasePath . '.mechanic.edit')
                ->with('mechanic', $mechanic)
                ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $lastname = filter_var($request->get('lastname'), FILTER_SANITIZE_STRING);
        $firstname = filter_var($request->get('firstname'), FILTER_SANITIZE_STRING);
        $middlename = filter_var($request->get('middlename'), FILTER_SANITIZE_STRING);
        $street = filter_var($request->get('street'), FILTER_SANITIZE_STRING);
        $barangay = filter_var($request->get('barangay'), FILTER_SANITIZE_STRING);
        $city = filter_var($request->get('city'), FILTER_SANITIZE_STRING);
        $birthdate = filter_var($request->get('birthdate'), FILTER_SANITIZE_STRING);
        $contact = filter_var($request->get('contact'), FILTER_SANITIZE_STRING);
        $email = filter_var($request->get('email'), FILTER_SANITIZE_STRING);
        $type = filter_var($request->get('type'), FILTER_SANITIZE_STRING);
        $specializations = $request->get('specializations');
        $mechanic = Person::find($id);

        $validator = Validator::make( $request->all() + [ 'mechanic' => $id ], $mechanic->mechanicUpdateRules());
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $mechanic->lastname = $lastname;
        $mechanic->firstname = $firstname;
        $mechanic->middlename = $middlename;
        $mechanic->barangay = $barangay;
        $mechanic->city = $city;
        $mechanic->street = $street;
        $mechanic->birthdate = $birthdate;
        $mechanic->contact = $contact;
        $mechanic->email = $email;
        $mechanic->type = $type;

        DB::beginTransaction();
        $mechanic->save();
        $mechanic->categories()->sync($specializations);
        DB::commit();

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'You have update a mechanics information',
            'type' => 'success'
        ]);

        return redirect('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $name = filter_var($request->get('name'), FILTER_SANITIZE_STRING);
        $description = filter_var($request->get('description'), FILTER_SANITIZE_STRING);
        $category = new Person;

        $validator = Validator::make([
            'person' => $id
        ], $category->checkIfPersonExists());

        if($validator->fails()) {
            
            if( $request->ajax() ) {
                return response()->json([
                    'title' => 'Error',
                    'message' => 'Error occured while updating a category',
                    'status' => 'ok',
                    'others' => '',
                ], 500);
            }
            return back()->withInput()->withErrors($validator);
        }

        $category = Person::mechanic()->where('id', '=', $id)->first();
        $category->delete();

        if( $request->ajax() ) {
            return response()->json([
                'title' => 'Success',
                'message' => 'Mechanic successfully removed',
                'status' => 'ok',
                'others' => '',
            ], 200);
        }

        session()->flush('success', 'Mechanic successfully removed');
        return redirect('category');
    }
}
