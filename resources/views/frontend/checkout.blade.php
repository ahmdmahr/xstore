@extends('layouts.front')

@section('title')
Checkout
@endsection

@section('content')
<div class="container mt-5">
    <form action="{{ route('place-order') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <input type="text" class="form-control fname" value="{{ Auth::user()->fname }}" name="fname" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control lname" value="{{ Auth::user()->lname }}" name="lname" placeholder="Enter Last Name">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control email" value="{{ Auth::user()->email }}" name="email" placeholder="Enter Email">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Phone Number</label>
                                <input type="text" class="form-control phone" value="{{ Auth::user()->phone }}" name="phone" placeholder="Enter Phone Number">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Address 1</label>
                                <input type="text" class="form-control address1" value="{{ Auth::user()->address1 }}" name="address1" placeholder="Enter Address 1">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Address 2</label>
                                <input type="text" class="form-control address2" value="{{ Auth::user()->address2 }}" name="address2" placeholder="Enter Address 2">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">City</label>
                                <input type="text" class="form-control city" value="{{ Auth::user()->city }}" name="city" placeholder="Enter City">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">State</label>
                                <input type="text" class="form-control state" value="{{ Auth::user()->state }}" name="state" placeholder="Enter State">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Country</label>
                                <input type="text" class="form-control country" value="{{ Auth::user()->country }}" name="country" placeholder="Enter Country">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Pin Code</label>
                                <input type="text" class="form-control pin_code" value="{{ Auth::user()->pin_code }}" name="pin_code" placeholder="Enter Pin Code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    @if($cartItems->count() > 0)
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                   @php
                                   $total = 0;
                                   @endphp

                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>{{ $item->products->selling_price }}</td>
                                        </tr>

                                        @php
                                        $total += $item->products->selling_price * $item->prod_qty;
                                        @endphp

                                    @endforeach
                                </tbody>
                            </table>
                            <h6 class="px-2">
                                Grand Total <span class="float-end">{{ $total }}$</span>
                            </h6>
                            <hr>
                            <input type="hidden" name="payment_mode" value="COD">

                            <button type="submit" class="btn btn-success w-100 mb-2">Place Order | COD</button>

                            <div id="paypal-button-container"></div>
                        </div>
                    @else
                        <div class="card-body text-center">
                            <h2>No products in cart</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')

 
<script src="https://www.paypal.com/sdk/js?client-id=Ab9qmOQskZhomiy_KOZ8KK1ba9tplrVVOo5Xy_RO906a4dxpgZsyFOuZxGspt-eVsoVgRUE0t6bOq2lt"></script>

<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: {{ $total }} // Replace with the total price dynamically
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            // Show a success message to the buyer
            // alert('Transaction completed by ' + details.payer.name.given_name);
            // You can also send the transaction details to your server here

            var fname = $('.fname').val();
            var lname = $('.lname').val();
            var email = $('.email').val();
            var phone = $('.phone').val();
            var address1 = $('.address1').val();
            var address2 = $('.address2').val();
            var city = $('.city').val();
            var state = $('.state').val();
            var country = $('.country').val();
            var pin_code = $('.pin_code').val();
            
            $.ajax({
                method: "POST",
                url: 'place-order',
                data: {
                    'fname': fname,
                    'lname': lname,
                    'email': email,
                    'phone': phone,
                    'address1': address1,
                   'address2': address2,
                    'city': city,
                   'state': state,
                   'country': country,
                   'pin_code': pin_code,
                   'payment_mode': 'Paid by Paypal',
                   'payment_id': details.id,
                   '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    swal('response.status');
                    window.location.href = "my-orders";
                }
            });
        });
    }
}).render('#paypal-button-container'); // Display the button in the container
</script>

@endsection