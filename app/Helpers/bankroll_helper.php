<?php

if (!function_exists('defaultBankroll')) 
{    
    function defaultBankroll() 
    {
        $user = userLoggedIn();
        $bankrollModel = new \App\Models\BankrollModel();

        return $bankrollModel->where('user_id', $user->id)->first();
    }
}

if (!function_exists('myBankrolls')) 
{    
    function myBankrolls() 
    {
        $user = userLoggedIn();
        $bankrollModel = new \App\Models\BankrollModel();

        return $bankrollModel->where('user_id', $user->id)->findAll();
    }
}