<?php
namespace App\Wordless;

class CheckWordResponse 
{
     public bool $exists;

     function __construct( bool $exists )
     {
          $this->exists = $exists;
     }
}

?>