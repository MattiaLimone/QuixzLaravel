<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Game;
use App\Player;
use Auth;
use App\User;
use Image;
use App\Team;

class TeamController extends Controller
{
    public function __construct() {
      $this->middleware('admin');
    }

    public function index()
    {
      $teams = Team::get();

      return view('admin.teams')->withTeams($teams);
    }

    public function create()
    {
      return view('teams.create');
    }

    public function store(Request $request)
    {
      $this->validate($request, array(
          'name' => 'required|max:20',
          'body' => 'max:1200',
          'wins' => 'integer',
          'loss' => 'integer',
        ));

        // Store in DB
        $team = new Team;

        $team->name = $request->name;
        $team->body = $request->body;
        $team->wins = $request->wins;
        $team->loss = $request->loss;

        $value = $team->name;
        $team->slug = str_slug($value);

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          $info = getimagesize($image);
          $extension = image_type_to_extension($info[2]);
          $filename = time() . $extension;
          $location = public_path('images/' . $filename);
          Image::make($image)->save($location);

          $team->image = $filename;
        }

        $team->save();

        // Redirect
        return redirect()->route('teams.index');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
      $team = Team::find($id);

      return view('teams.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, array(
          'body' => 'max:1200',
          'wins' => 'integer',
          'loss' => 'integer',
        ));

        // Store in DB
        $team = Team::find($id);

        $team->body = $request->body;
        $team->wins = $request->wins;
        $team->loss = $request->loss;


        if ($request->hasFile('image')) {
          $image = $request->file('image');
          $info = getimagesize($image);
          $extension = image_type_to_extension($info[2]);
          $filename = time() . $extension;
          $location = public_path('images/' . $filename);
          Image::make($image)->save($location);

          $team->image = $filename;
        }

        $team->save();

        // Redirect
        return redirect()->route('teams.index');
    }

    public function destroy($id)
    {
        //
    }
}