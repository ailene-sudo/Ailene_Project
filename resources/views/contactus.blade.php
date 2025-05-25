@extends('layout')

@section('title', 'Contact Us')

@section('content')
    <div class="content">
        <!-- <h2>Contact Us</h2> -->
        <h2 class="text-center mb-3 fw-bold text-success">CONTACT US</h2>

        <p>If you have any questions or need assistance, please don't hesitate to reach out. We're here to help!</p>

        <h3>Contact Information:</h3>
        <!-- Corrected email link format -->
        <p><strong>Email:</strong> <a href="mailto:ailenelavarias14@gmail.com">ailenelavarias14@gmail.com</a></p>
        <p><strong>Phone:</strong> 09270491565</p>
        <p><strong>Address:</strong> San Carlos City, Pangasinan</p>

        <h3>Contact Form</h3>
        <p>If you'd prefer to send us a message directly, please use the form below:</p>

        <form action="{{ url('/submit-contact') }}" method="POST">
            @csrf
            <div>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div>
                <button type="submit">Send Message</button>
            </div>
        </form>
    </div>
@endsection