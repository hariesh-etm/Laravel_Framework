<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
    <style>
        .test {
        font-family: DejaVu Sans, serif;
        font-size: 12px;
    }
    </style>
</head>
<body>
   
   
    <div style="display: block;width: 500px;">
   <div style="display: flex; border: 1px solid; width: 700px;">
    <table>
        <tr>
        <td><p>Total in Words</p></td>
        <td><p class="test">المجموع في الكلمات</p></td>
        <td><p>Five Thousand Four Hundred U.A.E Dirhams Only</p></td>
        </tr>
    </table>
   </div> 
   <div style="display: flex; justify-content: space-between; align-items: end; margin: 0 auto; border: 1px solid; width: 700px; margin-top: 20px;">
    <div style="display: flex; justify-content: space-between;">
        <ul style="list-style: none; padding-left: 17px;">
        <li>Less Advance/Gift Voucher</li>
        <li>Less Gold Purchase</li>
        <li>Less Credit Card</li>
        <li>Net Cash</li>
        <li>Total Receipt</li>
    </ul>
    <ul style="list-style: none;">
        <li class="test">سلفة أقل / قسيمة هدايا</li>
        <li style="color:transparent;">1</li>
        <li class="test">بطاقة ائتمان أقل</li>
        <li class="test">صافي النقد</li>
        <li class="test">إجمالي الإيصال</li>
    </ul>
    </div>
    <div>
        <ul style="list-style: none; padding-right: 17px;">
            <li></li>
            <li></li>
            <li>{{$price}}</li>
            <li>0.00</li>
            <li>{{$price}}</li>
        </ul>
    </div>
   </div>
   <div style="display: flex; justify-content: space-between; margin: 0 auto; border: 2px solid; width: 700px; margin-top: 20px;">
    <div style="margin-left: 20px;">
        <p class="test" style="margin-bottom: 0;">ملاحظات</p>
        <p style="margin-top: 0;">Remarks :</p>
    </div>
    <div>
        <p class="test" style="margin-bottom: 0;">طريقة الدفع</p>
        <p style="margin-top: 0;">Mode of Payment :</p>
    </div>
    <div style="margin-right: 200px; margin-top: 10px;">
        NBVISA:5400.00
    </div>
   </div>
   <div style="display: flex; justify-content: space-between; margin: 0 auto; width: 700px; margin-top: 20px;">
    <div>
        <div style="display: flex; align-items: baseline;">
            <i class="fa-brands fa-facebook-f" style="border: 1px solid; border-radius: 33px; font-size: 16px; margin-right: 10px; padding: 5px 7px;"></i>
            <p style="margin-top: 0;">jawharajewellery</p>
        </div>
        <div style="display: flex; align-items: baseline;">
            <i class="fa-brands fa-instagram" style="border: 1px solid; border-radius: 33px; font-size: 16px; margin-right: 10px; padding: 5px 7px;"></i>
            <p style="margin-top: 0;">jawharajewellery</p>
        </div>
    </div>
    <div style="text-align: center;">
         Corporate Office, Jawhara building, Al Daghaya area, p.o.Box : 652, Dubai - U.A.E <br>Office No: +971 4 506 2000 | Fax: +971 4 506 2OO3
    </div>
    <div>
        <div style="display: flex; align-items: baseline;">
            <i class="fa-solid fa-cart-shopping" style="font-size: 16px; margin-right: 10px;"></i>
            <p style="margin-top: 0;">{{$email}}</p>
        </div>
        <div style="display: flex; align-items: baseline;">
            <i class="fa-solid fa-globe" style="font-size: 16px; margin-right: 10px;"></i>
            <p style="margin-top: 0;">{{$email}}</p>
        </div>
    </div>
   </div>
</div>
</body>
</html>