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
</style>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="d-flex">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Select+
                    </button>
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Search.." id="search"
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
                            <label for="date" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="disable" class="form-control " disabled value="{{ date('h:i') }} - {{ date('Y/m/d') }}" id="date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-md-4 col-form-label">Date</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="inputEmail3">
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
                                    <p id="sub_total">0.00</p>
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
                                    <p id="discount">0.00</p>
                                    <input type="hidden" name="discount_amount" id="discount_amount" />
                                </div>
                            </div>
                            <div class="total d-flex justify-content-between align-items-center">
                                <div class="">
                                    <p>Total</p>
                                </div>
                                <div class="">
                                    <p class="big" id="final_total">0.00</p>
                                    <input type="hidden" id="final_total" name="final_amount" />
                                </div>
                            </div>
                        </div>

                        <div class="btn-group text-center">
                            <button type="button" class="btn btn-primary shadow make_payment" type="button"
                                name="button">
                                Make Payment
                            </button>
                            <button onclick="" class="btn btn-secondary shadow" type="submit" name="hold">
                                Hold
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- container -->

    </div> <!-- content -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // $(document).ready(function(){
        //     $("#Search").on("keyup", function() {
        //         let value = $(this).val().toLowerCase();
        //     console.log(value);

        //     $.ajax({
        //         url: "{{ url('/pos-search') }}",
        //         type: "GET",
        //         data: {search: value},
        //         success: function(res){
        //             console.log(res);

        //         }
        //     })
        // });

        // $( "#Search" ).autocomplete({
        //     selectFirst: true, //here
        //     minLength: 2,

        //     source: function( request, response ) {
        //         let value = $(this).val();
        //         console.log(value);
        //         $.ajax({
        //         url: "{{ url('/pos-search') }}",
        //         type: 'GET',
        //         dataType: "json",
        //         data: {search: value},
        //         success: function(res){
        //             console.log(res);
        //         }

        //         })
        //     }
        // });

        // $( function() {
        // "use strict";
        $("#search").autocomplete({
            selectFirst: true, //here
            minLength: 2,

            source: function(request, response) {
                // let value = $(this).val();
                // console.log(response);
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
                            // $("#cartTable").append(data)
                            response($.map(data, function(item) {
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
        <input type="hidden" name="variation_id[]"  type="number" value="${item.id}"/>
        <input type="hidden" name="product_id[]"  type="number" value="${item.id}"/>
    </td>

                <td>
                    <div class="d-flex">
                      <button class="btn btn-primary btn-sm qtybtn" data-type="minus">
                        <i class="fas fa-minus"></i>
                      </button>

                      <input id="form1" min="1" data-qty="${item.id}" name="quantity[]" size="50" value="1" type="number"
                        class="form-control form-control-sm quantity" />

                      <button class="btn btn-primary btn-sm qtybtn"
                      data-type="plus">
                        <i class="fas fa-plus"></i>
                      </button>
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

                cartCalculate();
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
        // });
        // });

        $(document).on("click", ".btn-delete", function(){

$(this).parents("tr").remove();

});
$("body").on('click','.qtybtn', function(){

            var oldValue = $(this).parent().find('input.quantity').val();
            let type =$(this).data("type");
            if (type == "plus") {
                $(this).parent().find('input.quantity').val(parseFloat(oldValue)+1)
            } else {
                if (oldValue > 1) {
                    $(this).parent().find('input.quantity').val(parseFloat(oldValue)-1)
                    // $('input[name=quantity]').val(parseFloat(oldValue)-1)
                }else{

                    $(this).parent().find('input.quantity').val(parseFloat(1))
                }
            }

            cartCalculate();

});

function cartCalculate(){
    var tRow =$('#cartTable tr');
    tRow.each(function(index){
        var tblrow = $(this);
        let qty=Number(tblrow.find('td input.quantity').val());
        let amount=Number(tblrow.find('td input.unit_price').val());
        let discount=Number(tblrow.find('td input.unit_discount').val());
        let row_total=qty * amount;
        let row_discount=(qty *discount);
        row_total -=row_discount;
        tblrow.find('td.row_total').text(row_total.toFixed(2));

    })
}
cartCalculate();

    </script>
@endsection
