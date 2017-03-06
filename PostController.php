<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\PostModel;
use vendor\laravel\framework\src\Illuminate\Pagination\Paginator;
use session;
class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createnew(Request $request)
	{
		 $this->validate($request, [
                    'name' => 'required',
                    'subject' => 'required',
                    'email' => 'required',
                    'content' => 'required']);
                 
     	$object = new PostModel();
		$name=$request->input('name');
		$subject=$request->input('subject');
		$content=$request->input('content');
		return $object->createnewpost($name, $subject, $content);
    	return redirect('/list');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function readpost(Request $request)
	{
		$object = new PostModel();
		
		$record=$object->readpost($request);
                $records=$record['0'];
                $comments= $record['1'];
                
		return view('Pages.read', array('records' => $records,'comments' => $comments));
            
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showAllBlogRecords()
	{
		$object = new PostModel();
                
		$records=$object->showallblogrecords();
                
		return view('viewlist', array('records' => $records));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editblog(Request $request)
	{
		$object = new PostModel();


		$result=$object->editpost($request);	
		
                return redirect('/list');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteform(Request $request)
	{
	    $object = new PostModel();
            
            $records=$object->getblogdetailsbyId($request);
            return view('Pages.deleteblog', array('records' => $records));
           
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyblog(Request $request)
	{
            $object = new PostModel();
            $records=$object->deletepost($request);
            
            return redirect('/list');	
    	
	}
        public function editform(Request $request)
	{
		$object = new PostModel();
                $records=$object->getblogdetailsbyId($request);
                return view('Pages.editblog', array('records' => $records));
		
	}
}
