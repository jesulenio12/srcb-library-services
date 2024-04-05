<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {

            //set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'discardedbookQRCodes'.DIRECTORY_SEPARATOR;
			
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
                        $bookAccessionFilename  = 'Acc:'.' '.$data[1];
                        $newfilename = $bookTitleFilename.'-'.$data[0].'('.$data[1].'-'.$data[19].').png';
                        $filename = $PNG_TEMP_DIR.$newfilename;
                        QRcode::png($bookAccessionFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
                        
                        $books = new Books();
                        try {
                            $books->create(array(
                                'bookTitle' => $data[0],
                                'bookAccession' => 'Acc:'.' '.$data[1],
                                'isbn' => $data[2],
                                'callNumber' => $data[3],
                                'bookDescription' => $data[4],
                                'subject' => $data[5],
                                'otherSubject' => $data[6],
                                'author' => $data[7],
                                'otherAuthor' => '/'.$data[8],
                                'etAl_authors' => $data[9],
                                'authorNumber' => $data[10],
                                'glossary' => 'Glossary: p.'.' '.$data[11],
                                'bibliography' => 'Bibliography: p.'.' '.$data[12],
                                'appendix' => 'Appendix: p.'.' '.$data[13],
                                'indexNumber' => 'Index: p.'.' '.$data[14],
                                'includes' => 'Includes'.' '.$data[15],
                                'publisher' => $data[16],
                                'datePublished' => $data[17],
                                'bookSection' => $data[18],
                                'libraryClass' => 'High School Library',
                                'is_borrowed' => '0',
                                'requested' => '0',
                                'approved' => '0',
                                'received' => '0',
                                'discarded' => '1',
                                'lost' => '0',
                                'remove' => '0',
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
            Redirect::to('admin.php?action=HighSchoolDiscardedBooks');
           
}      
ob_end_flush();