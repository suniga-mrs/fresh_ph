$(document).ready(function() {

// === REGISTER VALIDATION === REGISTER VALIDATION === REGISTER VALIDATION === REGISTER VALIDATION 

	const username = $('input#username');
	const password = $('input#password');
	const confirm_password = $('input#confirm_password');
	const firstname = $('input#firstname');
	const lastname = $('input#lastname');
	const email = $('input#email');
	const address = $('input#address');
		
	


	function errorMsg(el, message) {
		el.parent().prev().append(`<span class="text-danger"> ${message}</span>`);
	}

	function resetMsg(el) {
		el.parent().prev().children('span').remove();
	}

	document.addEventListener("keyup", function(){
		// Make Sure all fields have values before activating Register Button
		if (username.val() && password.val() && firstname.val() && lastname.val() && email.val() && address.val() !== '') {
			$("#registerBtn").removeAttr('disabled');
		}
	});

	function validate_reg_form() {

		// let i_username = username.val();
		// let i_password = password.val();
		// let i_firstname = firstname.val();
		// let i_lastname = lastname.val();
		// let i_email = email.val();
		// let i_address = address.val();

		// let i_confirm_password = confirm_password.val();

		// if(i_username.length < 10) {
		// 	errorMsg(username, );
		// 	errors++;
		// } else {
		// 	$('#username').next().html(' ');
		// }

		// if (i_email.includes('@')) {
		// 	errorMsg(email, "Email is not valid")
		// }

		// if (i_password != i_confirm_password) {
		// 	errorMsg(confirm_password, "Password did not match")
		// }

	}

	
	$('#registerBtn').click(function(event) {

		let i_username = username.val();
		let i_password = password.val();
		let i_firstname = firstname.val();
		let i_lastname = lastname.val();
		let i_email = email.val();
		let i_address = address.val();
		let i_confirm_password = confirm_password.val();

		let errors = 0;

		if(i_username.length < 6) {
			errorMsg(username, "Username should be at least 6 characters" );
			errors++;
		} else {
			$('#username').next().html(' ');
		}

		if (!i_email.includes('@')) {
			errorMsg(email, "Email is not valid");
			errors++;
		}

		if (i_password.length < 8) {
			errorMsg(password, "Provide a stronger password");
			password.val() = "";
			errors++;
		} else {
			if (i_password != i_confirm_password) {
				errorMsg(confirm_password, "Not match");
				errors++;
			}
		}

		if(errors === 0){
			$.ajax({
				url: '../controllers/create_user.php',
				type: 'POST',
				data: {
					username: username.val(),
					password: password.val(),
					firstname: firstname.val(),
					lastname: lastname.val(),
					email: email.val(),
					address: address.val()
				},
				success:(data) => {
					// console.log(data);
					if(data == "user_exists") {
						errorMsg(username, "Username is already taken");
					} else {
						alert("user created successfully");
						window.location.replace("../../index.php")
					}
				}

			});
		} 
		 
	});

	$('#loginBtn').click(function(event) {
		// resetMsg(username);
	});

	$(document).on('click', '.add-to-cart', function(event) {
		event.preventDefault();
		event.stopPropagation();

		//target is the one who triggered the event
		let item_id = parseInt($(event.target).attr("data-id"));
		let item_qty = parseInt($(event.target).prev().val());

		alert(typeof(item_id) + item_id + " with a quantity of " + item_qty);

		$.ajax({
			url: '../controllers/update_cart.php',
			type: 'POST',
			data: {
				item_id: item_id,
				item_qty: item_qty
			},
			success: (data)=> {
				$('#cart-count').html(data);
			}
		});
		
	});

	$('#empty_cart').click(function(event) {
		// event.preventDefault();
		// $.ajax({
		// 	url: '../controllers/empty_cart.php',
		// 	data: {}
		// });
		
	});


// === END REGISTER VALIDATION === END REGISTER VALIDATION === END REGISTER VALIDATION === END REGISTER VALIDATION 




});