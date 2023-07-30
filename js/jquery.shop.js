(function( $ ) {
	$.Shop = function( element ) {
		this.$element = $( element );
		this.init();
	};
	
	$.Shop.prototype = {
		init: function() {
		
		    // Properties
		
			this.cartPrefix = "milic-"; // Prefix string to be prepended to the cart's name in the session storage
			this.cartName = this.cartPrefix + "cart"; // Cart name in the session storage
			this.shippingRates = this.cartPrefix + "shipping-rates"; // Shipping rates key in the session storage
			this.total = this.cartPrefix + "total"; // Total key in the session storage
			this.storage = sessionStorage; // shortcut to the sessionStorage object
			
			
			this.$formAddToCart = this.$element.find( "form.add-to-cart" ); // Forms for adding items to the cart
			this.$formCart = this.$element.find( "#shopping-cart" ); // Shopping cart form
			this.$checkoutCart = this.$element.find( "#checkout-cart" ); // Checkout form cart
			this.$checkoutOrderForm = this.$element.find( "#checkout-order-form" ); // Checkout user details form
			this.$shipping = this.$element.find( "#sshipping" ); // Element that displays the shipping rates
			this.$subTotal = this.$element.find( "#stotal" ); // Element that displays the subtotal charges
			this.$totalCharges = this.$element.find( "#totalCharges" ); // Element that displays the total charges
			this.$shoppingCartActions = this.$element.find( "#shopping-cart-actions" ); // Cart actions links
			this.$updateCartBtn = this.$shoppingCartActions.find( "#update-cart" ); // Update cart button
			this.$emptyCartBtn = this.$shoppingCartActions.find( "#empty-cart" ); // Empty cart button
			this.$userDetails = this.$element.find( "#user-details-content" ); // Element that displays the user information
			this.$paypalForm = this.$element.find( "#paypal-form" ); // PayPal form
			this.$itemCounters = this.$element.find(".itemCounter"); // Cart badge, number of items, summary
			
			this.currency = "EUR"; // HTML entity of the currency to be displayed in the layout
			this.currencyString = "€"; // Currency symbol as textual string
			this.paypalCurrency = "EUR"; // PayPal's currency code
			this.paypalBusinessEmail = "yourbusiness@email.com"; // Your Business PayPal's account email address
			this.paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // The URL of the PayPal's form
			
			// Object containing patterns for form validation
			this.requiredFields = {
				expression: {
					value: /^([\w-\.]+)@((?:[\w]+\.)+)([a-z]){2,4}$/
				},
				
				str: {
					value: ""
				}
				
			};
			
			// Method invocation
			
			this.createCart();
			this.handleAddToCartForm();
			this.handleCheckoutOrderForm();
			this.emptyCart();
			this.updateCart();
			this.displayCart();
			this.deleteProduct();
			this.displayUserDetails();
			this.populatePayPalForm();
			
			
		},
		
		// Public methods
		
		// Creates the cart keys in the session storage
		createCart: function() {
			if( this.storage.getItem( this.cartName ) == null ) {
			
				var cart = {};
				cart.items = [];
			
				this.storage.setItem( this.cartName, this._toJSONString( cart ) );
				this.storage.setItem( this.shippingRates, 0 );
				this.storage.setItem( this.total, 0 );
			}
		},
		
		// Appends the required hidden values to the PayPal's form before submitting
		populatePayPalForm: function() {
			var self = this;
			if( self.$paypalForm.length ) {
				var $form = self.$paypalForm;
				var cart = self._toJSONObject( self.storage.getItem( self.cartName ) );
				var shipping = self.storage.getItem( self.shippingRates );
				var numShipping = self._convertString( shipping );
				var cartItems = cart.items; 
				var singShipping = Math.floor( numShipping / cartItems.length );
				
				$form.attr( "action", self.paypalURL );
				$form.find( "input[name='business']" ).val( self.paypalBusinessEmail );
				$form.find( "input[name='currency_code']" ).val( self.paypalCurrency );
				
				for( var i = 0; i < cartItems.length; ++i ) {
					var cartItem = cartItems[i];
					var n = i + 1;
					var name = cartItem.product;
					var price = cartItem.price;
					var qty = cartItem.qty;
					
					$( "<div/>" ).html( "<input type='hidden' name='quantity_" + n + "' value='" + qty + "'/>" ).
					insertBefore( "#paypal-btn" );
					$( "<div/>" ).html( "<input type='hidden' name='item_name_" + n + "' value='" + name + "'/>" ).
					insertBefore( "#paypal-btn" );
					$( "<div/>" ).html( "<input type='hidden' name='item_number_" + n + "' value='SKU " + name + "'/>" ).
					insertBefore( "#paypal-btn" );
					$( "<div/>" ).html( "<input type='hidden' name='amount_" + n + "' value='" + self._formatNumber( price, 2 ) + "'/>" ).
					insertBefore( "#paypal-btn" );
					$( "<div/>" ).html( "<input type='hidden' name='shipping_" + n + "' value='" + self._formatNumber( singShipping, 2 ) + "'/>" ).
					insertBefore( "#paypal-btn" );
					
				}
				
				
				
			}
		},
		
		// Displays the user's information
		
		displayUserDetails: function() {
			if( this.$userDetails.length ) {
				if( this.storage.getItem( "shipping-name" ) == null ) {
					var name = this.storage.getItem( "billing-name" );
					var email = this.storage.getItem( "billing-email" );
					var city = this.storage.getItem( "billing-city" );
					var address = this.storage.getItem( "billing-address" );
					var zip = this.storage.getItem( "billing-zip" );
					var country = this.storage.getItem( "billing-country" );
					
					var html = "<div class='detail'>";
						html += "<h2>Billing and Shipping</h2>";
						html += "<ul>";
						html += "<li>" + name + "</li>";
						html += "<li>" + email + "</li>";
						html += "<li>" + city + "</li>";
						html += "<li>" + address + "</li>";
						html += "<li>" + zip + "</li>";
						html += "<li>" + country + "</li>";
						html += "</ul></div>";
						
					this.$userDetails[0].innerHTML = html;
				} else {
					var name = this.storage.getItem( "billing-name" );
					var email = this.storage.getItem( "billing-email" );
					var city = this.storage.getItem( "billing-city" );
					var address = this.storage.getItem( "billing-address" );
					var zip = this.storage.getItem( "billing-zip" );
					var country = this.storage.getItem( "billing-country" );
					
					var sName = this.storage.getItem( "shipping-name" );
					var sEmail = this.storage.getItem( "shipping-email" );
					var sCity = this.storage.getItem( "shipping-city" );
					var sAddress = this.storage.getItem( "shipping-address" );
					var sZip = this.storage.getItem( "shipping-zip" );
					var sCountry = this.storage.getItem( "shipping-country" );
					
					var html = "<div class='detail'>";
						html += "<h2>Billing</h2>";
						html += "<ul>";
						html += "<li>" + name + "</li>";
						html += "<li>" + email + "</li>";
						html += "<li>" + city + "</li>";
						html += "<li>" + address + "</li>";
						html += "<li>" + zip + "</li>";
						html += "<li>" + country + "</li>";
						html += "</ul></div>";
						
						html += "<div class='detail right'>";
						html += "<h2>Shipping</h2>";
						html += "<ul>";
						html += "<li>" + sName + "</li>";
						html += "<li>" + sEmail + "</li>";
						html += "<li>" + sCity + "</li>";
						html += "<li>" + sAddress + "</li>";
						html += "<li>" + sZip + "</li>";
						html += "<li>" + sCountry + "</li>";
						html += "</ul></div>";
						
					this.$userDetails[0].innerHTML = html;	
				
				}
			}
		},

		// Delete a product from the shopping cart
		deleteProduct: function() {
			var self = this;
			if( self.$formCart.length ) {
				var cart = this._toJSONObject( this.storage.getItem( this.cartName ) );
				var items = cart.items;

				$( document ).on( "click", ".pdelete a", function( e ) {
					e.preventDefault();
					var productId = $( this ).data( "id" );
					var newItems = [];
					for( var i = 0; i < items.length; ++i ) {
						var item = items[i];
						var id = item.id;	
						if( id == productId ) {

							items.splice( i, 1 );
						}
					}
					newItems = items;
					var updatedCart = {};
					updatedCart.items = newItems;

					var updatedTotal = 0;
					var totalQty = 0;
					if( newItems.length == 0 ) {
						updatedTotal = 0;
						totalQty = 0;
					} else {
						for( var j = 0; j < newItems.length; ++j ) {
							var prod = newItems[j];
							var sub = prod.price * prod.qty;
							updatedTotal += sub;
							totalQty += prod.qty;
						}
					}
					

					self.storage.setItem( self.total, self._convertNumber( updatedTotal ) );
					var shipping = self._calculateShipping( totalQty ).toFixed(2);
					self.storage.setItem( self.shippingRates, self._convertNumber(shipping));

					self.storage.setItem( self.cartName, self._toJSONString( updatedCart ) );
					self._updateCounters(updatedCart.items);
					$( this ).parents( "#"+ productId ).remove();
					self.$subTotal[0].value = self.storage.getItem( self.total ) + " " + self.currency;
					self.$totalCharges[0].value = self.storage.getItem( self.total + shipping ) + " " + self.currency;
				});
			}
		},
		
		// Displays the shopping cart
		
		displayCart: function() {
			var cart = this._toJSONObject( this.storage.getItem( this.cartName ) );
			var items = cart.items;
			this._updateCounters(items);
			if( this.$formCart.length ) {
				
				var $cartItems = this.$formCart.find( "#cart-items" );
				
				if( items.length == 0 ) {
					$cartItems.html( "" );	
				} else {
				
				
					for( var i = 0; i < items.length; ++i ) {
						var item = items[i];
						var price = item['price'].toFixed(2);
						var html = `
						<div class="row product mb-4 d-flex justify-content-between align-items-center" id="${item['id']}">
							<div class="col-md-2 col-lg-2 col-xl-2">
								<img src="./${item['image']}" class="img-fluid rounded-3" alt="${item['image']}">
							</div>
							<div class="col-md-3 col-lg-3 col-xl-3">
								<h6 class="text-muted">${item['name']}</h6>
								<h6 class="text-black mb-0">${item['desc']}</h6>
							</div>
							<div class="pqty col-md-3 col-lg-3 col-xl-2 d-flex">
								<button class="btn btn-link px-2"
									onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
									<i class="fas fa-minus"></i>
								</button>

								<input id="qty-${item['id']}" 
								       min="0"
									   max="${item['stock']}"
									   name="qty-${item['id']}" 
									   value="${item['qty']}" 
									   type="number"
									   class="qty form-control form-control-sm" />

								<button class="btn btn-link px-2"
									onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
									<i class="fas fa-plus"></i>
								</button>
							</div>
							<div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
								<input id="price_${item['currency']}-${item['id']}" 
									   name="price_${item['currency']}-${item['id']}" 
									   value="${price} ${item['currency']}" 
									   type="text"
									   class="mb-0 form-control form-control-sm" readonly/>
							</div>
							<div class="col-md-1 col-lg-1 col-xl-1 text-end pdelete">
								<a href='' data-id='${item['id']}' class="text-muted"><i class="fas fa-times"></i></a>
							</div>
							<hr class="my-4">
						</div>
						`;
						// var html = "<tr>";
						// 	html += "<td>" + item.id + "</td>";
						// 	html += "<td>" + item.name + "</td>";
						// 	html += "<td>" + item.desc + "</td>";
						// 	html += "<td>" + item.abv + "</td>";
						// 	html += "<td>" + item.volume + "</td>";
						// 	html += "<td>" + item.year + "</td>";
						// 	html += "<td>" + item.image + "</td>";
						// 	html += "<td>" + item.stock + "</td>";
						// 	html += "<td class='pqty'><input type='text' value='" + item.qty + "' class='qty'/></td>";
					    // 	html += "<td class='pprice'>" + item.price + "</td>";
						// 	html += "<td>" + item.currency + "</td>";
						// 	html += "<td class='pdelete'><a href='' data-id='" + item.id + "'>&times;</a></td>";
						// 	html += "</tr>";
					
						$cartItems.html( $cartItems.html() + html );
					}

				}

				if( items.length == 0 ) {
					this.$subTotal[0].value = 0.00 + " " + this.currency;
					this.$totalCharges[0].value = 0.00 + " " +this.currency;
				} else {	
				
					var total = this._convertString(this.storage.getItem( this.total ));
					this.$subTotal[0].value = total.toFixed(2) + " " + this.currency;

					var shipping = this._convertString(this.storage.getItem( this.shippingRates ));
					this.$totalCharges[0].value = (total + shipping).toFixed(2) + " " + this.currency;
				}
			} else if( this.$checkoutCart.length ) {
				var checkoutCart = this._toJSONObject( this.storage.getItem( this.cartName ) );
				var cartItems = checkoutCart.items;
				var $cartBody = this.$checkoutCart.find( "tbody" );

				if( cartItems.length > 0 ) {
				
					for( var j = 0; j < cartItems.length; ++j ) {
						var cartItem = cartItems[j];
						var cartProduct = cartItem.product;
						var cartPrice = this.currency + " " + cartItem.price;
						var cartQty = cartItem.qty;
						var cartHTML = "<tr><td class='pname'>" + cartProduct + "</td>" + "<td class='pqty'>" + cartQty + "</td>" + "<td class='pprice'>" + cartPrice + "</td></tr>";
					
						$cartBody.html( $cartBody.html() + cartHTML );
					}
				} else {
					$cartBody.html( "" );	
				}

				if( cartItems.length > 0 ) {
				
					var cartTotal = this.storage.getItem( this.total );
					var cartShipping = this.storage.getItem( this.shippingRates );
					var subTot = this._convertString( cartTotal ) + this._convertString( cartShipping );
				
					this.$subTotal[0].innerHTML = this.currency + " " + this._convertNumber( subTot );
					this.$shipping[0].innerHTML = this.currency + " " + cartShipping;
				} else {
					this.$subTotal[0].innerHTML = this.currency + " " + 0.00;
					this.$shipping[0].innerHTML = this.currency + " " + 0.00;	
				}
			
			}
		},
		
		// Empties the cart by calling the _emptyCart() method
		// @see $.Shop._emptyCart()
		emptyCart: function() {
			var self = this;
			if( self.$emptyCartBtn.length ) {
				self.$emptyCartBtn.on( "click", function() {
					self._emptyCart();
				});
			}
		},
		
		// Updates the cart
		updateCart: function() {
			var cart = this._toJSONObject( this.storage.getItem( this.cartName ) );
			var items = cart.items;
			var total = this._convertString(this.storage.getItem( this.total ));
			var self = this;
		  	if( self.$updateCartBtn.length ) {
				self.$updateCartBtn.on( "click", function() {
				console.log("Update Cart");
				var $rows = self.$formCart.find( ".product" );
				console.log($rows.length);
				var totalQty = 0;
				
				$rows.each(function() {
					var $row = $( this );
					var newQty = self._convertString($row.find( ".pqty > .qty" ).val());
					console.log('newQty=' + newQty);
					var pid = self._convertString( $row.find( ".pqty > .qty" ).attr('id').split("-")[1]);
					console.log('pid=' + pid);
					items.forEach(element => {
						if(element['id'] == pid){
							oldQty = element['qty'];
							console.log('oldQty=' + oldQty);
							element['qty'] = newQty;
							console.log('oldTotal=' + total);
							total += (newQty - oldQty)*element['price'];
							console.log('newTotal=' + total);
						}
					})
				});
				cart.items = items;
				
				self.storage.setItem( self.total, total.toFixed(2));
				self.storage.setItem( self.cartName, self._toJSONString( cart ) );
				
			});
		  }
		},
		
		// Adds items to the shopping cart
		handleAddToCartForm: function() {
			var self = this;
			self.$formAddToCart.each(function() {
				var $form = $( this );
				var $product = $form.parent();
				var price = self._convertString( $product.data( "price" ) );
				var stock = $product.data("stock" );

				
				$form.on( "submit", function() {

					var qty = self._convertString( $form.find( ".qty" ).val() );
					var subTotal = qty * price;
					var total = self._convertString( self.storage.getItem( self.total ) );
					var sTotal = total + subTotal;
					self.storage.setItem( self.total, sTotal.toFixed(2) );
					self._addToCart({
						id: self._convertString($product.data("id")),
						name: $product.data( "name"),
						desc: $product.data( "desc"),
						abv: self._convertString($product.data( "abv")),
						volume: self._convertString($product.data("volume")),
						year: self._convertString($product.data("year")),
						currency: $product.data("currency"),
						image: $product.data("image"),
						stock: self._convertString(stock),
						price: self._convertString(price.toFixed(2)),
						qty: self._convertString(qty)
					});
					// var shipping = self._convertString( self.storage.getItem( self.shippingRates ) );
					// var shippingRates = self._calculateShipping( qty );
					// var totalShipping = shipping + shippingRates;
					
					// self.storage.setItem( self.shippingRates, totalShipping );
				});
			});
		},
		
		// Handles the checkout form by adding a validation routine and saving user's info into the session storage
		handleCheckoutOrderForm: function() {
			var self = this;
			if( self.$checkoutOrderForm.length ) {
				var $sameAsBilling = $( "#same-as-billing" );
				$sameAsBilling.on( "change", function() {
					var $check = $( this );
					if( $check.prop( "checked" ) ) {
						$( "#fieldset-shipping" ).slideUp( "normal" );
					} else {
						$( "#fieldset-shipping" ).slideDown( "normal" );
					}
				});
				
				self.$checkoutOrderForm.on( "submit", function() {
					var $form = $( this );
					var valid = self._validateForm( $form );
					
					if( !valid ) {
						return valid;
					} else {
						self._saveFormData( $form );
					}
				});
			}
		},
		
		// Private methods
		
		// Updates all counters (badge, num of items, total items)
		_updateCounters: function(items) {
			var numItems = 0;
			items.forEach(item => numItems += item['qty'])
			this.$itemCounters.each(function(){
				var $counter = $( this );
				$counter.html(numItems);
			});
		},

		// Empties the session storage
		_emptyCart: function() {
			this.storage.clear();
		},
		
		/* Format a number by decimal places
		 * @param num Number the number to be formatted
		 * @param places Number the decimal places
		 * @returns n Number the formatted number
		 */
		_formatNumber: function( num, places ) {
			var n = num.toFixed( places );
			return n;
		},
		
		/* Extract the numeric portion from a string
		 * @param element Object the jQuery element that contains the relevant string
		 * @returns price String the numeric string
		 */
		_extractPrice: function( element ) {
			var self = this;
			var text = element.text();
			var price = text.replace( self.currencyString, "" ).replace( " ", "" );
			return price;
		},
		
		/* Converts a numeric string into a number
		 * @param numStr String the numeric string to be converted
		 * @returns num Number the number
		 */
		_convertString: function( numStr ) {
			var num;
			if( /^[-+]?[0-9]+\.[0-9]+$/.test( numStr ) ) {
				num = parseFloat( numStr );
			} else if( /^\d+$/.test( numStr ) ) {
				num = parseInt( numStr, 10 );
			} else {
				num = Number( numStr );
			}
			
			if( !isNaN( num ) ) {
				return num;
			} else {
				console.warn( numStr + " cannot be converted into a number" );
				return false;
			}
		},
		
		/* Converts a number to a string
		 * @param n Number the number to be converted
		 * @returns str String the string returned
		 */
		_convertNumber: function( n ) {
			var str = n.toString();
			return str;
		},
		
		/* Converts a JSON string to a JavaScript object
		 * @param str String the JSON string
		 * @returns obj Object the JavaScript object
		 */
		_toJSONObject: function( str ) {
			var obj = JSON.parse( str );
			return obj;
		},
		
		/* Converts a JavaScript object to a JSON string
		 * @param obj Object the JavaScript object
		 * @returns str String the JSON string
		 */
		_toJSONString: function( obj ) {
			var str = JSON.stringify( obj );
			return str;
		},
		
		
		/* Add an object to the cart as a JSON string
		 * @param values Object the object to be added to the cart
		 * @returns void
		 */
		_addToCart: function( values ) {
			var cart = this.storage.getItem( this.cartName );
			
			var cartObject = this._toJSONObject( cart );
			var cartCopy = cartObject;
			var items = cartCopy.items;
			var found = false;
			items.forEach(element => {
				if(element['id'] == values['id']){
					element['qty'] = element['qty'] + values['qty'];
					element['stock'] = element['stock'] - values['qty'];
					found = true;
				} 
			});
			if (!found)
				items.push( values );
			
			this.storage.setItem( this.cartName, this._toJSONString( cartCopy ) );
		},
		
		/* Custom shipping rates calculation based on the total quantity of items in the cart
		 * @param qty Number the total quantity of items
		 * @returns shipping Number the shipping rates
		 */
		_calculateShipping: function( qty ) {
			var shipping = 0;
			if( qty >= 6 ) {
				shipping = 10;
			}
			if( qty >= 12 && qty <= 30 ) {
				shipping = 20;	
			}
			
			if( qty >= 30 && qty <= 60 ) {
				shipping = 30;	
			}
			
			if( qty > 60 ) {
				shipping = 0;
			}
			
			return shipping;
		
		},
		
		/* Validates the checkout form
		 * @param form Object the jQuery element of the checkout form
		 * @returns valid Boolean true for success, false for failure
		 */
		_validateForm: function( form ) {
			var self = this;
			var fields = self.requiredFields;
			var $visibleSet = form.find( "fieldset:visible" );
			var valid = true;
			
			form.find( ".message" ).remove();
			
		  $visibleSet.each(function() {
			
			$( this ).find( ":input" ).each(function() {
				var $input = $( this );
				var type = $input.data( "type" );
				var msg = $input.data( "message" );
				
				if( type == "string" ) {
					if( $input.val() == fields.str.value ) {
						$( "<span class='message'/>" ).text( msg ).
						insertBefore( $input );
						
						valid = false;
					}
				} else {
					if( !fields.expression.value.test( $input.val() ) ) {
						$( "<span class='message'/>" ).text( msg ).
						insertBefore( $input );
						
						valid = false;
					}
				}
				
			});
		  });
			
			return valid;
		
		},
		
		/* Save the data entered by the user in the ckeckout form
		 * @param form Object the jQuery element of the checkout form
		 * @returns void
		 */
		_saveFormData: function( form ) {
			var self = this;
			var $visibleSet = form.find( "fieldset:visible" );
			
			$visibleSet.each(function() {
				var $set = $( this );
				if( $set.is( "#fieldset-billing" ) ) {
					var name = $( "#name", $set ).val();
					var email = $( "#email", $set ).val();
					var city = $( "#city", $set ).val();
					var address = $( "#address", $set ).val();
					var zip = $( "#zip", $set ).val();
					var country = $( "#country", $set ).val();
					
					self.storage.setItem( "billing-name", name );
					self.storage.setItem( "billing-email", email );
					self.storage.setItem( "billing-city", city );
					self.storage.setItem( "billing-address", address );
					self.storage.setItem( "billing-zip", zip );
					self.storage.setItem( "billing-country", country );
				} else {
					var sName = $( "#sname", $set ).val();
					var sEmail = $( "#semail", $set ).val();
					var sCity = $( "#scity", $set ).val();
					var sAddress = $( "#saddress", $set ).val();
					var sZip = $( "#szip", $set ).val();
					var sCountry = $( "#scountry", $set ).val();
					
					self.storage.setItem( "shipping-name", sName );
					self.storage.setItem( "shipping-email", sEmail );
					self.storage.setItem( "shipping-city", sCity );
					self.storage.setItem( "shipping-address", sAddress );
					self.storage.setItem( "shipping-zip", sZip );
					self.storage.setItem( "shipping-country", sCountry );
				
				}
			});
		}
	};
	
	$(function() {
		var shop = new $.Shop( "#site" );
	});

})( jQuery );