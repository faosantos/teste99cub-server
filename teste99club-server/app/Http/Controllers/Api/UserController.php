<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserImage;
use App\Lib\Geocode;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Grimzy\LaravelMysqlSpatial\Types\Point;

use Validator;
use Exception;

class UserController extends Controller
{

	private function saveUserImage($base64)
	{
		$img = preg_replace('#data:image/[^;]+;base64,#', '', $base64);
  }


	public function register(Request $req)
	{
    $messages = [
      'email.required' => 'Insira um email',
      'email.email' => 'Email inválido',
      'email.unique' => 'Email já registrado',
      'email.max' => 'Email muito grande',

      'name.required' => 'Seu nome deve ser preenchido',
      'name.string' => 'Nome inválido',
      'name.max' => 'Seu nome é muito grande',

      'about.required'=> 'O campo Sobre não deve ser nulo',

      'password.required' => 'A senha deve ter entre 6 e 21 caracteres',

      'sex.required' => 'Você deve selecionar seu sexo',

      'interest.required' => 'Você deve definir seu interesse',

      'birthDate.required' => 'Você deve incerir sua Data de nascimento',
      'birthDate.date' => 'A data incerida não é reconhecida'
    ];
    $valid = [
      'name' => 'required|string|max:225',
      'email' => 'required|email|unique:users|max:120',
      'password' => 'required',
      'about' => 'required',
      'avatar' => 'nullable',
      'sex' => 'required',
      'interest' => 'required',
      'birthDate' => 'required|date'
    ];
    $validator = Validator::make($req->all(), $valid, $messages);

    if ($validator->fails()) {
      $errors = array_merge(['fields' => $validator->errors()],
                            ['error' => 'Não foi possível validar os campos preenchidos']);
      return response()->json($errors, 422);
    }

    if ($req->avatar) {
      $avatar = $this->saveUserImage($req->avatar);
    } else {
      $avatar = $req->sex == 'm' ?
      asset('storage/images/defaults/male.png'):
      asset('storage/images/defaults/female.png');
    }

    $user = new User();
    $user->name = $req->name;
    $user->email = $req->email;
    $user->password = Hash::make($req->password);
    $user->about = $req->about;
    $user->avatar = $avatar;
    $user->sex = $req->sex;
    $user->interest = $req->interest;
    $user->location = new Point($req->location['lat'], $req->location['lng']);
    $user->birth_date = date_create($req->birthDate);
    $user->save();
    $userAuth = User::authenticate($user->email, $req->password);

    $userAuth->apiToken = $userAuth->createApiToken();
    //$userAuth->accountConfirm();

    return response()->json([
      'authenticated' => true,
      'user' => $userAuth->toAppJson(),
      'apiToken' => $userAuth->apiToken,
    ], 200);
  }

	public function login(Request $req)
	{
    $user = User::authenticate($req->email, $req->password);
    if ($user != false) {
      return response()->json([
        'authenticated' => true,
        'user' => $user->toAppJson(),
        'apiToken' => $user->createApiToken()
      ], 200);
    } else {
      return response()->json(['error'=>'Email e/ou senha incorretos'], 422);
    }
  }

	public function apiTokenCheck(Request $req)
	{
		return response()->json([
		'authenticated' => true,
		'user' => Auth::user()->toAppJson()
		], 200);
  }

  public function setLocation(Request $req)
  {
    $user = Auth::user();

    if (isset($req->lat) && isset($req->lng)) {
      $user->location = new Point($req->lat, $req->lng);
    } else if (isset($req->address)) {
      $user->location = Geocode::getPointFromAddress($req->address);
    }

    if ($user->update()) {
      return response()->json([], 200);
    } else {
      return response()->json([], 500);
    }

  }


  public function uploadImage(Request $req)
  {
    $user = Auth::user();
    $nameFile = null;

    if ($req->hasFile('image') && $req->file('image')->isValid()) {

      $name = uniqid(date('HisYmd'));

      $extension = $req->image->extension();

      $nameFile = "{$name}.{$extension}";

      $upload = $req->image->storeAs('public/images', $nameFile);
      if ( !$upload ) {
            return response()->json(["ERROR" => true], 500);
      } else {
        Log::info("aqui");
        $userimage = new UserImage();
        $userimage->user_id = $user->id;
        $userimage->path = env("APP_URL", "http://192.168.0.34:8001") . "/storage/images/" . $nameFile;
        $userimage->save();

        return response()->json([], 200);
      }

    } else {
      return response()->json([], 500);
    }

  }


  public function test()
  {
    $user = User::where('email', 'thiago_fdutra@hotmail.com')->first();
    $user->apiToken = $user->createApiToken();
    $ac = $user->accountConfirm();
    return $ac;
  }
  public function confirm()
  {
    if(Auth::check()){
      $user = Auth::user();
      $user->email_verified_at = time();
      $resp = $user->save();
      return ['success'=>$resp];
    }else{
      return ['success'=>false];
    }
  }

}
