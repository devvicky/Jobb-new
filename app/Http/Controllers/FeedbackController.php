<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Session;
use Input;

use App\Feedback;

class FeedbackController extends Controller {

	public function __construct()
	{
	    $this->beforeFilter(function() {
	    	if(!Auth::check()){
	        	return redirect('login');
	        }
	    });
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->identifier == 3){
			$title = 'feedback';
			$feedbacks = Feedback::with('user')->get();
			return view('pages.feedbacks', compact('title', 'feedbacks'));
			// return $feedbacks;
		}else{
			return redirect('/home');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::check()) {
			$title = 'feedback';
			$feedbacks = Feedback::with('user')->get();
			return view('pages.feedback', compact('title', 'feedbacks'));
		}else{
			return redirect('/login');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		$feedback = new Feedback();
		$feedback->user_id = Auth::user()->id;
		$feedback->experience = $request['experience'];
		$feedback->usability = $request['usability'];
		$feedback->comments = $request['comments'];
		$feedback->promotion = $request['promotion'];
		$feedback->device_info = $request['device_info'] ;
		if($request['concerns'] != null){
			$feedback->concerns = implode(', ', $request['concerns']);
		}
		$feedback->refer = $request['refer'];
		$feedback->save();

		Session::flash('message', 'Thanks for giving your valuable feedback!'); 
		Session::flash('alert-class', 'alert-success'); 

		return response()->json(['success'=>'success']);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
