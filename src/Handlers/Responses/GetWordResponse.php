<?php
namespace App\Handlers\Responses;

class GetWordResponse 
{
     public string $word;

     function __construct( string $word )
     {
          $this->word = $word;
     }
}

?>