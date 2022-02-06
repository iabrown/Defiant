<?php

function console_log( $output, $with_script_tags = true ){
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';

  if ( $with_script_tags ){
    $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}

function findWordsBetweenBrackets() {
  // Open a text file to read, if it does not open give an error message.
  $myFile = fopen("text.txt","r") or die("Unable to open file.");

  // When the file is open, run this loop while the end of the file is not reached.
  while(!feof($myFile)) {

    // place the text from the file into a string.
    $fileString =  fread($myFile, filesize("text.txt"));
    echo ($fileString);  //Echo the text information on the web browser just for looks.


    // Define what to look for in the string, in this case we are looking for open and closed brackets.
    $findMe = "[";
    $findMe2 = "]";

    // Use this search offsets for the strpos() function to loop through the next instance of a found word.
    $searchOffset = 0;
    $searchOffset2 = 0;


    // Use a loop to search every word in the text file.
    for ($i=0; $i <= str_word_count($fileString); $i++) {
      $foundWord = "";


      // The foundStrings below are used to find the index values of the open and closed brackets
      $foundString = strpos($fileString, $findMe, $searchOffset);
      $foundString2 = strpos($fileString, $findMe2, $searchOffset2);

      // Check to see if there were no brackets found or if the end of the file is reach. If so, break this IF Statement.
      if ($foundString === false || $foundString2 === false || feof($myFile)) {

        break;

      } else {

        // Use the index values from foundString and foundString2 to get the length of the word/words between the open and closed brackets.
        // Then print the word/words using the loop below.

        for ($j = $foundString+1; $j < $foundString2; $j++) {
          $foundWord .= $fileString[$j];

        }
        console_log($foundWord);

      }

      // Increment the offsets to find the next instance of a word between brackets.
      $searchOffset = $foundString +1;
      $searchOffset2 = $foundString2 +1;
    }
  }



  //Close the file once done.
  fclose($myFile);

}

?>
