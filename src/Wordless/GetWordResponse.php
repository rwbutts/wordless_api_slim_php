<?php
namespace App\Wordless;

class GetWordResponse 
{
     public string $word;

     function __construct( string $word )
     {
          $this->word = $word;
     }
}

?>