<?php 

	session_start();
	require_once './connect.php';

	function generate_new_transaction_number() {
		$ref_number = '';

		$source = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];


		for($i = 0; $i<16; $i++) {
			$index = rand(0,15);

			$ref_number .= $source[$index];
		}

		$today = getdate();
		return $ref_number.'-'.$today[0]; // seconds since Unix Epoch
	}

	$user_id = $_SESSION['user']['id'];
	$purchase_date = date("Y-m-d G:i:s");
	$status_id = 1;
	$payment_mode_id = 1;
	$address = $_POST['addressLine1'];
	$transaction_code = generate_new_transaction_number();


	$sql = "INSERT INTO orders(user_id, transaction_code, purchase_date, status_id, payment_mode_id) VALUES ('$user_id', '$transaction_code', '$purchase_date', '$status_id', '$payment_mode_id')";

	$result = mysqli_query($conn, $sql);


	$new_order_id = mysqli_insert_id($conn); // Returns the id (generated with AUTO_INCREMENT) used in the last query, in this case the id from the query used to in the oreders table

	if($result) {

		foreach($_SESSION['cart'] as $item_id => $item_qty){
			$sql2 = "SELECT price FROM items WHERE id ='$item_id'";
			$result2 = mysqli_query($conn,$sql2);
			// var_dump($result);
			$item = mysqli_fetch_assoc($result2);

			$sql3 = "INSERT INTO order_items(order_id, item_id, price, quantity) VALUES ('$new_order_id', '$item_id', '".$item['price']."', '$item_qty')";

			$result3 = mysqli_query($conn, $sql3);

		}



	} 

	//clear items from cart
	$_SESSION['cart'] = [];

// Send email notification to customer
// ==============================================================================
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

$mail = new PHPMailer(true); 
// Passing `true` enables exceptions

$staff_email = 'mytest.mrs@gmail.com';
$customer_email = $_SESSION['user']['email'];          //
$subject = 'Fresh(tm) - Order Confirmation';
$body = '<div style="text-transform:uppercase;"><h3>Reference No.: '.$transaction_code.'</h3></div>'."<div>Ship to $address</div>";
try {
    //Server settings
    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $staff_email;                       // SMTP username
    $mail->Password = 'bayleaf1995';                     // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($staff_email, 'Fresh');
    $mail->addAddress($customer_email);  // Name is optional

    //Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $body;

    // Route user to confirmation page
    $_SESSION['new_txn_number'] = $transaction_code;
    header('location: ../views/confirmation.php');

    $mail->send();
    // echo 'Message has been sent';

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}






	mysqli_close($conn);





?>