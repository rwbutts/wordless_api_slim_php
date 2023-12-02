<?php
namespace App\Wordless;

class CountMatchesResponse 
{
     public int $count;

     function __construct( int $count )
     {
          $this->count = $count;
     }
}

?>