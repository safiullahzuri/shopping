@extends('layouts.master')

@section('content')

        <div class="row">

            <div class="col-md-10">
                <h3>لطفا محصولات خریداری شده را وارد نمایید. </h3>

                <div  class="alert">
                    <div id="productsForm">
                        <input type="text" id="productBarcodeField" class="form-control " />
                        <input id="productNumber" type="number" class="form-control " value="1" />
                    </div>
                    <button type="submit" class="form-control" id="checkOutBtn">Check out</button>
                    <div id="calculationTable">

                        <table class="table table-striped" >
                            <thead>
                            <tr>
                                <th>اسم محصول</th>
                                <th>قیمت جنس</th>
                                <th>تعداد فروش</th>
                                <th>مجموع</th>
                                <th colspan="2">عمل</th>
                            </tr>
                            </thead>
                            <tbody id="saleRows">

                            </tbody>
                            <tr>
                                <td colspan="3">قیمت مجموعی</td>
                                <td id="totalSum"></td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    <script>

        /*
        next tasks to do:
            1- update total price on product number change
            2- get the .inEdit button to work
            3- find the entire total
         */

        /*
        next steps
            1- do not allow two buttons to be in edit mode at the same time
            2-


         */

        $(document).ready(function () {

            var product = 1;

            $(document).on('keypress','#productBarcodeField, #productNumber', function (event) {
                if (event.keyCode == 13){
                    var productCode = $("#productBarcodeField").val();
                    var productNumber = $("#productNumber").val();
                    addProductToTable(productCode, productNumber)
                }
            });

            $(document).on('click', '.deleteRow', function (event) {
                var id = $(this).attr("id");
                $("#saleRows").find($(this).parent().parent()).remove();
                findCompleteTotalValue();
            });

            //make these variables public for easier access of all functions
            var changingCell;
            var newCell;

            var lastProductNumber;

            //the total cell representing the total price for one product
            var cellTotal;
            var productPrice;

            var isProductNumberEditing = false;


            $(document).on('click', '.editRow', function (event) {
                    event.preventDefault();



                    isProductNumberEditing = true;

                    var thisButton = $(this);
                    changingCell = $(this).parent().parent().find(".pNumber");
                    var previousProductNumber = changingCell.text();


                    changingCell.html('<input type="number" id="inEditInput" class="form-control" value="'+previousProductNumber+'" />');

                    cellTotal = $(this).parent().prev();

                    productPrice = parseInt($(this).parent().prev().prev().prev().text());


                    newCell = $(this).parent().parent().find(".form-control");
                    newCell.focus();
                    $(this).addClass("btn-primary inEdit").removeClass("btn-warning");
                    $(this).text("ثبت تغییر");

                    newCell.on('input', function () {
                        var input = this.value;
                        lastProductNumber = input;
                    });

                    if (lastProductNumber === undefined){
                        lastProductNumber = parseInt(previousProductNumber);
                    }

                    newCell.on('keypress', function (event) {
                        if (event.keyCode == '13'){
                            var newProductNumber = $(this).val();
                            changingCell.html('<span>'+newProductNumber+'</span>');
                            thisButton.addClass("btn-warning").removeClass("btn-primary inEdit");
                            thisButton.text("تغییر تعداد");
                            updateCellTotal(cellTotal, productPrice, newProductNumber);
                            findCompleteTotalValue();
                        }
                    });

            });

            //update the product number field on button click
            $(document).on('click', '.inEdit', function (event) {
               event.preventDefault();
                changingCell.html('<span>'+lastProductNumber+'</span>');
                $(this).addClass("btn-warning").removeClass("btn-primary inEdit");
                $(this).text("تغییر تعداد");


                updateCellTotal(cellTotal, productPrice, lastProductNumber);
                findCompleteTotalValue();
            });


            function calculateNewTotal(productPrice, productNumber){
                return productPrice * productNumber;
            }
            function updateCellTotal(cell, productPrice, productNumber) {
                $(cell).text(calculateNewTotal(productPrice, productNumber));
            }

            function findCompleteTotalValue(){
                var sum = 0;
                $("#saleRows").find("tr").each(function (index, element) {
                   var tdS = $(this).find("td.totalPrice");
                   for (var i=0; i<tdS.length; i++){
                       sum += parseInt(tdS.eq(i).text());
                    }
                });
                $("#totalSum").text(sum);
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
                        html += '<td class="pNumber">'+productNumber+'</td>';
                        var total = productNumber * response.price_to_be_sold;
                        html += '<td class="totalPrice" data-price="'+total+'">'+total+'</td>';


                        html += '<td><a class="btn btn-warning editRow" id="'+product+'">تغییر تعداد</a></td/> ';
                        html += '<td><a class="btn btn-danger deleteRow" id="'+product+'" >حذف</a></td>';

                        $("#saleRows").append(html);
                        $("#productBarcodeField").val('');
                        product++;
                        findCompleteTotalValue();

                    },
                    error: function (a, b, c) {
                        // do something because this product is not stored in the database
                        alert("error here");
                    }
                });

            }


        });

    </script>




@endsection