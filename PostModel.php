<?php
/**
    *File name: Postmodal.
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
class PostModel extends FilemakerModel {
    
        //calling the FM constuctor class
        public function __construct()
        {
            parent::__construct();
        }
        
        /**
	 * create new blogs.
	 *
	 * @param  int  $name,$subject, $content
	 * 
	 * @return $records
	 */
        public function createnewpost($name, $subject, $content)
        {      
    
            $record = $this->db->newAddCommand('blogger');
            $record -> setField('AuthorName', $name);
            $record -> setField('SubjectTitle', $subject);
            $record -> setField('Subject', $content);
            $result = $record->execute();
            
            if(FileMaker::isError($result))
            {
                dd($result->getMessage());
            }
                       
            return redirect('/list');
    
        }
        
        /**
        * Checks for valid date.
        *
        * @param String $date - Date in string format.
        * @return Boolean.
        */
        function isValidDate($date)
        {
            
            return DateTime::createFromFormat('m/d/Y', $date);
        
        }
        
         /**
        * delete the record by given id.
        *
        * @param request id -based on which the record is deleted .
        */
        public function deleteRecord($request)
        {
            
            $deleteRecord = $this->db->newDeleteCommand('Blogger',$request['id']);
            $result = $deleteRecord->execute();
        
        }
     
        /**
        *  Show all records present in the DB with pagination and alos perform search opration on them.
        *
        * @param String $request - contain search and skip variable.
        * @param String $search - string needed to be searched in the DB
        * @param Int $Skip -contain the pageno value
        * 
        * @return records.
        */
        public function showallblogrecords($request)
        {	
            
            $search = $request['search'];   
   
            //perform compound fine if $search is not empty
            if(!empty($search)) {
                
                //$findCommand1 = $this->db->newFindRequest('Blogger');
                //$findCommand1->addFindCriterion('AuthorName',$search );
                //
                //$findCommand2 = $this->db->newFindRequest('Blogger');
                //$findCommand2->addFindCriterion('SubjectTitle', $search);
                //
                //$findCommand3 = $this->db->newFindRequest('Blogger');
                //$findCommand3->addFindCriterion('Date', isValidDate($search));
                //                
                //$record = $this->db->newCompoundFindCommand('Blogger');
                //$record->add(1, $findCommand1);
                //$record->add(2, $findCommand2);
                //$record->add(3, $findCommand3);
                //$record->addSortRule('BlogId', 1, FILEMAKER_SORT_ASCEND);
                
                $record = $this->db->newPerformScriptCommand('Blogger', 'CompoundSearch', $search);
                $result = $record->execute();
                
                $records = $result->getRecords();
                if(FileMaker::isError($result) == true)
                {
                    $records=0;
                }
            } else {
            
                //incase search value is not present
                 $record = $this->db->newFindAllCommand('Blogger');    
                       
                //Set a Max value. getting the Skip value( pageno)
                $max=3;
                $skip= $request['skip'];
                if(!isset($skip)) { $skip = 0; }
                else{ $skip= $skip*3; }
                
                //Get max Record count for blogger layout
                //$record->setRange(0,1);  
                $result=$record->execute();
                $maxRecords = $result->getFoundSetCount();  
                //$result->clearRange();
               
                // get Window range of $max of $maxRecords 
                $record->setRange($skip, $max);
                $page1 = $record->execute();  
                     
                $records=$page1->getRecords();
            }
            return $records;
        
        }      
       
        /**
            *  save the fields where changes are made
            *
            * @param String $request - contain id variable.
            * 
            */
        public function editpost($request)
        {
    
            $record = $this->db->newFindCommand('blogger');
            
            //search the record by id
            $record->addFindCriterion('BlogId', $request['id']);
            $result = $record->execute();
            
            if(FileMaker::isError($result))
            {
                dd($result->getMessage());
            }
    
            $records =$result->getRecords();
            //save the changes made in the edit page
            foreach($records as $record){
                
                $record -> setField('AuthorName',$request['name'] );
                $record -> setField('SubjectTitle', $request['subject']);
                $record -> setField('Subject', $request['content']);
                $record->commit();
            
            }
            
             return $records;

        }
        
        /**
        *  Show the selected record along with its comments
        *
        * @param String $request - contain id variable .
        * @param  $comments - comments searched from the DB
        * @param  $records -record searched from the Db
        * 
        * @return records and $comments.
        */
        public function readpost($request)
        {
      
            $record = $this->db->newFindCommand('blogger');
            $record->addFindCriterion('BlogId', $request['id']);
            
            $result = $record->execute();
            $records = $result->getRecords();
            
            foreach($records as $record){
                
                $comments = $record->getRelatedSet('Blog_Comments__BlogId');
                        
                if(FileMaker::isError($comments)== true)
                {
                    $comments = 0;
                }
            }
            
           return [$records, $comments];
                    
        }
        
        /**
        *  delete the slected record
        *  
        * @param String $request - contain id variable .
        * @Param $id -releted record is deleted based on it
        * 
        * @return records.
        */
        public function deletepost($request)
        {
    
            $record = $this->db->newDeleteCommand('blogger',$request['id']);
            $result = $record->execute();
            $records = $result->getRecords();
            return $records;
        
        }
        
        /**
        *  get the records details based on Id
        *
        * @param String $request - contain id variable .
        * @Param $id -releted record is searched based on it
        * 
        * @return records.
        */
        public function getblogdetailsbyId($request)
        {
             
            $record = $this->db->newFindCommand('Blogger');
            $record->addFindCriterion('BlogId', $request['id']);
            $result = $record->execute();
            
            $records = $result->getRecords();
            return $records;
        
        }
   
}
