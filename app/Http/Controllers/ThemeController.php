<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeRequest;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('newTheme');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThemeRequest $request)
    {
	    $user  = Auth::user();

	    $theme = $request->validated();

	    $theme["user_id"] = $user != null ? $user->id : null;

	    $theme = Theme::create( $theme );

	    return redirect( '/theme/' . $theme->id . '/sections' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeRequest $request, $id)
    {
	    $theme = Theme::find($id);

	    if($theme->user_id == Auth::id()) {
		    $theme->update( $request->validated() );
		    return response()->json(["success" => true]);
	    }

        return response()->json(["success" => false, "message" => "Invalid Theme ID"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Theme::find($id);

        if($theme->user_id == Auth::id()) {
        	foreach($theme->sections as $section) {
        		$section->fields()->delete();
	        }
        	$theme->sections()->delete();
        	$theme->delete();
        	return response()->json(["success" => true]);
        } else {
	        return response()->json(["success" => false, "message" => "Invalid Theme ID"]);
        }

    }
}
