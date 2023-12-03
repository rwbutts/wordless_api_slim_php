<?php
namespace App\Handlers\Responses;

class QueryMatchCountResponse 
{
     public int $count;

     function __construct( int $count )
     {
          $this->count = $count;
     }
}

?>