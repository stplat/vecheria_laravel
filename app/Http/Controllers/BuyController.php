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
    $message = 'ФИО: ' . $name . ', Телефон: ' . $phone . ' Товар' . $other;
    $headers = 'From: vecheria.ru' . "\r\n" . 'Reply-To: info@vecheria.ru' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    
    mail($to, $subject, $message, $headers);
    
    Session::put('buy', 'sent');

    return Session::get('buy');
  }
}
