@extends('layout')

@section('title', 'Profile')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white py-3">
                    <h3 class="mb-0 text-center">ASTER'S PERFUME</h3>
                </div>
                <div class="card-body p-4">

                    
                    <div class="mb-4">
                        <p class="lead text-center">Welcome to my profile page. This is a brief description of myself and my business journey.</p>
                    </div>
                    
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title text-primary"><i class="bi bi-journal-text me-2"></i>My Journey</h4>
                            <p class="card-text">In 2024, The journey of our perfume business began with a deep passion for fragrance, art, and the desire to offer a unique sensory experience. As a brand, we sought to combine the rich history of perfumery with modern-day creativity, creating high-quality, luxurious fragrances that resonate with people on a personal level. We started small, carefully curating each scent with the finest ingredients sourced from around the world. Every bottle we designed reflected our commitment to elegance, sophistication, and excellence.</p>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title text-primary"><i class="bi bi-lightbulb me-2"></i>Our Vision</h4>
                            <p class="card-text">To be a globally recognized fragrance brand that creates unforgettable scents, celebrates individuality, and promotes sustainability in every aspect of our craft. We aim to inspire confidence and evoke emotions through the art of perfumery, while building a community of fragrance lovers who appreciate quality, creativity, and the timeless beauty of scent.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection