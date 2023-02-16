@extends('admin_dashboard')
@section('admin')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
<style>
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.tab-card{
    cursor: pointer;
    position: relative;
    height: 100px;
    width: 100px;
    transition: all 0.4s ease-in-out 0s;
}
.tab-card:hover img{
    opacity: 0.2;
}
.tab-card .card-body  .card-title{
    color: white
}
.tab-card .card-body{

    position: absolute;
    text-align: center;
    top: 10%;
    left: 10%;
    opacity: 0;

}

.tab-card:hover .card-body{
    opacity: 1;
}
</style>
<link rel="stylesheet" href="{{asset("backend/assets/js/Jquery-ui/jquery-ui.css")}}">
    <script src="{{asset("backend/assets/js/Jquery-ui/jquery.js")}}"></script>
    <script src="{{asset("backend/assets/js/Jquery-ui/jquery-ui.js")}}"></script>
    <!-- Start Content-->
    <div class="container-fluid">
        <form  id="payment">
            @csrf
            <div class="row">

                <div class="col-8">
                    <div class="d-flex">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Select+
                        </button>
                        <div class="input-group ">
                            <input type="text" class="form-control"  onkeypress="if (event.keyCode == 13) {return false;}"placeholder="Search.." id="search"
                                aria-label="Search.." aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <table class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th class="sl">SL</th>
                                <th class="sku">Item SKU</th>
                                <th class="item">Product Name</th>
                                <th class="price">Price</th>
                                <th class="price">Discount</th>
                                <th class="quantity">Quantity</th>
                                <th class="action">Action</th>
                                <th class="total">Total</th>
                            </tr>
                        </thead>


                        <tbody id="cartTable">

                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <div class="card p-2">

                        <form action="">
                            <div class="row mb-3">
                                <label for="date" class="col-md-4 col-form-label">Date & Time</label>
                                <div class="col-md-8">
                                    <input type="disable" class="form-control " disabled value="{{ date('h:i') }} - {{ date('Y/m/d') }}" id="date">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Bill No</label>
                                <div class="col-md-8">
                                    <input type="text" readonly value="{{str_pad($sell->invoice_no+1, 7, 0, STR_PAD_LEFT) ?? null }}" name="invoice_no" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Bill Type</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="bill_type" id="">
                                        <option value="Sales">Sales</option>
                                        <option value="Return">Return</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Customer</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <a class="btn btn-primary input-group-text" data-bs-toggle="modal" data-bs-target="#userModal"><i class="fa fa-user-plus"></i></a>
                                        <input type="text" value="walking customers" class="form-control" id="final-customer" readonly>
                                        <input type="hidden"  class="form-control" name="customer_id" id="customer_id">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhone" class="col-md-4 col-form-label">Customer's Phone</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" value="0170000000" id="inputPhone" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Counter</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-md-4 col-form-label">Cashier</label>
                                <div class="col-md-8">
                                    <input type="text" value="{{auth()->user()->name}}" readonly class="form-control" id="inputEmail3">
                                </div>

                            </div>
                            <hr>
                            <div>

                            </div>

                            <div class=" bg-slate-600">
                                <div class="sub-total d-flex justify-content-between">
                                    <div>
                                        <p>Sub Total</p>
                                    </div>
                                    <div class="">
                                        <p id="subTotal">0.00</p>
                                    </div>
                                </div>
                                <div class="tax-total d-flex justify-content-between">
                                    <div class="">
                                        <p>(15%) Tax Total</p>
                                    </div>
                                    <div class="">
                                        <p id="tax_total">0.00</p>
                                    </div>
                                </div>
                                <div class="discount d-flex justify-content-between">
                                    <div class="">
                                        <p>Discount</p>
                                    </div>
                                    <div class="">
                                        <p id="discount_amount">0.00</p>
                                        <input type="hidden" name="discount_amount" id="discount_amount" />
                                    </div>
                                </div>
                                <div class="total d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <p>Total</p>
                                    </div>
                                    <div class="">
                                        <p class="big" id="final_amount">0.00</p>
                                        <input type="hidden" id="final_amount" name="final_amount" />
                                    </div>
                                </div>
                            </div>

                            <div class="btn-group text-center">
                                <button class="btn btn-primary shadow make_payment" type="submit"
                                    name="submit">
                                    Make Payment
                                </button>
                                <button  class="btn btn-secondary shadow" type="button" name="hold">
                                    Hold
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- container -->

    </div> <!-- content -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Select a product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">All Categories</a>
                          <ul class="dropdown-menu">
                            @foreach ($categories as  $cat)
                            <li><a class="dropdown-item" href="#">{{$cat->category_name}}</a></li>
                            @endforeach
                          </ul>
                        </li>
                      </ul>
                      <div class="row">

                          @foreach ($products as $item)

                          <div class="card tab-card col-md-3" id="{{$item->id}}" >
                            <img src="{{asset($item->product_image)}}" class="card-img-top" alt="">
                            <div class="card-body">
                              <h5 class="card-title">{{$item->product_name}}</h5>

                            </div>
                          </div>
                          @endforeach
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Select a product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

  <ul class="nav nav-pills">
    <li class="active btn btn-primary"><a data-bs-toggle="tab" href="#new-customer">Create a Customer</a></li>
    <li class="btn btn-primary"><a data-bs-toggle="tab"  href="#menu1">Customer List</a></li>
  </ul>

  <div class="tab-content">
    <div id="new-customer" class="tab-pane fade in active">
      <h3>Create a customer</h3>
      <form action="" method="post" class="text-center">

        <div class="row mb-3">
            <label for="inputEmail3" class="col-md-4 col-form-label">Customer Name</label>
            <div class="col-md-8">
                    <input type="text" name="name" class="form-control" id="inputEmail3">
            </div>
            </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-md-4 col-form-label">Customer Phone</label>
            <div class="col-md-8">
            <input type="text" name="phone" class="form-control" id="inputEmail3">
            </div>
            </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-md-4 col-form-label">Customer Address</label>
            <div class="col-md-8">
            <textarea name="address" class="form-control" id="" cols="30" rows="3"></textarea>
            </div>
            </div>
            <button class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Customer List</h3>
      <div class="input-group">
          <input type="text" id="customer-search" placeholder="Search customer" class="form-control" id="inputEmail3">
          <a class="btn btn-primary input-group-text"><i class="fa fa-search"></i></a>
    </div>
      <div class="list-group" id="customerList">
        @foreach ($customers as $item)
        <li class="list-group-item" id="selectCustomer" style="cursor: pointer" data-name="{{$item->name}}" data-phone="{{$item->phone}}"  data-id="{{$item->id}}"> {{$item->name}}</li>
        @endforeach
      </div>

    </div>
  </div>
                </div>
            </div>
        </div>
    </div>

    <script>
          function play_sound() {
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', '{{asset('backend/assets/sound/beep-sound.mp3')}}');
    audioElement.setAttribute('autoplay', 'autoplay');
    audioElement.load();
    audioElement.play();
  }
        $(document).on("submit", "form#payment", function(e){
            e.preventDefault();
            $.ajax({
                url:'{{url("/payment-store")}}',
                type: "post",
                data: $(this).serialize(),
                success: function(res){
                    toastr.success("Order Successfull");
                    window.location.reload();
                }
            })
        })
        $(document).ready(function(){

            $("#customer-search").on("keyup", function() {
                let value = $(this).val().toLowerCase();

            $.ajax({
                url: "{{ url('/customer-search') }}",
                type: "GET",
                data: {search: value},
                success: function(res){
                    $("#customerList").html(` <li class="list-group-item" id="selectCustomer" style="cursor: pointer" data-name="${res.data.name}" data-phone="${res.data.phone}" data-id="${res.data.id}"> ${res.data.name}</li>`)

                }
            })
        });

        $(document).on("click", ".tab-card", function(){
             let id =$(this).attr("id")
            $.ajax({
                url: `{{url('/product/${id}')}}`,
                type: "get",
                success: function(res){

                    cart(res.data);
                    toastr.success("Product added successfully");
                }

            });
        });
        });
        $(document).on("click", "#selectCustomer", function(){
let name = $(this).data("name");
let phone = $(this).data("phone");
let customer_id = $(this).data("id");
console.log(customer_id)
$("#final-customer").val(name);
$("input#customer_id").val(customer_id);
$("#inputPhone").val(phone)

toastr.success(name+" added successfully");
})


        $("#search").autocomplete({
            selectFirst: true, //here
            minLength: 2,

            source: function(request, response) {

                $.ajax({
                    url: "{{ url('/pos-search') }}",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        if (data.length == 0 || data.data == null) {
                            toastr.error("Product not found");

                        } else {
                            response($.map(data, function(item) {
                                cart(item);
                                toastr.success("Product added successfully");
                                return {
                                    label: item.product_name,
                                    // value: item.id
                                };
                            }));
                        }
                    },

                })
            },
            select: function(event, ui) {
                console.log(event);
                console.log(ui);

            }
        });


        $(document).on("click", ".btn-delete", function(){

$(this).parents("tr").remove();
cartCalculate();

});
$("body").on('click','.qtybtn', function(){

            var oldValue = $(this).parent().find('input.quantity').val();
            let type =$(this).data("type");
            if (type == "plus") {
                $(this).parent().find('input.quantity').val(parseFloat(oldValue)+1)
            } else {
                if (oldValue > 1) {
                    $(this).parent().find('input.quantity').val(parseFloat(oldValue)-1)
                }else{

                    $(this).parent().find('input.quantity').val(1)
                }
            }

            cartCalculate();

});

