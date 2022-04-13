<?php
namespace App\Service;

use App\Entity\Client;

/** 
 * Utility class that creates hash from data request to set License uid field 
 **/
class DataHasher
{
    public function getHashFromArray(array $arrayClient):string
    {
        $string = $arrayClient["lastName"].$arrayClient["firstname"].$arrayClient["type"];
      //  dd("LastName ",$arrayClient["lastName"]);
        $hashed = $this->hash($string);
        return $hashed;
    }

    public function getHashFromObject(Client $Client):string
    {
        $string = $Client->getLastName().$Client->getFirstname().$Client->getType();
        $hashed = $this->hash($string);
    //    dd("LastName ".$Client->getLastName());
        return $hashed;
    }

    private function hash(string $var):string
    {
      // var_dump(sha1($var));
        return sha1($var);
    }

}