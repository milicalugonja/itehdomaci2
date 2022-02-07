<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UniversityController;
use App\Http\Controllers\API\FacultyController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
    GET /api/universities - vrati mi sve univerzitete iz baze - index
    GET /api/universities/{id} - vrati mi univerzitet sa datim id -jem - show
    POST /api/universities - kreiraj novi univerzitet - store
    PUT /api/universities/{id} - izmeni univerzitet sa datim id -jem podacima iz tela zahteva - update
    DELETE /api/universities/{id} - obrisi univerzitet sa datim id -jem - destroy
*/

Route::post('login', function (Request $request) {
    $email = $request->email;
    $password = $request->password;
    $user = User::where('email', $email)->first();
    if (!$user || !Hash::check($password, $user->password)) {
        return response()->json([
            "success" => false,
            "error" => "Bad crendentials"
        ]);
    }
    return response()->json([
        "success" => true,
        "token" => $user->createToken($user->email)->plainTextToken
    ]);
});
Route::post('register', function (Request $request) {
    $email = $request->email;
    $password = $request->password;
    $name = $request->name;
    $user = User::where('email', $email)->first();
    if ($user) {
        return response()->json([
            "success" => false,
            "error" => "User already exists"
        ]);
    }
    $user = User::create([
        "name" => $name,
        "email" => $email,
        "password" => Hash::make($password)
    ]);
    return response()->json([
        "success" => true,
        "token" => $user->createToken($user->email)->plainTextToken
    ]);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'universities' => UniversityController::class,
        'faculties' => FacultyController::class
    ]);
});
