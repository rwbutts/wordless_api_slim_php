<?php
namespace App\Handlers\Responses;

class CheckWordResponse 
{
     public bool $exists;

     function __construct( bool $exists )
     {
          $this->exists = $exists;
     }
}

?>