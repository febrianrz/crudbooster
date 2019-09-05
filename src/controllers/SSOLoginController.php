<?php namespace crocodicstudio\crudbooster\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class SSOLoginController extends Controller
{
    public function doLogin()
    {
        \phpCAS::setDebug();
        \phpCAS::setVerbose(true);
        // initialize 
        // dd((int)CRUDBooster::getSetting('sso_port'));
        \phpCAS::client(CAS_VERSION_2_0, 
            CRUDBooster::getSetting('sso_host'), 
            (int)CRUDBooster::getSetting('sso_port'), 
            CRUDBooster::getSetting('sso_uri') ? CRUDBooster::getSetting('sso_uri'): ''
        );
        // \phpCAS::logout();
        
        if(!CRUDBooster::me()){
            \phpCAS::setNoCasServerValidation();
            \phpCAS::forceAuthentication();
            // dd(\phpCAS::getUser());
        } else {
            return redirect('/');
        }
        
    }
}
