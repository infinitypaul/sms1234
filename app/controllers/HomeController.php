<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function post_upload()
	{
DB::connection()->disableQueryLog();
		$input = Input::all();
		$rules = array(
			'file' => 'mimes:csv,xlsx,xls',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Response::make($validation->errors->first(), 400);
		}
		if (Input::hasFile('file')) {
			$file = Input::file('file');
			$destinationPath = public_path().'/excel/';
			$filename = str_random(6) . '_' . $file->getClientOriginalName();
			if($file->move($destinationPath, $filename)) {

				//Excel::filter('chunk')->load(database_path('seeds/csv/users.csv'))->chunk(250, function($results);
				 Excel::filter('chunk')->load($destinationPath.$filename)->chunk(250,function($result) {
					 foreach ($result as $row) {
						 $state = State::where('title', '=', $row->state)->first();
						 if ($state === null) {
							 $state = State::create([
								 'title' => $row->state
							 ]);
						 }
						 //echo $row->state;
						 $lga = Lga::where('lga', '=', $row->lga)->first();
						 if ($lga === null) {
							 $lga = Lga::create([
								 'stateid' => $state->id,
								 'lga' => $row->lga
							 ]);
						 }
						 $area = Area::where('area', '=', $row->area)->first();
						 if ($area === null) {
							 $area = Area::create([
								 'lgaid' => $lga->id,
								 'area' => $row->area
							 ]);
						 }
						 $street = Street::where('street', '=', $row->street)->first();
						 if ($street === null) {
							 $street = Street::create([
								 'areaid' => $area->id,
								 'street' => $row->street
							 ]);
						 }
						 $datas = Datas::where('phone', '=', $row->number)->first();
						 if ($datas === null) {
							 Datas::create([
								 'streetid' => $street->id,
								 'surname' => $row->first_name,
								 'othername' => $row->last_name,
								 'phone' => $row->number,
								 'sex' => $row->sex
							 ]);
						 }


					 }
				 }
				 );
				//var_dump($result->toArray());
//echo $destinationPath.$filename;
				return Response::json('success', 200);
			} else {
				return Response::json('error', 400);
			}

		}
	}

}
