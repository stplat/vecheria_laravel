<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;

class CallbackController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request) {
    $to = 'info@vecheria.ru';
    $name = $request->input('name');
    $phone = $request->input('phone');
    $subject = 'Новая заявка на покупку в один клик';
    $message = 'ФИО: ' . $name . ', Телефон: ' . $phone;
    $headers = 'From: vecheria.ru' . "\r\n" .
      'Reply-To: info@vecheria.ru' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    Session::put('callback', 'sent');

    return Session::get('callback');
  }
}
