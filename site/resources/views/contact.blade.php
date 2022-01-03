@extends('layout.app')

@section('content')

<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="images/knowledge.svg">
                <h1 class="page-top-title mt-3">- যোগাযোগ -</h1>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">

		<div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.863226573514!2d90.38336021429696!3d23.752256294623802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8bd27f8c373%3A0x39df794e3533d47a!2sBRB%20Hospital%20Limited!5e0!3m2!1sen!2sbd!4v1640613168250!5m2!1sen!2sbd" width="500" height="280" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

		<div class="col-md-6">
                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input id="contact_nameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contact_mobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contact_emailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contact_msgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSaveBtnId" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
        </div>
	</div>
</div>

@endsection