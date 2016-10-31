<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Customer extends Model{
    
//  The table associated with the model
    protected  $table='customers';
    public $timestamps=false;
    
         /* The attributes that are mass assignable.*/
         protected  $fillable=['first_name','last_name','email','phone','sex','_token'];
    
    
}

