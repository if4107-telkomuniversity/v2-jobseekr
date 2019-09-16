<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewTestController extends Controller
{
    public function showView(Request $request) {
        $key = is_null($request->key) ? 'home' : $request->key;
        if ($key == 'home') {
            return view('index');
        }
        $key = explode('/', $key);
        if ($key[0] == 'r') {
            $pre = 'recruiter';
        } elseif ($key[0] == 'j') {
            $pre = 'jobseeker';
        } else {
            return response()->json(['err' => 'not found'], 404);
        }
        try {
            switch ($key[1]) {
                case 'auth':
                    $post = 'auth';
                    break;
                case 'dashboard':
                    $post = 'dashboard';
                    break;
            }
        } catch (\Exception $e) {
            return response()->json(['err' => 'not found'], 404);
        }
        try {
            return view("$pre.$post");
        } catch (\Exception $e) {
            return response()->json(['err' => 'not found'], 404);
        }
    }
}
