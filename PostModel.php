<?php 
namespace App;

use App\FilemakerModel;
use \FileMaker;
use Validator;
class PostModel extends FilemakerModel {

	public function __construct()
	{
		parent::__construct();

	}

	public function createnewpost($name, $subject, $content)
	{

      
      	if(FileMaker::isError($this->db))
			{
				dd($this->db->getMessage());
			}
			$record = $this->db->newAddCommand('blogger');
		$record -> setField('AuthorName', $name);
		$record -> setField('SubjectTitle', $subject);
		$record -> setField('Subject', $content);
		$result = $record->execute();
		if(FileMaker::isError($result))
			{
				dd($result->getMessage());
			}


		dd($result->getRecords());
     //    Session::flash('success','New record is successfully created');
    	// return redirect('/home');
	}
	public function deleteRecord($request)
    {
        $deleteRecord = $this->db->newDeleteCommand('Blogger',$request['id']);
        $result = $deleteRecord->execute();

    }

    public function showallblogrecords()
    {	
    	
        $record = $this->db->newFindAllCommand('Blogger');
        if(FileMaker::isError($record))
			{
				dd($record->getMessage());
			}
        
        $records=$result->getRecords();
        
        //Set a Max value. getting the Skip value( pageno)
            $max= 2;
            $skip= $request['pageid'];
            if(!isset($skip)) { $skip = 0; }
            $result->setRange($skip, $max);
            
            $offset= $max*($skip-1);
            
            
        // Perform the Find
            
            $result=$record->execute();
            
            if (FileMaker::isError($result)) {
                
            if ($result->code = 401) {
                
                $errorMessage = "There are no Contacts that match that request: " . ' (' . $result->code . ')';
            
            } else {
                
                $errorMessage = "Contacts Find Error: " . $result->getMessage() . ' (' . $result->code . ')';
            
            }
            
            } else {
                
             // Get the found records and setup page navigation links   
                $records = $result->getRecords();
                $found = $result->getFoundSetCount();
                $fetchcount = $result->getFetchCount();
                
                $totalpages = ceil(count($found)/$max);
                
            }      
        //return $records;
    }
    public function editpost($request)
	{
   
      
      	if(FileMaker::isError($this->db))
			{
				dd($this->db->getMessage());
			}
		$record = $this->db->newFindCommand('blogger');
                $record->addFindCriterion('AuthorId', $request['id']);
		$result = $record->execute();
                
		if(FileMaker::isError($result))
			{
				dd($result->getMessage());
			}


		$records =$result->getRecords();
                foreach($records as $record){
                $record -> setField('AuthorName',$request['name'] );
		$record -> setField('SubjectTitle', $request['subject']);
		$record -> setField('Subject', $request['content']);
                $record->commit();
                }
                
                 return $records;
     //    Session::flash('success','New record is successfully created');
    	// return redirect('/home');
	}
	public function readpost($request)
	{

      
            
                
            $record = $this->db->newFindCommand('blogger');
            $record->addFindCriterion('AuthorId', $request['id']);
            
            $result = $record->execute();
            $records = $result->getRecords();
            foreach($records as $record){
            $comments = $record->getRelatedSet('Blog_Comments__authorId');
             
            
            if(FileMaker::isError($result))
                {
                        dd($result->getMessage());
                }
            // foreach($comments as $comment){
            //
            // echo $comment->getField('Blog_Comments__authorId::CommenterName');
            //}    
            }
           return [$records, $comments];
           
            
	}
        
        public function deletepost($request)
	{

      
            if(FileMaker::isError($this->db))
                {
                        dd($this->db->getMessage());
                }
            $record = $this->db->newDeleteCommand('blogger',$request['id']);
            $result = $record->execute();
			
		
        
	}
	public function getblogdetailsbyId($request)
        {
             
            $record = $this->db->newFindCommand('Blogger');
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
