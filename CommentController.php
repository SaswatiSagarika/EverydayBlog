<?php
/**
    *File name: CommentController.
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
use App\CommentModel;
use Validator;

use session;

class CommentController extends Controller {

    
	/**
	 *create new comment with respect to the BlogId
	 *@param $id
	 *@param $name
	 *@param $email
	 *@param conent
	 *
	 *@param $resultarray
	 *@return response(json data).
	 */
	public function createcomments(Request $request)
	{
            
          
            $object = new CommentModel();
            
            $id=$request->input('id');
            $name=$request->input('name');
            $email=$request->input('email');
            $content=$request->input('comment');
            
            $resultsarray= $object->createnewcomments($id, $name, $email, $content);
            
            return response()->json($resultsarray);
            
	}

	/**
	 * Display the comments realted to given id.
	 *
	 * @return Comments
	 */
	public function showcomments(Request $request)
	{
		$object = new CommentModel();
		
		$comments=$object->getcommentdetailsbyId($request);
               
		return view('Pages.read', array('comments' => $comments));
            
	}


}
