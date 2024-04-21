<?php
include_once __DIR__ . "/../db/database.php";
include_once __DIR__ . "/../service/Booking.php";
include_once __DIR__ . "/../service/Ticket.php";
// include "./Booking.php";

class Payment
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }


  public function savePayment($formData)
  {
    //print_r($formData);
    $ticketId = $formData['ticketId'];
    $method = $formData['method'];
    $accountNo = $formData['accountNo'];
    $contact = $formData['contact'];

    $insertQuery = "INSERT into payment(ticket_id, method, account_no, contact) 
    values ('$ticketId', '$method', '$accountNo', '$contact')";

    $savedPaymentId = $this->db->create($insertQuery);

    if ($savedPaymentId) {
      $savedPayment = $this->fetchPayment($savedPaymentId)->fetch_assoc();

      //add payment Id into $formData
      //$formData["paymentId"] = $savedPayment['id'];
      //update ticket
      $ticket = new Ticket();
      $savedTicket = $ticket->fetchTicket($savedPayment['ticket_id'])->fetch_assoc();
      $savedTicket['payment_id'] = $savedPayment['id'];
      $savedTicket['paid'] = true;
      $savedTicket['hold'] = 0;

      $updatedTicket = $ticket->updateTicket($savedTicket);

      //return array_merge($savedPayment, $updatedTicket);
      return $savedPayment;
    } else {
      return null;
    }
  }

  public function fetchPayments()
  {
    $selectQuery = "select * from payment";
    $payments = $this->db->select($selectQuery);
    if ($payments)
      return $payments;
    else
      return array(); //return empty array
  }

  public function fetchPayment($id)
  {
    $selectQuery = "select * from payment where id=$id";
    $payment = $this->db->select($selectQuery);
    if ($payment)
      return $payment;
    else
      return null;
  }


  // public function updatePayment($formData)
  // {
  //   //print_r($formData);
  //   $id = $formData['id'];
  //   $userId = $formData['userId'];
  //   $firstName = $formData['firstName'];
  //   $lastName = $formData['lastName'];
  //   $nationality = $formData['nationality'];
  //   $passport = $formData['passport'];
  //   $email = $formData['email'];
  //   $contact = $formData['contact'];

  //   $updateQuery = "UPDATE payment SET 
  //     user_id = '$userId', 
  //     first_name = '$firstName', 
  //     last_name = '$lastName', 
  //     nationality = '$nationality', 
  //     passport = '$passport',
  //     email = '$email',
  //     contact = '$contact'
  //     WHERE id = $id";

  //   $updatedData = $this->db->create($updateQuery);
  // }
}
