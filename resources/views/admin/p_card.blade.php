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
        top: -200px;
        left: 510px;
        color: white;
    }

    .mobile {

        position: relative;
        font-size: 23px;
        top: -184px;
        left: 525px;
        color: white;
    }

    .emcontact {
        position: relative;
        font-size: 23px;
        top: -220px;
        left: 645px;
        color: white;
    }

    .address {
        position: relative;
        font-size: 23px;
        top: -203px;
        left: 560px;
        color: white;
    }

    .blood {
        position: relative;
        font-size: 23px;
        top: -72px;
        left: 580px;
        color: white;
    }

    .prbi {
        position: relative;
        top: 13px;
        left: 270px;
        font-size: 23px;
        color: white;
    }

    .qr-code img {
        position: relative;
        width: 130px;
        left: 900px;
        top: 35px;
    }

</style>



<div class="id-card">
    <div class="qr-code">

        <img src="{{ url("/img/qrcode/". $member->qrcode) }}">

    </div>
    <div class="photo">

            <img src="{{ url("/img/userdp/". $member->profile_image) }}">
    </div>
    <div class="text">
        {{$member->first_name}} {{$member->last_name}}
    </div>
    <div class="mobile">
        {{$member->contact}}
    </div>
    <div class="blood">
        {{$member->blood_type}}
    </div>
    <div class="prbi">
        {{$member->prbi_id}}
    </div>
    <div class="emcontact">
        {{$member->emergency_contact}}
    </div>
    <div class="address">
        {{$member->address}}
    </div>

</div>