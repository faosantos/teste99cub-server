<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Log;
use DB;

class FeedController extends Controller
{
    public function getLocal(Request $req)
    {
      $user = Auth::user();

      $feed = DB::select("
        SELECT 
          u.id as id,
          u.name as name,
          u.avatar as avatar,
          u.about as about,
          IF(u.sex = 'm', 'male', 'female') AS sex,
          TIMESTAMPDIFF(YEAR, u.birth_date, CURDATE()) AS age,
          ROUND(((st_distance(u.location, ST_GeomFromText(?)) * 111195) / 1000), 0) as distance,
          GROUP_CONCAT(img.path) as images
        FROM users AS u
        LEFT JOIN user_images AS img on img.user_id = u.id
        WHERE (u.id != ?) 
          AND (? = 'b' OR ? = u.sex)
          AND (interest = 'b' OR interest = ?)
        GROUP BY u.id
        HAVING distance <= ?
        ORDER BY distance",
        [
          $user->location->toWkt(),
          $user->id,
          $user->interest, $user->interest,
          $user->sex,
          500
        ]
      );

      foreach ($feed as $u) {
        if ($u->images != null) {
          $u->images = explode(',', $u->images);
        } else {
          $u->images = [];
        }
      }

      return response()->json($feed, 200);

    }

    public function getSearch(Request $req)
    {
      $user = Auth::user();
      $usersJson = $user->getUserFeed($req->address);
      return response()->json($usersJson, 200);
    }
}
