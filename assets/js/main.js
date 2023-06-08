var regexNameLastName = /^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}){0,2}$/;
var regEmail = /^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-|_)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i;
var regPassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/;
var regexAdress = /^[A-z\dŠĐŽĆČšđžćč\.]+(\s[A-z\dŠĐŽĆČšđžćč\.]+)+,(\s?([A-ZŠĐŽĆČ][a-zšđžćč]+)+)+$/;
var regexCardNumber = /^[0-9]{16}$/;
var regexCardExpiresDate = /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;
var dataOrder = true;
window.onload=function (){
    $("#buttonSearchProducts").click(function (){
        let insertedValue = $("#searchProducts").val();
        $.ajax({
           method:"get",
           url:"models/product/searchProducts.php",
           dataType:"json",
           data:{
               insertedValue:insertedValue
           },
            success:function (data){
               printProducts(data);
               printPagination(data);
            },
            error:function (msg){
               console.log(msg);
            }
        });
    });

    $("#reload").click(function (){
       location.reload();
    });

    $(".page-link").click(function (event){
        event.preventDefault();
        let insertedValue = $(this).data("number");
        $.ajax({
            method:"get",
            url:"models/product/searchProducts.php",
            dataType:"json",
            data:{
                startIndexNumber:insertedValue
            },
            success:function (data){
                printProducts(data);
            },
            error:function (msg){
                console.log(msg);
            }
        });
    });
    $("#orderBtn").click(function (){
        dataOrder=true;
        $(".errorMsg").remove();
        let adress=$("#adress").val();
        let cardNumber=$("#cardNumber").val();
        let expires=$("#expires").val();
        let cvvNumber=$("#typeCvv").val();

        checkRegex(adress,"adress",regexAdress,"Morate uneti postojecu adresu");
        checkRegex(cardNumber,"cardNumber",regexCardNumber,"Morate uneti broj u traženom formatu");
        checkRegex(expires,"expires",regexCardExpiresDate,"Morate uneti broj u datom formatu");

        if(cvvNumber==""){
            dataOrder=false;
            $("<p class='text-center mt-3 errorMsg'>Polje ne sme biti prazno</p>").insertAfter("#typeCvv");
            $("#typeCvv").css({'border':'1px solid #e60000'});
        }
        else{
            $("#typeCvv").css({'border':'1px solid #00e600'});
        }

        if(dataOrder){
            $.ajax({
                method:"post",
                url:"models/cart/addOrder.php",
                dataType:"json",
                data:{
                    adress:adress,
                    cardNumber:cardNumber,
                    expires:expires,
                    cvvNumber:cvvNumber

                },
                success:function (data){
                    let print = `<p class='alert alert-success  col-9 mt-3 mx-auto'>${data['msg']}</p>`
                    document.getElementById("messageCart").innerHTML=print;
                },
                error:function (msg){
                    console.log(msg);
                }
            });
        }

    });
}
var dataRegisterValid = true;
var dataLoginValid = true;
var dataSendMsgValid = true;

function validateRegisterData(){
    dataRegisterValid = true;
    $("#succMsg").remove();
    $(".errorMsg").remove();
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let repeatPass = document.getElementById("repeatPass").value;

    checkRegex(name,"name",regexNameLastName,"Ime ne sme biti prazno i mora početi velikim slovom");
    checkRegex(email,"email",regEmail,"Email ne sme biti prazno i mora biti u formi email adrese");
    checkRegex(password,"password",regPassword,"Šifra mora sadržati bar jednu cifru,jedno malo slovo i jedno veliko slovo.Mora biti duža od 8 a karaća od 32 karaktera");

    if(repeatPass!=password){
        dataRegisterValid=false;
        $("#repeatPass").attr("placeholder", "Lozinke se ne podudaraju");
        $("#repeatPass").css({'border':'1px solid #e60000'});
    }
    else{
        $("#repeatPass").css({'border':'1px solid #00e600'});
    }

    if(dataRegisterValid){
        return true;
}
    else{
        return false;
    }
}

function validateLoginData(){
    dataLoginValid = true;
    $(".errorMsg").remove();

    let email = document.getElementById("emailLogin").value;
    let password = document.getElementById("passwordLogin").value;

    checkRegex(email,"emailLogin",regEmail,"Email ne sme biti prazno i mora biti u formi email adrese");
    checkRegex(password,"passwordLogin",regPassword,"Šifra mora sadržati bar jednu cifru,jedno malo slovo i jedno veliko slovo.Mora biti duža od 8 a karaća od 32 karaktera");

    if(dataLoginValid){
        return true;
    }
    else{
        return false;
    }
}

function validateSendMsgData(){
    dataSendMsgValid = true;
    $(".errorMsg").remove();

    let nameLastName = document.getElementById("nameLastName").value;
    let email = document.getElementById("emailSendMsg").value;
    let message = document.getElementById("message").value;

    checkRegex(nameLastName,"nameLastName",regexNameLastName,"Ime ne sme biti prazno i mora početi velikim slovom");
    checkRegex(email,"emailSendMsg",regEmail,"Email ne sme biti prazno i mora biti u formi email adrese");

    if(message=="" || message.length<15){
        dataSendMsgValid=false;
        $("#message").attr("placeholder", "Poruka ne sme biti prazno i mora sadržati više od 15 karaktera");
        $("#message").css({'border':'1px solid #e60000'});
    }
    else{
        $("#message").css({'border':'1px solid #00e600'});
    }

    if(dataSendMsgValid){
        return true;
    }
    else{
        return false;
    }
}


function checkRegex(field,id,regex,errorMsg){
    if(!(field!="" && regex.test(field))){
        dataRegisterValid=false;
        dataLoginValid = false;
        dataOrder = false;
        $("<p class='text-center mt-3 errorMsg'>"+errorMsg+"</p>").insertAfter("#"+id);
        $("#"+id).css({'border':'1px solid #e60000'});
    }
    else{
        $("#"+id).css({'border':'1px solid #00e600'});
    }
}

function printProducts(products){
    let print="";
    let numberOfProducts = products["products"].length;
    if(numberOfProducts) {
        for (let product of products["products"]) {
            print += ` <div class="col-3 mb-5">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                ${checkOnSale(product.onSale)}
                                <!-- Product image-->
                                <img class="card-img-top" src="assets/img/${product.src}" alt="$product.alt" />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">${product.title}</h5>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">${product.price} DIN</span>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="models/cart/addToCart.php?id=${product.id}">Dodaj u korpu</a></div>
                                </div>
                            </div>
                        </div>`
        }
    }
    else{
         print+=`<div class="col-3 mb-5">
                            <h1>Nema proizvoda sa datim imenom</h1>
                        </div>`
    }
    document.getElementById("productsMenu").innerHTML=print;

}

function checkOnSale(onSale){
    let print;
    if(onSale){
        print=`<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>`;
    }
    else {
        print="";
    }
    return print;
}

function printPagination(products){
    let pagination = "";
    let numberOfProducts = products["products"].length;
    let offsetNumber = 8;
    let numberOfPages = Math.ceil(numberOfProducts/offsetNumber);
    for(let i=0;i<numberOfPages;i++){
        pagination+=`<li class="page-item" ><a class="page-link" data-number="${i}" href="#">${i+1}</a></li>`
    }
    document.getElementById("paginationUl").innerHTML=pagination;
}

