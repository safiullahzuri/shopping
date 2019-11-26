@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-5">
                <h3>لطفا محصولات خریداری شده را وارد نمایید. </h3>

                <div  class="alert">
                    <div id="productsForm">
                        <input type="text" id="product1" class="form-control productBarcodeField" />
                        <input id="number1" type="number" class="form-control " value="1" />
                    </div>
                    <button type="submit" class="form-control" id="checkOutBtn">Check out</button>
                </div>
           </div>

            <div class="col-md-5">
                <h3>قبض فروش</h3>
                <div id="calculationTable">

                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>اسم محصول</th>
                                <th>قیمت جنس</th>
                                <th>تعداد فروش</th>
                                <th>مجموع</th>
                            </tr>
                        </thead>
                        <tbody id="saleRows">

                        </tbody>
                        <tr>
                            <td colspan="3">قیمت مجموعی</td>
                            <td id="totalPrice"></td>
                        </tr>

                    </table>

                </div>
            </div>


        </div>
    </div>

    <script>


        $(document).ready(function (event) {

            var product = 1;
            var totalCost;

            $(document).on('keypress','.productBarcodeField', function (event) {
                if (event.keyCode == 13){
                    addNewProductRow();
                    repaintSalesTable();
                }
            });

            function addNewProductRow() {
                product++;
                var html = '';
                html += '<div>';
                html += '<button type="button" class="deleteProduct">&times</button>';
                html += '<input type="text" class="form-control productBarcodeField" id="product'+product+'" />';
                html += '<input type="number" class="form-control" value="1" id="number'+product+'" />';
                html += '</div>';

                $("#productsForm").prepend(html);

                focusLastProduct();

            }

            $(document).on('click', '.deleteProduct', function () {
               $(this).parent().remove();
               repaintSalesTable();
            });

            function focusLastProduct() {
                $("#product"+product).focus();
            }

            function addProductToTable(productCode, productNumber) {

                // get the price first
                $.ajax({
                    type: 'GET',
                    data: {barcode: productCode},
                    url: '{{ route('sales.product') }}',
                    success: function (response) {

                        //response is the product retrieved in json format
                        var html = '';
                        html += '<tr>';
                        html += '<td>'+response.product_name+'</td>';
                        html += '<td>'+response.price_to_be_sold+'</td>';
                        html += '<td>'+productNumber+'</td>';

                        var total = productNumber * response.price_to_be_sold;
                        html += '<td class="totalPrice" data-price="'+total+'">'+total+'</td>';

                        $("#saleRows").append(html);

                    },
                    error: function (a, b, c) {
                        // do something because this product is not stored in the database
                    }
                });

            }



            function repaintSalesTable() {
                $("#saleRows").empty();
                for (var i=1; i<product; i++){
                    var productCode = $("#product"+i).val();
                    var productNumber = $("#number"+i).val();

                    //check if product code is not empty
                    if (productCode !== undefined){
                        if (productCode.length !== 0 ) {
                            addProductToTable(productCode, productNumber);
                        }
                    }
                }
                var sum = 0;
                $("#saleRows tr").each(function () {
                    sum += $(this).find(".totalPrice").html();
                });
                console.log(sum);

            }

        });
    </script>




@endsection