<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Http\Controllers;
use App\Http\Requests;
use DB;


class CustomerController extends Controller
{
    public function index() {
       
       $customers= Customer::all();
       return view('customer',['customers'=>$customers]);
        
    }
    
    
    public function newCustomer(Request $request) {
        
        if($request->ajax()){
            $customer= Customer::create($request->all());
            return Response($customer);
            
            
        }
        
    }
    
    
    
    public function getUpdate(Request $request) {

        if($request->ajax()){
            $customer= Customer::find($request->customerId);
            return Response($customer);
        }
        
    }
    
    public function newCustomerUpdate(Request $request) {


            


        
           
        if($request->ajax()){

            $customer= Customer::find($request->id);
            $customer->first_name=$request->first_name;
            $customer->last_name=$request->last_name;
            $customer->sex=$request->sex;
            $customer->email=$request->email;
            $customer->phone=$request->phone;
            $customer->save();
            return Response($customer);
            
    
            
        }
        
    }    




    public function deleteCustomer(Request $request){


         if($request->ajax()){
            Customer::destroy($request->customerId);
            return Response()->json(['sms'=>'delete success']);
         }
    }
}
