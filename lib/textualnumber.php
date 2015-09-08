<?php

class TextualNumber {

    public  $string;
    public  $number;    
    private $fp;

    private $linefeed;
    private $data;
    
    function __construct($string){
        $this->string=$string;//which holds the file contents    
        //echo $this->string;
        $this->linefeed=explode(",",$this->string);            
        //print_r($this->linefeed);    
        $this->loopData();
    }
    
    
    function loopData(){
        foreach($this->linefeed as $key=>$value){
        $split=explode(".",$value);
        $rspart="Rupees ".$this->numToWords($split[0]);
        $pspart="";
        if(count($split)==2){
	        $pspart=($split[1]!="")?" and ".$this->numToWords($split[1])." Paise":"";
        }
	        $this->data[]=$rspart.$pspart;
        }
    }
    
    function numToWords($number){
    
      if (($number < 0) || ($number > 999999999)){
        return "$number out of script range";
      }

      $lakhs = floor($number / 100000);  /* lakhs (giga) */
      $number -= $lakhs * 100000;
      
      $thousands = floor($number / 1000);     /* Thousands (kilo) */
      $number -= $thousands * 1000;
      $hundreds = floor($number / 100);      /* Hundreds (hecto) */
      $number -= $hundreds * 100;
      $tens = floor($number / 10);       /* Tens (deca) */
      $ones = $number % 10;               /* Ones */
      $res = "";
      
      //echo "<hr>".$lakhs;
     

     if ($lakhs){
            
        $res .= $this->numToWords($lakhs) ;
        $res.=($lakhs>10)?" hundred":" hundred";
      }

      if($thousands){
        $res .= (empty($res) ? "" : " ") .
        $this->numToWords($thousands) . " Thousand";
      }

      if ($hundreds){
        $res .= (empty($res) ? "" : " ") .
        $this->numToWords($hundreds) . " Hundred";
      }

      $arr_ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
      "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
      "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
      "Nineteen");
      $arr_tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
        "Seventy", "Eighty", "Ninety");

    if ($tens || $ones){
        if (!empty($res)){
            $res .= " and ";
        }

        if ($tens < 2){
            $res .= $arr_ones[$tens * 10 + $ones];
        }
        else{
            $res .= $arr_tens[$tens];
            if ($ones){
                $res .= "-" . $arr_ones[$ones];
            }
        }
    }

    if (empty($res)){
        $res = "zero";
    }

    return $res; 
  }
    
  function flushData(){
    print_r($this->data);
  }    
}
