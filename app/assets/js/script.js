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

	function resetMsg() {
		$('input#username').parent().prev().children('span').remove();
		$('input#password').parent().prev().children('span').remove();
		$('input#confirm_password').parent().prev().children('span').remove();
		$('input#firstname').parent().prev().children('span').remove();
		$('input#lastname').parent().prev().children('span').remove();
		$('input#email').parent().prev().children('span').remove();
		$('input#address').parent().prev().children('span').remove();

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

		resetMsg();

		let i_username = username.val();
		let i_password = password.val();
		let i_email = email.val();
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
			i_password = "";
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

// === END REGISTER VALIDATION === END REGISTER VALIDATION === END REGISTER VALIDATION === END REGISTER VALIDATION 

	$('#loginBtn').click(function(event) {
		let username = $("#username").val();
		let password = $("#password").val();

		// alert(username + " " + password);
		$.ajax({
			"url" : "../controllers/authenticate.php",
			"method" : "POST",
			"data": {
				'username':username,
				'password':password
			},

			"success":(data) => {
				if(data == "login_failed") {
					$("#username").next().html("Please provide correct credentials");
				} else {
					window.location.replace("../views/index.php");
				}
			}
		});

	});

	$(document).on('click', '.add-to-cart', (e) => {
		//to prevent default behavior and to override it with our own
		e.preventDefault();
		//prevent parent elements to be triggered
		// e.stopPropagation();

		// target is the one who triggered event
		let item_id = $(e.target).attr("data-id");
		let item_quantity = parseInt($(e.target).prev().val());

		alert( item_id + " with a quantity of " + item_quantity);

		if(!(isNaN(item_quantity))) {
			$.ajax({
				"url" : "../controllers/update_cart.php",
				"method" : "POST",
				"data" : {
					'item_id':item_id,
					'item_qty':item_quantity,
					'update_from_cart_page': 0
				},
				"success" : (data) => {
					$("#cart-count").html(data);
				}
			});

		} else {
			alert("Something went wrong.");
		}

	});




	// $(document).on('click', '.add-to-cart', function(event) {
	// 	event.preventDefault();
	// 	event.stopPropagation();
		//target is the one who triggered the event
		// let item_id = parseInt($(event.target).attr("data-id"));
		// let item_qty = parseInt($(event.target).prev().val());

		// // alert(typeof(item_id) + item_id + " with a quantity of " + item_qty);

		// if(!(isNaN(item_qty))) {
		// 	$.ajax({
		// 		url: '../controllers/update_cart.php',
		// 		type: 'POST',
		// 		data: {
		// 			item_id: item_id,
		// 			item_qty: item_qty,
		// 			update_from_cart_page: 0
		// 		},
		// 		success: (data)=> {
		// 			$('#cart-count').html(data);
		// 		}
		// 	});
		// } else {
		// 	alert("Something went wrong.");
		// }
		
	// });

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	function removeCommas(x) {
		return x.replace(/\,/g,"")
	}

	function get_total() {
		let total = 0;

		$(".item_subtotal").each(function(e) {
			total += parseFloat(removeCommas($(this).html()));
		});

		console.log(total);
		$("#total_price").html(numberWithCommas(total.toFixed(2)));
	}

	//edit cart
	$('.item_quantity>input').on('input', (e) => {

		let item_id = $(e.target).attr('data-id');
		let item_qty = parseInt($(e.target).val());
		let price = parseFloat($(e.target).parents('tr').find(".item_price").html());

		// console.log(item_id + " " + item_qty + " " + price);

		let subtotal = item_qty * price;
		// $(e.target).parents('tr').find('.item_subtotal').html(subtotal.toFixed(2));
		$(e.target).parents('tr').find('.item_subtotal').html(numberWithCommas(subtotal.toFixed(2)));

		// console.log(subtotal);

		$.ajax({
			url: '../controllers/update_cart.php',
			type: 'POST',
			data: {
				item_id: item_id,
				item_qty: item_qty,
				update_from_cart_page: 1
			},
			success: (data) => {
				$('#cart-count').html(data);
				get_total();
			}
		});	

	});


	$(document).on('click', '.item-remove', function(e) {
		// alert("clicked");
		let item_id = $(e.target).attr('data-id');
		// alert(item_id);

		$.ajax({
			url: '../controllers/update_cart.php',
			type: 'POST',
			data: {
				item_id: item_id,
				item_qty: 0
			},
			beforeSend: () => {
				return confirm("Are you sure you want to delete this item?");
			},
			success: (data) => {
					$(e.target).parents('tr').fadeOut('slow');
					$('#cart-count').html(data);
					get_total();
					setTimeout(function(){ 
						$(e.target).parents('tr').remove();
						window.location.replace("../views/cart.php")
					}, 900);
			}
		});

	});


	$('#update_info').click( () => {
		$('#update_user_details').submit();
	});


	$(document).on('click', '.delete_item', function(e) {
		e.preventDefault();

		let item_id = $(e.target).attr('data-id');
		// alert(item_id);

		if (item_id !== undefined) {
			$.ajax({
				url: '../controllers/process_delete_item.php',
				type: 'GET',
				data: {
					id: item_id
				},
				beforeSend: () => {
					return confirm("Are you sure you want to delete this item?");
				},
				success: (data) => {

					if (data == "") {
						window.location.replace("../views/items.php");
					} else {
						alert('Item cannot be deleted');
					}
				}
			});
		} else {
			alert("Something went wrong.");
		}


	});

	$(document).on('click', '.admin_user_ctrl', function(e) {
		e.preventDefault();
		let user_id = $(e.target).attr('data-user-id');
		let user_role = $(e.target).attr('data-user-role');
		// alert(user_id + " and " + user_role);
		if (user_id !== undefined || user_role !== undefined ) {
			$.ajax({
				url: '../controllers/grant_admin.php',
				type: 'POST',
				data: {
					user_id: user_id,
					user_role: user_role
				},
				beforeSend: () => {
					return confirm("Are you sure you want to change account type?");
				},
				success: (data) => {
					if (data == "failed") {
						alert('User role cannot be changed');
					} else {
						window.location.replace("../views/users.php");
						
					}
				}
			});
		} else {
			alert("Something went wrong.");
		}


	});


	$(document).on('click', '.admin_user_del', function(e) {
		e.preventDefault();
		e.stopPropagation();

		let user_id = $(e.target).attr('data-user-id');
		// alert(user_id + " and " + user_role);
		if (user_id !== undefined) {
			$.ajax({
				url: '../controllers/delete_user.php',
				type: 'POST',
				data: {
					user_id: user_id
				},
				beforeSend: () => {
					return confirm("Are you sure you want to delete this account?");
				},
				success: (data) => {
					if (data == "failed") {
						alert('Account cannot be deleted');
					} else {
						$(e.target).parents('tr').fadeOut('slow');
						setTimeout(function(){ 
							$(e.target).parents('tr').remove();
							window.location.replace("../views/cart.php")
						}, 900);
			
					}
				}
			});
		} else {
			alert("Something went wrong.");
		}


	});


	$(document).on('click', '.order_ctrl', function(e) {
		e.preventDefault();
		e.stopPropagation();

		let order_id = $(e.target).attr('data-order-id');
		let new_status = $(e.target).attr('data-status');
		// alert(user_id + " and " + user_role);
		if (order_id !== undefined && new_status !== undefined) {
			$.ajax({
				url: '../controllers/change_order_status.php',
				type: 'POST',
				data: {
					order_id: order_id,
					new_status: new_status
				},
				beforeSend: () => {
					return confirm("Are you sure you want to change this order's status?");
				},
				success: (data) => {
					if (data == "failed") {
						alert('Status was not changed.');
					} else {
						//add confirmation that the item was updated
						window.location.replace("../views/orders.php");			
					}
				}
			});
		} else {
			alert("Something went wrong.");
		}


	});






});