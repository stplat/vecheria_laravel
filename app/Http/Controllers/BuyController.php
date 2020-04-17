<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;

class BuyController {
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $to = 'info@vecheria.ru';
    $name = $request->input('name');
    $phone = $request->input('phone');
    $other = $request->input('other');
    $subject = 'Быстрая покупка';
    $message = 'ФИО: ' . $name . ', Телефон: ' . $phone . ' Товар: ' . $other;
    $headers = "Content-type: text/html; charset=urf-8 \r\n";
    $headers .= "From: <info@vecheria.ru>\r\n";
    $headers .= "Reply-To: info@vecheria.ru\r\n";
    
    mail($to, $subject, $message, $headers);
    
    Session::put('buy', 'sent');

    return Session::get('buy');
  }
}
