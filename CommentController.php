<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\CommentModel;
use Validator;

use session;

class CommentController extends Controller {

    
	/**
	 *create new comment with respect to the AuthorId
	 *
	 *@return response(json data).
	 */
	public function createcomments(Request $request)
	{
            
          
            $object = new CommentModel();
            
            $id=$request->input('id');
            $name=$request->input('name');
            $email=$request->input('email');
            $content=$request->input('comment');
            //dd($id,$name);
            $resultsarray= $object->createnewcomments($id, $name, $email, $content);
            //$object->utf8_encode_deep($resultsarray);
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
