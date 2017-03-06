<?php namespace App;

use App\FilemakerModel;
use \FileMaker;
use Validator;
class CommentModel extends FilemakerModel {

	public function __construct()
	{
		parent::__construct();

	}

        function utf8_encode_deep(&$input) {
            if (is_string($input))
            {
                $input = utf8_encode($input);
            } else if (is_array($input)) {
                foreach ($input as &$value)
                {
                    self::utf8_encode_deep($value);
                }
            }
        }
        
	public function createnewcomments($id, $name, $email, $content)
	{

      
      	if(FileMaker::isError($this->db))
			{
				dd($this->db->getMessage());
			}
			$record = $this->db->newAddCommand('Comments');
			$record -> setField('AuthorId', $id);
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
                    $resultsarray['AuthorId'] = $result->getField('AuthorId');
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
         public function getcommentdetailsbyId($request)
        {
             
            $record = $this->db->newFindCommand('Comments');
            $record->addFindCriterion('AuthorId', $request['id']);
            $result = $record->execute();
            if(FileMaker::isError($result))
                {
                        dd($result->getMessage());
                }
            $records = $result->getRecords();
            
            
                
            return $records;
        
        }

}
