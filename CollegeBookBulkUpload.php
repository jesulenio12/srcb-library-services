<?php
ob_start();
require_once 'core/init.php';
include "qrLib/qrlib.php";    
if (Input::exists()) {
    $bookarray = '';
    $bookarray2 = "";
    $count = 0;
            //set it to writable location, a place for temp generated PNG files
			$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'hedBookQRCodes'.DIRECTORY_SEPARATOR;
			
			//ofcourse we need rights to create temp dir
			if (!file_exists($PNG_TEMP_DIR))
				mkdir($PNG_TEMP_DIR);

                $filename = '';

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
                      
                        $bookAccessionFilename  = 'Acc:'.' '.$data[1];
                        $newfilename = $data[0].'('.$data[1].'-'.$data[18].').png';
                        $filename = $PNG_TEMP_DIR.$newfilename;
                        QRcode::png($bookAccessionFilename, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
                        
                        $books = new Books();
                        try {
                            $count += 1;

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
                                'libraryClass' => 'College Library',
                                'finesperDueDate' => '3',
                                'totalFines' => '0',
                                'is_borrowed' => '0',
                                'requested' => '0',
                                'approved' => '0',
                                'received' => '0',
                                'status' => 'Available',
                                'discarded' => '0',
                                'lost' => '0',
                                'remove' => '0',
                                'qrcode' => $newfilename
                            ));
                        
                            //$bookarray = $bookarray."[".$count."]".$data[0].$data[1].$data[2].$data[3].$data[4].$data[5].$data[6].$data[7].$data[8].$data[9].$data[10].$data[11].$data[12].$data[13].$data[14].$data[15].$data[16].$data[17].$data[18]." <br>";

                        } catch(Exception $e) {    
                            echo $error, '<br>';
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
            

           Session::flash('Added', 'New books has been successfully added! ');
           Redirect::to('admin.php?action=CollegeBookList');
           
}      
ob_end_flush();