<style>
    body {
        background-color: #d7d6d3;
        font-family: 'verdana';
    }

    

    .id-card {
        background-image: url("/img/prbi_card/premium.png");
        background-repeat: no-repeat;
        background-size: 1100px 660px;
        padding: 1px;
        border-radius: 10px;
        height: 2245px;
    }

    .photo img {
        position: relative;
        top: 75px;
        left: 78px;
        width: 285px;
        border-width: 2px;
        border-radius: 50%;
        
    }

    .text {
        
        position: relative;
        font-size: 23px;
        top: -193px;
        left: 510px;
        color: white;
    }

    .mobile {
        
        position: relative;
        font-size: 23px;
        top: -177px;
        left: 525px;
        color: white;
    }

    .emcontact {
        position: relative;
        font-size: 23px;
        top: -185px;
        left: 645px;
        color: white;
    }

    .prbi {
        position: relative;
        top: 47px;
        left:270px;
        font-size: 23px;
        color: white;
    }

    

    

    h2 {
        font-size: 15px;
        margin: 5px 0;
    }

    h3 {
        font-size: 12px;
        margin: 2.5px 0;
        font-weight: 300;
    }

    .qr-code img {
        position: relative;
        width: 135px;    
        left: 884px;   
        top: 51px; 
    }

    p {
        font-size: 5px;
        margin: 2px;
    }
</style>


<body>

    <div class="id-card-holder">
        <div class="id-card">
            <div class="qr-code">
                
                    <img src="{{ url("/img/qrcode/". Auth::guard('user')->user()->qrcode) }}">

            </div>
            <div class="photo">
                    <img src="{{ url("/img/userdp/". Auth::guard('user')->user()->profile_image) }}">
            </div>
            <div class="text">
                {{Auth::guard('user')->user()->first_name}} {{Auth::guard('user')->user()->last_name}}
            </div>
            <div class="mobile">
                {{Auth::guard('user')->user()->contact}}
            </div>
            
            <div class="prbi">
                {{Auth::guard('user')->user()->prbi_id}}
            </div>
            <div class="emcontact">
                {{Auth::guard('user')->user()->emergency_contact}}
            </div>
            <div class="emcontact">
                {{Auth::guard('user')->user()->address}}
            </div>
            <div class="emcontact">
                {{Auth::guard('user')->user()->blood_type}}
            </div>
            

        </div>

    </div>

</body>