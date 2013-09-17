<?php
/**
 * @author gareth.evans
 */
class CubexCodeStandards_Sniffs_CodeAnalysis_MultipleBlankLineSniff
  implements PHP_CodeSniffer_Sniff
{
  public function register()
  {
    return array(T_WHITESPACE);
  }

  public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
  {
    $tokens           = $phpcsFile->getTokens();
    $blankLines       = 0;
    $previousStackPtr = $stackPtr - 1;
    $eolCharLen       = strlen($phpcsFile->eolChar);
    $errorSet         = false;

    if(isset($tokens[$stackPtr]))
    {
      //file_put_contents(__DIR__ . "/t.txt", print_r($tokens, true));
      do
      {
        if(isset($tokens[$stackPtr]['content']))
        {
          $startChar = substr($tokens[$stackPtr]['content'], 0, $eolCharLen);
          if($startChar === $phpcsFile->eolChar)
          {
            $blankLines++;
          }
          elseif($tokens[$stackPtr]['type'] !== "T_WHITESPACE")
          {
            break;
          }

          if($blankLines > 2 && !$errorSet)
          {
            $error = 'File must not contain multiple blank lines';
            $phpcsFile->addError(
              $error,
              $previousStackPtr,
              'MultipleBlankLines'
            );
            $errorSet = true;
          }

          $stackPtr++;
        }
      }
      while(isset($stackPtr));
    }
  }
}