function cartCalculate(){
    var tRow =$('#cartTable tr');

    let sub_total=0;
    let sub_total_discount=0;
    let rec_product_row='';
    let tax_amount=0;
    tRow.each(function(index){
        var tblrow = $(this);
        let qty=Number(tblrow.find('td input.quantity').val());
        let amount=Number(tblrow.find('td input.unit_price').val());
        let discount=Number(tblrow.find('td input.unit_discount').val());
        let row_total=qty * amount;
        let row_discount=(qty *discount);
        row_total -=row_discount;
        tblrow.find('td.row_total').text(row_total.toFixed(2));
        sub_total+=row_total;
        sub_total_discount+=row_discount;


    });
    var final_total = sub_total - sub_total_discount;
    $("#subTotal").text(sub_total.toFixed(2));
    $("#discount_amount").text(sub_total_discount.toFixed(2));
    $("#discount_amount").val(sub_total_discount.toFixed(2));
    $("p#final_amount").text(final_total.toFixed(2));
    $("input#final_amount").val(final_total.toFixed(2));
}
cartCalculate();

function cart(item) {
    $('tbody#cartTable').append(

`
<tr id=" ${item.id}">

<td>
${item.id}
</td>

<td>
${item.product_code}
</td>

<td>
${item.product_name}
</td>

<td>
<input class="form-control unit_price" name="unit_price[]" type="number" value="${item.selling_price}" style="text-align: center;line-height: 1;border: none;background: transparent;" required/>
</td>

<td>
<input class="form-control form-control-sm unit_discount" name="discount[]" type="number" value="0" style="text-align: center;line-height: 1;border: none;background: transparent;" required/>
<input type="hidden" name="product_id[]"  type="number" value="${item.id}"/>
</td>

<td>
<div class="d-flex">
<a class="btn btn-primary btn-sm qtybtn" data-type="minus">
<i class="fas fa-minus"></i>
</a>

<input id="form1" min="1" data-qty="${item.id}" name="quantity[]" size="50" value="1" type="number"
class="form-control form-control-sm quantity" />

<a class="btn btn-primary btn-sm qtybtn"
data-type="plus">
<i class="fas fa-plus"></i>
</a>
</div>

</td>

<td>
<a class="btn-delete btn btn-sm btn-danger" > <i class="fa fa-trash"></i></a>
</td>

<td class="row_total">
${item.selling_price}
</td>

</tr>
`);
play_sound();
cartCalculate();
}

    </script>
@endsection
