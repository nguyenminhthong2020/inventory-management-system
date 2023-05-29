<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Image;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected function uploadCustomerImage($request){
        $customerImage = $request->file('photo');
        $imageType = $customerImage->getClientOriginalExtension();
        $imageName = rand(100,100000).$request->name.'.'.$imageType;
        $directory = 'inventory/customer-images/';
        $imageUrl = $directory.$imageName;
        Image::make($customerImage)->save($imageUrl);
        return $imageUrl;
    }

    public function saveCustomer(SaveCustomerRequest $request){

        $imageUrl='';
        if($request->hasFile('photo'))
        {
            $imageUrl = $this->uploadCustomerImage($request);
        }
        $customer = new Customer();
        $customer-> name = $request-> name;
        $customer-> email = $request-> email;
        $customer-> phone = $request-> phone;
        $customer-> address = $request-> address;
        $customer-> city = $request-> city;
        $customer-> shop_name = $request-> shop_name;
        $customer-> bank_name = $request-> bank_name;
        $customer-> bank_branch = $request-> bank_branch;
        $customer-> account_holder = $request-> account_holder;
        $customer-> account_number = $request-> account_number;
        $customer-> photo = $imageUrl;
        $customer->save();
        return response()->json([
            "message"=>"Customer added successfully!",
            "status"=>200,
        ]);

    }
    public function getCustomers(){
        $customers = Customer::all();
        return response()->json([
            "customers" =>$customers,"status"=>200,
        ]);
    }
    public function getSupplier($id){
        $customer = Customer::findOrFail($id);
        return response()->json([
            "customer" =>$customer,"status"=>200,
        ]);
    }
    public function updateCustomer(UpdateCustomerRequest $request){

        $customer = Customer::findOrFail($request->cust_id);
        if($request->hasFile('photo'))
        {
            unlink($customer->photo);
            $customer-> photo = $this->uploadCustomerImage($request);
        }
        $customer-> name = $request-> name;
        $customer-> email = $request-> email;
        $customer-> phone = $request-> phone;
        $customer-> address = $request-> address;
        $customer-> city = $request-> city;
        $customer-> shop_name = $request-> shop_name;
        $customer-> bank_name = $request-> bank_name;
        $customer-> bank_branch = $request-> bank_branch;
        $customer-> account_holder = $request-> account_holder;
        $customer-> account_number = $request-> account_number;
        $customer->save();
        return response()->json([
            "message"=>"Customer data updated successfully!",
            "status"=>200,
        ]);
    }


    public function deleteCustomer($id){
        $customer = Customer::findOrFail($id);
        if($customer->hasFile('photo'))
        {
            unlink($customer->photo);
        }
        return response()->json([
            "message"=>"Customer removed successfully!",
           "status"=>200,
        ]);

    }
}
