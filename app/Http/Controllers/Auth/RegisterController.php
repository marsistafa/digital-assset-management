<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class RegisterController extends Controller
{
   
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }
    

    protected function validator(Request $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function store(Request $data)
    {
        \DB::beginTransaction();
        try 
        {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->save();
            // Generate and store an API key for the user
               
            $apiKey = ApiKey::create([
                'key' => \Str::random(), 
                'user_id' => $user->id,
            ]);
    
            $user->roles()->attach(1);
            \Auth::login($user);
            \DB::commit();
           
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
        }

       
        return redirect(RouteServiceProvider::HOME);
    }

    public function showRegistrationFormm()
    {
        return view('auth.register');
    }
}
