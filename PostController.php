<?php
/**
    *File name: PostController.
    *File type: php.
    *Date of  creation:10th May 2016.
    *Author:mindfire solutions.
    *Purpose: this php file contains different functions to be called in routes file.
    *Path:D:\PHP Projects\blog and comments\blog1\app\HTTP\Controller.
    **/
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\PostModel;
use vendor\laravel\framework\src\Illuminate\Pagination\Paginator;
use session;
class PostController extends Controller {

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
            $object->createnewpost($name, $subject, $content);
            
            return redirect('/list');
	
        }

	/**
	 * Store a newly created resource in storage.
	 *
	 *
	 * @return Records and comments
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
	 * Display the list of blog with pagination.
	 *
	 * @param  int  $skip
	 * @return $records
	 */
	public function showAllBlogRecords(Request $request)
	{
            $object = new PostModel();
            $records=$object->showallblogrecords($request);
            
            return view('viewlist', array('records' => $records));
	}

	/**
	 * Show the form for editing the blog resource.
	 *
	 * @param  int  $id
	 * @return to list page
	 */
	public function editblog(Request $request)
	{
            $object = new PostModel();
            $result=$object->editpost($request);	
            
            return redirect('/list');
	}

	/**
	 * delete form  to conform if they want to delete the blog
	 *
	 * @param  int  $id
	 * @return records
	 */
	public function deleteform(Request $request)
	{
	    $object = new PostModel();
            $records=$object->getblogdetailsbyId($request);
            
            return view('Pages.deleteblog', array('records' => $records));
	}

	/**
	 * Remove the specified blog from storage.
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
        
        /**
	 * go to specified blog from storage in the update form.
	 *
	 * @param  int  $id
	 * @return $records
	 */
        public function editform(Request $request)
	{
            $object = new PostModel();
            $records=$object->getblogdetailsbyId($request);
            
            return view('Pages.editblog', array('records' => $records));
		
	}
}
