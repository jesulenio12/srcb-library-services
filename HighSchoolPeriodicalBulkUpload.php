<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {

            //set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'bookperiodicalQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);

                $errorCorrectionLevel = 'H';
                $matrixPointSize = 10;

            if($_FILES['bookscsv_file']['name'])
            {
            $filename = explode(".", $_FILES['bookscsv_file']['name']);
            if(end($filename) == "csv")
            {
                $handle = fopen($_FILES['bookscsv_file']['tmp_name'], "r");
                while($data = fgetcsv($handle))
                {
                    if ($data[0]!='Title') {
                        $filename = '';
                        $bookAccessionFilename  = 'No.'.' '.$data[3];
                        $newfilename = $bookTitleFilename.'-'.$data[0].'('.$data[3].'-'.$data[1].').png';
                        $filename = $PNG_TEMP_DIR.$newfilename;
                        QRcode::png($bookAccessionFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
                        
                        $books = new Books();
                        try {
                            $books->create(array(
                                'bookTitle' => $data[0],
                                'callNumber' => $data[1],
                                'datePublished' => $data[2],
                                'bookAccession' => 'No.'.' '.$data[3],
                                'bookSection' => 'Periodical',
                                'libraryClass' => 'High School Library',
                                'status' => 'Available',
                                'qrcode' => $newfilename
                            ));
                        
                        } catch(Exception $e) {
                            echo ($e->getMessage());
                        }
                    }
                   
                }
                fclose($handle);
            }
                else
                    {
                    $message = '<label class="text-danger">Please Select CSV File only.</label>';
                    }
                }
                  
            else
            {
            $message = '<label class="text-danger">Please Select File.</label>';
            }
            
            Session::flash('Added', 'New books has been successfully added!');
            Redirect::to('admin.php?action=HighSchoolPeriodicalList');
           
}      
ob_end_flush();