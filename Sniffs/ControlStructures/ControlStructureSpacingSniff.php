<?php
/**
 * CubexCodeStandards_Sniffs_ControlStructures_ControlStructureSpacingSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 */

/**
 * CubexCodeStandards_Sniffs_ControlStructures_ControlStructureSpacingSniff.
 *
 * Checks that control structures have the correct spacing around brackets.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 */
class CubexCodeStandards_Sniffs_ControlStructures_ControlStructureSpacingSniff
  implements PHP_CodeSniffer_Sniff
{
  /**
   * Returns an array of tokens this test wants to listen for.
   *
   * @return array
   */
  public function register()
  {
    return array(
      T_IF,
      T_WHILE,
      T_FOREACH,
      T_FOR,
      T_SWITCH,
      T_DO,
      T_ELSE,
      T_ELSEIF,
    );
  }//end register()

  /**
   * Processes this test, when one of its tokens is encountered.
   *
   * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
   * @param int                  $stackPtr  The position of the current token
   *                                        in the stack passed in $tokens.
   *
   * @return void
   */
  public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
  {
    $tokens = $phpcsFile->getTokens();

    if(isset($tokens[$stackPtr]['parenthesis_opener']))
    {
      if(!isset($tokens[$stackPtr]['scope_opener'])
       || !isset($tokens[$stackPtr]['scope_closer']))
      {
        $phpcsFile->addError(
          "No Scope Opener/Closer",
          $tokens[$stackPtr]['parenthesis_owner'],
          "NoScopeOpenerCloser"
        );
      }
    }
  }//end process()

}//end class
