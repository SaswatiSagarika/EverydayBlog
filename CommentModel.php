<?php
/**
    *File name: CommentModal.
    *File type: php.
    *Date of  creation:20th Feb 2017.
    *Author:mindfire solutions.
    *Purpose: this php file contains different functions to be called in controller file.
    *Path:D:\PHP Projects\blog and comments\blog1\app.
    **/

namespace App;

use App\FilemakerModel;
use \FileMaker;
use Validator;
class CommentModel extends FilemakerModel {

	public function __construct()
	{
		parent::__construct();

	}
        
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
	public function createnewcomments($id, $name, $email, $content)
	{

      
      	if(FileMaker::isError($this->db))
			{
				dd($this->db->getMessage());
			}
			$record = $this->db->newAddCommand('Comments');
			$record -> setField('BlogId', $id);
			$record -> setField('CommenterName', $name);
			$record -> setField('CommenterEmail', $email);
			$record -> setField('CommenterMessage', $content);
			$results = $record->execute();
		if(FileMaker::isError($results))
			{
				dd($results->getMessage());
			}
                       $results =$results->getRecords();
                foreach ($results as $result) {
                    $resultsarray['CommentId'] = $result->getField('CommentId');
                    $resultsarray['BlogId'] = $result->getField('BlogId');
                    $resultsarray['CommenterName'] = $result->getField('CommenterName');
                    $resultsarray['CommenterEmail'] = $result->getField('CommenterEmail');
                    $resultsarray['CommenterMessage'] = $result->getField('CommenterMessage');
                    $resultsarray['CommentDate'] = $result->getField('CommentDate');
                    $resultsarray['CommentTime'] = $result->getField('CommentTime');
                   }
                if(FileMaker::isError($resultsarray))
			{
				dd($resultsarray->getMessage());
			}
                        
             
                    return $resultsarray;
               
		
    
	}
        
        /**
        *  get the records details based on Id
        *
        * @param String $request - contain id variable .
        * @Param $id -releted record is searched based on it
        * 
        * @return records.
        */
         public function getcommentdetailsbyId($request)
        {
             
            $record = $this->db->newFindCommand('Comments');
            $record->addFindCriterion('BlogId', $request['id']);
            $result = $record->execute();
            if(FileMaker::isError($result))
                {
                        dd($result->getMessage());
                }
            $records = $result->getRecords();
            
            
                
            return $records;
        
        }

}
