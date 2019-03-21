<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ConverterController extends Controller
{
   private $dictionaryRom = array('I' => 1, 'V' => 5, 'X' => 10, 'L' => 50,
        'C' => 100, 'D' => 500, 'M' => 1000);

   private $dictionaryArab = array(1000 => "M", 900 => "CM", 500 => "D", 400 => "CD",
        100 => "C", 90 => "XC", 50 => "L", 40 => "XL",
        10 => "X", 9 => "IX", 5 => "V", 4 => "IV", 1 => "I");


   public function converter(Request $request)
   {
      $num = $request->input('number');
      if(empty($num)) return response()->json(['error' => 'Empty value']);
      if(ctype_digit($num)){
         return $this->arabicToRoman($num);
      } else {
         return $this->romanToArabic($num);
      }

   }

   public function romanToArabic($num)
   {   
      $arr = str_split($num);      
      $length = count($arr);
      $active = 0;
      $result = 0;
      for ($i=$length -1; $i>=0; $i--){
         $next = $this->dictionaryRom[$arr[$i]];
         if($next < $active){
            $result -= $next;
         } else {
            $result +=$next;
            $active = $next;
         }         
      }
      //dd($result);
      //return response()->json(["result" => $result]);
      return response()->json($result);      
            

   }

   public function arabicToRoman($num)
   {        
      $amount = 0;
      $result = '';

      if ($num<0) $num =-$num;

      while($num) {
          foreach($this->dictionaryArab as $key => $char){

              if($key <= $num){
                  $amount = (int)($num/$key);
                  $num -= $key*$amount;
                  $result .= str_repeat($char, $amount);
              }
          }         
      }
      return response()->json($result);
      
   }
}